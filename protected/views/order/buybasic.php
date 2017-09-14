<?php //include(dirname(__FILE__).'/../user/tabuser.php');?>
<style>

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  border-top: 1px solid #dddddd;
  line-height: 2.5;
  padding: 8px;
  vertical-align:middle;
}

</style>

<div class="container"> 
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3 class="box-title no_margin clearfix"><?php echo Yii::t('app','your orders');?></h3>
				</div>


<div class="box-body table-responsive">
<div class="tab-pane active tabs_inner order-history" id="home">
<?php /* ?>
	<div class="row-fluid">
		<div class="span4">



			<form id="buy_order_form"
				action="<?php echo Yii::app()->createUrl('order/makeCsv')?>"
				method="Post">

				<?php echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation')); ?>

				<input type="hidden" name="order_ids" value="" id="buy_order_ids" />

			</form>


			<?php echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation')); ?>
		</div>
		<div class="clearfix"></div>
		<hr>
	</div>
	*/ ?>

	<div class="clearfix"></div>
	<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'brand-grid',
			'type'=>'striped condensed',
			'dataProvider' => $model->search(),
			'filter' => $model,
			'enableSorting'=>true,
			'selectableRows'=>2,
			'columns' => array(
	
		
	 array(
							'header' => '<a>'.Yii::t('app','order no').'.</a>',
							'value'=>'$data->id',
	),
	//'shop',
				//	'createUser',
	array(
							'header' => '<a>'.Yii::t('app','amount').'. € </a>',
							'value'=> '$data->amount',
	),
	array(
							'header' => '<a>'.Yii::t('app','state').'</a>', 
							'name' => 'state_id',
							'value'=>'$data->getStatusOptions($data->state_id)',
							'filter'=>Order::getStatusOptions(),
	),
	array(
			'header' => '<a>'.Yii::t('app','type').'</a>', 
			'name' => 'type_id',
			'value'=>'$data->getTypeOptions($data->type_id)',
			'filter'=>Order::getTypeOptions()
	),
	array(
			'header' => '<a>'.Yii::t('app','create time').'</a>', 
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
</div>
</div>
</div>


</div>
</div>
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
