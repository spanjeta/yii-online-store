<?php
Yii::setPathOfAlias('ext-prod',dirname(__FILE__).'/../../ext-prod');

$main = array (
		'basePath'=>dirname(__FILE__).'/../protected',
		'runtimePath'=>dirname(__FILE__).'/../wdir/runtime',
		'name'=>'Ecommerce !',
		'theme'=>'united',
		'defaultController'=> 'site',
		
		// autoloading model and component classes
		'import' => array (
				'ext.yiisortablemodel.models.*',
				'application.models.*',
				'application.components.*',
				'application.controllers.*',
				'ext.easyimage.EasyImage',
				'ext.DzRaty.DzRaty'
		),
		// application components
		'components' => array (
				
				'mail' => array (
						'class' => 'ext-prod.yii-mail.YiiMail',
						'transportType' => 'php',
						'viewPath' => 'application.views.mail',
						'logging' => false,
						'dryRun' => false 
				),
				
				'cache' => array (
						'class' => 'CFileCache' 
				),
				'user' => array (
						'class' => 'application.components.WebUser',
						'autoRenewCookie' => true,
						'allowAutoLogin' => true,
						'loginUrl' => array (
								'/user/login' 
						) 
				),
				
				/* 
					'errorHandler'=>array(
					'errorAction'=>'site/error',
				), */
		),
		
		'params' => require (dirname ( __FILE__ ) . '/params.php') 
);

$main ['components'] ['db'] = include ('dev-db.php');

return $main;
