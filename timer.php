<?php

require (dirname(__FILE__).'/common.php');

$config = DB_CONFIG_PATH.'/console.php';

require_once($yii);
Yii::createWebApplication($config);

$runner=new CConsoleCommandRunner();
$runner->commands=array(
		'timerCommand' => array(
				'class' => 'application.commands.TimerCommand',
				//'forever' => false,
		),
);

//ob_start();

$runner->run(array(
		'yiic',
		'timerCommand',
));
?>

