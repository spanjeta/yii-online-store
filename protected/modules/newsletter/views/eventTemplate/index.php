<?php
/* @var $this EventTemplateController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Event Templates',
);

$this->menu=array(
	array('label'=>'Create EventTemplate', 'url'=>array('create')),
	array('label'=>'Manage EventTemplate', 'url'=>array('admin')),
);
?>

<h1>Event Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
