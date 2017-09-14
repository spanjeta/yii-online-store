<?php
$this->breadcrumbs=array(
	'Mailings'=>array('index'),
	$model->id,
);
?>

<h1>View Mailing</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'subject',
		'sent',
		'queue',
		'startedOn',
		'finishedOn',
		array('name'=>'status0.name','lable'=>''),
//not for free :)		array('name'=>'content','type'=>'raw'),
	),
)); ?>
