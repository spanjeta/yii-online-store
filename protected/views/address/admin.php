<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){ $('.search-form').toggle(); return
false; }); $('.search-form form').submit(function(){
$.fn.yiiGridView.update('
address-grid', { data: $(this).serialize() }); return false; }); "); ?>
<div class="page-header">
	<h1>
	<?php		echo Yii::t('app', 'Manage') . ' : ' .
		Html::encode($model->label(2)); ?>
	</h1>
</div>

	<?php $this->widget('booster.widgets.TbGridView', array( 'id' => '
	address-grid', 'type'=>'striped bordered condensed', 'dataProvider' =>
$model->search(), 'filter' => $model, 'columns' => array(
			'id',
		'bulding_name',
		'street_add',
		'suburb',
		'postcode',
		array(
				'name' => '_state',
				'value'=>'$data->getStatusOptions($data->_state)',
				'filter'=>Address::getStatusOptions(),
				),
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
array( 'class'=>'booster.widgets.TbButtonColumn', 'htmlOptions' =>
array('nowrap'=>'nowrap'), ), ), )); ?>
