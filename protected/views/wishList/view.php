<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>

<div class="page-header">
<h1><?php echo Html::encode(Html::valueEx($model)); ?></h1>
</div>

<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'model_id',
array(
				'name' => 'type_id',
				'type' => 'raw',
				'value'=>$model->getTypeOptions($model->type_id),
				),
array(
				'name' => 'state_id',
				'type' => 'raw',
				'value'=>$model->getStatusOptions($model->state_id),
				),
array(
			'name' => 'createUser',
			'type' => 'raw',
			'value' => $model->createUser !== null ? Html::link(Html::encode(Html::valueEx($model->createUser)), array('user/view', 'id' => ActiveRecord::extractPkValue($model->createUser, true))) : null,
			),
'create_time',
	),
)); ?>


<?php   $this->widget('CommentPortlet', array(
	'model' => $model,
));
?>