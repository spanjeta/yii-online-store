
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'paypal-info-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'email',
		'credit_card_no',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>PaypalInfo::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>PaypalInfo::getStatusOptions(),
				),
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>