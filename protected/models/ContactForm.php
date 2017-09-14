<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{


	public $enquiry_id;
	public $type_id;
	public $name;
	public $email;
	public $subject;
	public $inq;
	public $topic;
	public $body;
	public $keyword;
	public $catagories;
	public $address = null;
	public $username;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
				// name, email, subject and body are required
				array('subject,body, email', 'required'),
				// email has to be a valid email address
				array('email', 'email'),
				// verifyCode needs to be entered correctly
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
				'verifyCode'=>'Verification Code',
				'email'=>'Your Email',
				'name'=>'Your Name',
				'inq'=>'Type of enquiry',
				'topic'=>'Topic',
		);
	}
}