<?php

require (dirname(__FILE__).'/common.php');
$config = DB_CONFIG_PATH.'/console.php';

require_once($yii);
Yii::createWebApplication($config);

$runner=new CConsoleCommandRunner();
$runner->commands=array(
    'migrate' => array(
        'class' => 'system.cli.commands.MigrateCommand',
        'interactive' => false,
    ),
);

ob_start();
$runner->run(array(
    'yiic',
    'migrate',
));
echo htmlentities(ob_get_clean(), null, Yii::app()->charset);