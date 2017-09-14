
<?php
$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => '
address-grid',
		'type' => 'bordered condensed striped',
		'selectionChanged' => "function(id){window.location='" . Yii::app ()->createAbsoluteUrl ( '
address/view' ) . "/' + $.fn.yiiGridView.getSelection(id);}",
		'dataProvider' => $dataProvider,
		'columns' => array (
				'id',
				'bulding_name',
				'street_add',
				'suburb',
				'postcode',
				'state',
				'country',
	/* 	array(
				'name' => '_state',
				'value'=>'$data->getStatusOptions($data->_state)',
				'filter'=>Address::getStatusOptions(),
				), */
		/*
		'country',
		'bulding_name1',
		'street_add1',
		'suburb1',
		'postcode1',
		array(
				'name' => '_state1',
				'value'=>'$data->getStatusOptions($data->_state1)',
				'filter'=>Address::getStatusOptions(),
				),
		'country1',
		'ph_no',
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Address::getStatusOptions(),
				),
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Address::getTypeOptions(),
				),
		'is_same',
		'cart_id',
		'update_time',
		*/
array (
						'class' => 'CxButtonColumn' 
				) 
		) 
) );
?>
