<?php
/* @var $this EventTemplateController */
/* @var $model EventTemplate */

$this->breadcrumbs=array(
	'Event Templates'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List EventTemplate', 'url'=>array('index')),
	array('label'=>'Create EventTemplate', 'url'=>array('create')),
	array('label'=>'Update EventTemplate', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EventTemplate', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EventTemplate', 'url'=>array('admin')),
);
?>

<h1>View EventTemplate #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'event',
	),
)); ?>
