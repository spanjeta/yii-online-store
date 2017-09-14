<?php
// uncomment the following to define a path alias
//Yii::setPathOfAlias ( 'bootstrap', dirname ( __FILE__ ) . '/../ext-prod/bootstrap' );
Yii::setPathOfAlias ( 'booster', dirname ( __FILE__ ) . '/../ext-prod/booster' );
Yii::setPathOfAlias ( 'editable', dirname ( __FILE__ ) . '/../extensions/x-editable' );
Yii::setPathOfAlias ( 'ext-prod', dirname ( __FILE__ ) . '/../ext-prod' );
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array (
		'basePath' => dirname ( __FILE__ ) . '/../protected',
		'runtimePath' => dirname ( __FILE__ ) . '/../wdir/runtime',
		'name' => 'Ecommerce !',
		'theme' => 'united',
		'defaultController' => 'site',
		
		'preload' => array (
				'session',
				'urlManager',
				'user',
				//'bootstrap'
				'booster',
				'translate'
		),
		
		// autoloading model and component classes
		'import' => array (
				'ext.yiisortablemodel.models.*',
				'application.models.*',
				'application.components.*',
				'application.controllers.*',
				'ext.easyimage.EasyImage',
				'ext.DzRaty.DzRaty' ,
				'application.modules.hybridauth.controllers.*',
				'application.modules.translate.TranslateModule'
		),		
		'modules' => array (
				'api',
				'debugger',
				'translate',
				'backup' => array (
						'path' => dirname ( __FILE__ ) . '/../_backup/'
				),
'myadmin',
				'newsletter' ,
				'sitemap' => array (
						'class' => 'application.modules.sitemap.SitemapModule',
						'urls' => array (
								'/',
								'/terms',
								'/about',
								'/contact',
								'/privacy',
								'/returns',
								'user/login',
								'user/create',
								'category/index'
						),
						'models' => array (
								array (
										'class' => 'Product'
										// 'condition' => 'is_public = 1'
								),
								
								'Color',
								'Brand'
								
								
						),
						'changefreq' => 'daily',
						'cachingDuration' => 0
				),
				'hybridauth' => array(
						'baseUrl' => 'http://jisro.com/online-clothing-store/hybridauth',
						'withYiiUser' => false, // Set to true if using yii-user
						"providers" => array (
								"Google" => array (
										"enabled" => true,
										"keys"    => array ( "id" => "317002193391-rkbei2h2ff706amcnh7musig6c98itb0.apps.googleusercontent.com", "secret" => "cQbaWA0zxFLXdsLnOkd-E66Y" ),
										"scope"   => "https://www.googleapis.com/auth/userinfo.profile ". // optional
										"https://www.googleapis.com/auth/userinfo.email"   , // optional
								),
								"Facebook" => array (
										"enabled" => true,
										"keys"    => array ( "id" => "227439147767690", "secret" => "b0fe779039796cbf02b2e17a37b7503f" ),
										"scope"   => "email,publish_actions",
										"display" => "",
										'return_scopes' => true
								),
						)
				),
			
		),
		
		// application components
		'components' => array (
						'tools' => array(
								'class'=>'ToolsComponent',
						),
				'ePdf' => array (
						'class' => 'ext.yii-pdf.EYiiPdf',
						'params' => array (
								'mpdf' => array (
										'librarySourcePath' => 'ext.vendors.mpdf.*',
										'constants' => array (
												'_MPDF_TEMP_PATH' => Yii::getPathOfAlias ( 'application.runtime' )
										),
										'class' => 'mpdf'  // the literal class filename to be loaded from the vendors folder
										/*
										 * 'defaultParams' => array( // More info: http://mpdf1.com/manual/index.php?tid=184
										 * 'mode' => '', // This parameter specifies the mode of the new document.
										 * 'format' => 'A4', // format A4, A5, ...
										 * 'default_font_size' => 0, // Sets the default document font size in points (pt)
										 * 'default_font' => '', // Sets the default font-family for the new document.
										 * 'mgl' => 15, // margin_left. Sets the page margins for the new document.
										 * 'mgr' => 15, // margin_right
										 * 'mgt' => 16, // margin_top
										 * 'mgb' => 16, // margin_bottom
										 * 'mgh' => 9, // margin_header
										 * 'mgf' => 9, // margin_footer
										 * 'orientation' => 'P', // landscape or portrait orientation
										 * )
										 */
								),
								'HTML2PDF' => array (
										'librarySourcePath' => 'ext.vendors.html2pdf.*',
										'classFile' => 'html2pdf.class.php'  // For adding to Yii::$classMap
										/*
										 * 'defaultParams' => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
										 * 'orientation' => 'P', // landscape or portrait orientation
										 * 'format' => 'A4', // format A4, A5, ...
										 * 'language' => 'en', // language: fr, en, it ...
										 * 'unicode' => true, // TRUE means clustering the input text IS unicode (default = true)
										 * 'encoding' => 'UTF-8', // charset encoding; Default is UTF-8
										 * 'marges' => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
										 * )
										 */
								)
						)
				),
				
				'geoIP' => array (
						'class' => 'ext.EGeoIP'
				),
				
				/* 'bootstrap' => array (
						'class' => 'ext-prod.bootstrap.components.Bootstrap'
						// 'responsiveCss' => true,
				), */
				'booster' => array (
						'class' => 'ext-prod.booster.components.Booster',
						'responsiveCss' => true,
						'enableJS' => true,
						'bootstrapCss' => false
						// 'responsiveCss' => true,
				),
				'mail' => array (
						'class' => 'ext-prod.yii-mail.YiiMail',
						'transportType' => 'smtp',
						'transportOptions'=>array(
								'host'=>'server23.websitehostserver.net',
								'username'=>'outlet@outlet.co.mz',
								'password'=> '$1%H.Tgoiff@',
								'port'=>'25',
						),
						'viewPath' => 'application.views.mail',
						'logging' => true,
						'dryRun' => false
				),
				
				
				/*	'cache'=> array(
				 'class'=>'system.caching.CDbCache',
				 ), */
				
				'user' => array (
						'class' => 'application.components.WebUser',
						'allowAutoLogin' => true,
						'loginUrl' => array (
								'/user/login'
						)
				),
				//define the class and its missingTranslation event
				 'messages'=>array(
						'class'=>'CDbMessageSource',
						'onMissingTranslation' => array('TranslateModule', 'missingTranslation'),
				),
				'translate'=>array(//if you name your component something else change TranslateModule
						'class'=>'translate.components.MPTranslate',
						//any avaliable options here
						'acceptedLanguages'=>array(
								'en'=>'English',
								'pt'=>'Portugues',
						),
						'defaultLanguage' => 'pt',
						//'googleApiKey' =>
						// 						'autoTranslate' => true
				), 
				'urlManager' => array (
						'urlFormat' => 'path',
						'showScriptName' => false,
						// 'caseSensitive'=>true,
						'rules' => array (
								// 'rajesh'=>'product/create',
								'about' => 'site/about',
								'contact' => 'site/contact',
								'review' => 'site/review',
								'contact' => 'site/contact',
								'rating' => 'site/rating',
								'terms' => 'site/terms',
								'privacy' => 'site/privacy',
								'returns' => 'site/returns',
								'policy' => 'site/policy',
								'faq' => 'site/faq',
								'cart' => 'site/cart',
								
								'sitemap.xml' => 'site/sitemap',
								'homepage' => 'site/index',
								'sitemap.xml' => 'site/sitemap',
								'home' => 'site',
								'<controller:\w+>/<id:\d+>' => '<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>'
						)
				),
				
				'db' => require (DB_CONFIG_FILE_PATH),
				
				/* 'errorHandler' => array (
						'errorAction' => 'site/error'
				) */
		),
		
		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params' => require (dirname ( __FILE__ ) . '/params.php')
		
);
