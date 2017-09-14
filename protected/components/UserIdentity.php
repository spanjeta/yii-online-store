<?php
class UserIdentity extends CUserIdentity {
	public $id;
	public $user;
	const ERROR_EMAIL_INVALID = 3;
	const ERROR_STATUS_INACTIVE = 4;
	const ERROR_STATUS_BANNED = 5;
	const ERROR_STATUS_REMOVED = 6;
	const ERROR_STATUS_USER_DOES_NOT_EXIST = 7;
	const ERROR_CHOICE_INACTIVE = 8;
	const ERROR_PASSWORD_INVALID = 9;
	
	public function authenticateReg($user = false) {
		if ($user == false) {
			return self::ERROR_STATUS_USER_DOES_NOT_EXIST;
		} else {
			$this->id = $user->id;
			$this->setState ( 'id', $user->id );
			$this->username = $user->full_name;
			$this->errorCode = self::ERROR_NONE;
		}
		return ! $this->errorCode;
	}
	
	public $ldapOptions = array (
			'ldap_host' => '',
			'ldap_port' => '',
			'ldap_basedn' => '',
			'ldap_protocol' => '',
			'ldap_autocreate' => '',
			'ldap_tls' => '',
			'ldap_transfer_attr' => '',
			'ldap_transfer_pw' => '' 
	);
	public function authenticateLdap() {
		$settings = $this->ldapOptions;
		
		$ds = @ldap_connect ( $settings->ldap_host, $settings->ldap_port );
		ldap_set_option ( $ds, LDAP_OPT_PROTOCOL_VERSION, $settings->ldap_protocol );
		
		if ($settings->ldap_tls == 1)
			ldap_start_tls ( $ds );
		
		if (! @ldap_bind ( $ds ))
			throw new Exception ( 'OpenLDAP: Could not connect to LDAP-Server' );
		
		if ($r = ldap_search ( $ds, $settings->ldap_basedn, '(uid=' . $this->username . ')' )) {
			$result = @ldap_get_entries ( $ds, $r );
			if ($result [0] && @ldap_bind ( $ds, $result [0] ['dn'], $this->password )) {
				$user = User::model ()->find ( 'username=:username', array (
						':username' => $this->username 
				) );
				if ($user == NULL) {
					if ($settings->ldap_autocreate == 1) {
						$user = new User ();
						$user->username = $this->username;
						if ($settings->ldap_transfer_pw == 1)
							$user->password = User::encrypt ( $this->password );
						$user->last_password_change = 0;
						$user->activation_key = '';
						$user->create_time = new CDbExpression ( 'NOW()' );
						$user->state_id = 1;
						
						if ($user->save ( false )) {
							$profile = new Profile ();
							$profile->user_id = $user->id;
							$profile->privacy = 'protected';
							if ($settings->ldap_transfer_attr == 1) {
								$user->email = $result [0] ['mail'] [0];
								$profile->lastname = $result [0] ['sn'] [0];
								$profile->firstname = $result [0] ['givenname'] [0];
							}
							$profile->save ( false );
						} else
							return ! $this->errorCode = self::ERROR_PASSWORD_INVALID;
					} else
						return ! $this->errorCode = self::ERROR_PASSWORD_INVALID;
				}
				
				$this->id = $user->id;
				$this->setState ( 'id', $user->id );
				$this->username = $user->username;
				$this->user = $user;
				
				return ! $this->errorCode = self::ERROR_NONE;
			}
		}
		return ! $this->errorCode = self::ERROR_PASSWORD_INVALID;
	}
	public function authenticate($loginByEmail = false) {
		$user = null;
		// try to authenticate via email
		// if( $loginByEmail)
		{
			// $user = User::model()->find('email = :email', array(':email' => $this->username));
			$user = User::model ()->findByAttributes ( array (
					'email' => $this->username 
			) );
		}
		
		if (! $user)
			return self::ERROR_STATUS_USER_DOES_NOT_EXIST;
		if (! User::validate_password ( $this->password, $user->password ))
			$this->errorCode = self::ERROR_PASSWORD_INVALID;
		else if ($user->state_id == User::STATUS_INACTIVE)
			$this->errorCode = self::ERROR_STATUS_INACTIVE;
		else if ($user->state_id == User::STATUS_BANNED)
			$this->errorCode = self::ERROR_STATUS_BANNED;
		else if ($user->state_id == User::STATUS_REMOVED)
			$this->errorCode = self::ERROR_STATUS_REMOVED;
		else {
			$this->id = $user->id;
			$this->setState ( 'id', $user->id );
			$this->username = $user->email;
			$this->errorCode = self::ERROR_NONE;
		}
		return ! $this->errorCode;
	}
	public function authenticateSession($user) {
		if (! $user)
			return self::ERROR_STATUS_USER_DOES_NOT_EXIST;
		$this->id = $user->id;
		$this->setState ( 'id', $user->id );
		$this->username = $user->email;
		$this->user = $user;
		$this->errorCode = self::ERROR_NONE;
		
		return ! $this->errorCode = self::ERROR_NONE;
	}
	
	/**
	 *
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->id;
	}
	public function getRoles() {
		return $this->Role;
	}
}



