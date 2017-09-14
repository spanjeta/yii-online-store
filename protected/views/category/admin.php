<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
	<h1><?php echo Yii::t('app', 'manage') . ' : ' . Html::encode($model->label(2)); ?></h1>
</div>
<p>You may optionally enter a comparison operator (&lt;, &lt;=, &gt;,
	&gt;=, &lt;&gt; or =) at the beginning of each of your search values to
	specify how the comparison should be done.</p>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'order-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
								'header'=>'<a>Sr. No.</a>',
								'value'=>'$row+1',
								
						),
		array(
			'name'=>'ship_address_id',
			'value'=>'Html::valueEx($data->shipAddress)',
			'filter'=>Html::listDataEx(UserAddress::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'bil_address_id',
			'value'=>'Html::valueEx($data->bilAddress)',
			'filter'=>Html::listDataEx(UserAddress::model()->findAllAttributes(null, true)),
			),
		'amount',
		'order_email',
		'phone_no',
		/*
		'paid',
		'payment_id',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Order::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Order::getStatusOptions(),
				),
		'ship_time',
		'update_time',
		*/
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		),
	),
)); ?>