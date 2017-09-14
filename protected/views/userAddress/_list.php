
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'user-address-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		//'id',
		'bulding_name',
		'street_add',
		'suburb',
		'postcode',
		/*array(
				'name' => '_state',
				'value'=>'$data->getStatusOptions($data->_state)',
				'filter'=>UserAddress::getStatusOptions(),
				),
		
		'country',
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>UserAddress::getStatusOptions(),
				),
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>UserAddress::getTypeOptions(),
				),
		'is_same',
		'update_time',
		*/
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>