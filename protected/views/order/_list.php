
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'order-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('order/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
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
			'class' => 'CxButtonColumn',
		),
	),
)); ?>