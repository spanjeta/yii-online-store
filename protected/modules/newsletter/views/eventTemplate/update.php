<?php
/* @var $this EventTemplateController */
/* @var $model EventTemplate */

$this->breadcrumbs=array(
	'Event Templates'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EventTemplate', 'url'=>array('index')),
	array('label'=>'Create EventTemplate', 'url'=>array('create')),
	array('label'=>'View EventTemplate', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EventTemplate', 'url'=>array('admin')),
);
?>

<h1>Update EventTemplate <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>