<?php
//defined('YII_ENV') or define('YII_ENV','prod');
ini_set('post_max_size','128M');
require (dirname(__FILE__).'/common.php');

require_once($yii);
Yii::createWebApplication($config)->run();
