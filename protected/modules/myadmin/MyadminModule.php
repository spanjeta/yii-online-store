<?php

class MyadminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'myadmin.models.*',
			'myadmin.components.*',
		));
	}

	/* public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			
			//$this->checkAdminAccess();
			
			if (Yii::app()->user->isGuest){
                Yii::app()->user->loginRequired();                
            }else {
                
				//if(Yii::app()->user->checkAccess('admin')) {
				if($this->checkAdminAccess()) {
					return true;
				}else {
					
                    if(Yii::app()->user->id=='54676') {						
						$auth=Yii::app()->authManager;
                        $auth->assign('admin', 54676);
                        $auth->save();                    
                        return true;
                    }
                    /*
                    elseif(Yii::app()->user->id=='54646') {
						$auth=Yii::app()->authManager;
                        $auth->assign('admin', 54646);
                        $auth->save();
                       // echo "cc"; die();
                        return true;
                    }
                    else{                 
						Yii::app()->request->redirect('/network/');
					}
				}
			}
			
		}
		else
			return false;
	} */
	
	public function checkAdminAccess() {
		
		$uid = Yii::app()->user->id;
		$user = User::model()->findByPk($uid);
		
		if($user->access == 265) {
				$access = 'admin';
		} else {
				$access = 'user';
		}
			
		// assigns the user role to the user id
		$auth = Yii::app()->authManager; //initializes the authManager
		if(!$auth->isAssigned($access, $uid)) {
			$auth->assign($access, $uid);
			Yii::app()->authManager->save();
		}
			
		if(Yii::app()->user->checkAccess('admin')) {
			return true;
		}
		
		return false;		
	}
	
}
