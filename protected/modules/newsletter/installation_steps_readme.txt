Purpose:- 
This module is used for creating a dynamic email template for different event like REGISTRATION , FORGOT PASSWORD, LOGIN etc...
you will send a newsletter template which you assigned to a particular event.
and if any template does not exist for the event then the default email will send.
newsletter temlate also have a Active-Inactive facility for enable or disable template 


steps for installlation:-

1) download file and unzip it into protected/modules

2) in config/main.php
    'modules'=>array(
		'newsletter' =>array(
			'components' => array(
				'tools' => array(
        			'class'=>'ToolsComponent',
       			 ),
			)
		),
     ),

3) go to the protected directory of your project and run this command in terminal:- 
   $ php yiic migrate --migrationPath=application.modules.newsletter.migrations
				OR
   $ yiic migrate --migrationPath=application.modules.newsletter.migrations

	
4) Add this code for menu in views/layouts/main.php :-
   In items array ,

<?php
      array('url'=>array('/newsletter/eventNewsletterTemplate/index'), 'label'=>'EventNewsletter'),
      array('url'=>array('/newsletter/newsletterTemplate/index'), 'label'=>'Newsletter'),
      array('url'=>array('/newsletter/eventTemplate/index'), 'label'=>'Event'),
?>

5) write the following code according to your need..
   In Controller :-

   <?php

	  // arrParams array contains eventtype same as the event_template table event type
          // repacement array used for variables which you want to replace dynamically from your content
	  $arrParams = array( 'eventtype' => 'FORGOT PASSWORD',
			      'replacement' => array(
					 '##USEREMAIL##' => 'testUser@gmail.com',
		                         '##USERNAME##' => 'testUser',
					  -------
		                       ));
	  $emaildetails = Yii::app()->getModule('newsletter')->tools->getdetails($arrParams); //call global function getdetails() of the component/Tools.php
				    			
	  if(!empty($emaildetails)) {
		    $subject = $emaildetails['subject'];
		    $message = $emaildetails['view'];
		    $user = 'testUser@gmail.com';				   
	  }
	  else {
	     //put your deafult code of the email parameters
	  }  
       
   ?>
 	  
