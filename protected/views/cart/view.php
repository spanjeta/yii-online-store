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
array(
			'name' => 'product',
			'type' => 'raw',
			'value' => $model->product !== null ? Html::link(Html::encode(Html::valueEx($model->product)), array('product/view', 'id' => ActiveRecord::extractPkValue($model->product, true))) : null,
			),
array(
			'name' => 'shop',
			'type' => 'raw',
			'value' => $model->shop !== null ? Html::link(Html::encode(Html::valueEx($model->shop)), array('company/view', 'id' => ActiveRecord::extractPkValue($model->shop, true))) : null,
			),
'quantity',
'device_id',
'ip_address',
'session_id',
array(
				'name' => 'state_id',
				'type' => 'raw',
				'value'=>$model->getStatusOptions($model->state_id),
				),
array(
				'name' => 'type_id',
				'type' => 'raw',
				'value'=>$model->getTypeOptions($model->type_id),
				),
'create_user_id',
'create_time',
'update_time',
	),
)); ?>


<?php   $this->widget('CommentPortlet', array(
	'model' => $model,
));
?>