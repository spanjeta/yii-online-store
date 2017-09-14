<?php
/* @var $this VarProductController */
/* @var $model VarProduct */

$this->breadcrumbs=array(
	'Var Products'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List VarProduct', 'url'=>array('index')),
	array('label'=>'Manage VarProduct', 'url'=>array('admin')),
);
?>

<h1>Create VarProduct</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>