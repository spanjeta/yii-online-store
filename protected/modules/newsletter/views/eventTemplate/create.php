<?php
/* @var $this EventTemplateController */
/* @var $model EventTemplate */

$this->breadcrumbs=array(
	'Event Templates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EventTemplate', 'url'=>array('index')),
	array('label'=>'Manage EventTemplate', 'url'=>array('admin')),
);
?>

<h1>Create EventTemplate</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>