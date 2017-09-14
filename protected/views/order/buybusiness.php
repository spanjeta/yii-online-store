<?php include(dirname(__FILE__).'/../user/tabs.php');?>
<h3><?php echo Yii::t('app','buying orders');?></h3>

<div class="tab-pane active tabs_inner" id="home">

	<div class="row-fluid">
		<div class="span4">
		<form id="buy_order_form"
				action="<?php echo Yii::app()->createUrl('order/makeCsv')?>"
				method="Post">

				<?php echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation')); ?>

				<input type="hidden" name="order_ids" value="" id="buy_order_ids" />

				<?php echo CHtml::link('Execute','',array('class'=>'btn btn-primary pull-right','id'=>'makcsv'))?>

			</form>
		</div>
		<div class="clearfix"></div>
		<hr>
	</div>
	<div class="clearfix"></div>
	<hr>
	<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'brand-grid',
			'type'=>'striped bordered condensed',
			'dataProvider' =>$model->searchBuy(),
			'filter' => $model,
			'enableSorting'=>true,
			'selectableRows'=>2,
			'columns' => array(
	array(
							'name'=>'chk',
							'class'=>'CCheckBoxColumn',
	//'selectableRows'=>2,
							'id'=>'chks',
							'value'=>'$data->id',
	),
	//	'id',
	array(
							'name' => 'order_no',
							'value'=>'$data->id',
	),
	//'shop',
					'createUser',

	array(
							'name' => 'amount',
							'value'=>'$data->cart->amount',
	),
	array(
							'name' => 'state_id',
							'value'=>'$data->getStatusOptions($data->state_id)',
	),
	array(
		'name' => 'type_id',
		'value'=>'$data->getTypeOptions($data->type_id)',
	),

	array(
		'name' => 'create_time',
		'value'=>'(strtotime($data->create_time)) ? date("l, F j, Y h:i", strtotime($data->create_time)) : date("j F", strtotime($data->create_time))',
	),
	array(
			'class'=>'booster.widgets.TbButtonColumn',
			'header'=>'Operation',
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'template'=>'{view}'
			),
			),
			)); ?>

</div>
<div id="csv_content"></div>

<script>
$(document).ready(function() {
	
	$('#makcsv').click(function() {

		

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();

	//	alert((checkedValues).count);

	$('#buy_order_ids').val(checkedValues);

 $('#buy_order_form').submit();

		
		});
	
});
		</script>
