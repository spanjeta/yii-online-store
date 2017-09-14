<?php include(dirname(__FILE__).'/../user/tabuser.php');?>
<h1>Coming Soon</h1>
<?php /*?>
<h3>Shipped Products</h3>

<div class="tab-pane active tabs_inner" id="home">

	<div class="row-fluid">

		<div class="clearfix"></div>
		<hr>
	</div>

	<div class="clearfix"></div>
	<hr>
	<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'id' => 'product-grid',
			'type'=>'striped bordered condensed',
			'dataProvider' => $model->returnsearch(),
			'filter' => $model,
			'enableSorting'=>true,
			'selectableRows'=>2,
			'columns' => array(

		array(
				'header' => 'product',
				'value'=>'$data->getReturnItem()',
				//'filter'=>Address::getStatusOptions(),
				),
	/*'bulding_name',
		'street_add',
		'suburb',
		'postcode',
		array(
				'name' => '_state',
				'value'=>'$data->getStatusOptions($data->_state)',
				'filter'=>Address::getStatusOptions(),
				),
		
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
		
array( 'class' => 'CxButtonColumn', ), ), )); ?>
	*/