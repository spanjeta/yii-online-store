<?php include(dirname(__FILE__).'/../user/tabs.php');?>

<h3>Selling Orders</h3>

<div class="tab-pane active tabs_inner" id="home">

	<div class="row-fluid">
		<p>Bulk Operation</p>
		
		<?php
		//	$model = new Product();
		echo CHtml::dropDownList('state_id',$model,$model->changeOperation(),array('empty' => 'Change State','onchange'=>'changesellstate()', 'class'=>'pull-left'));
		?>
        

		<form id="sell_order_form" action="<?php echo Yii::app()->createUrl('order/makeSellCsv')?>"	method="Post" class="span3">

			<?php echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation','onchange' => 'sellcsv()')); ?>

			<input type="hidden" name="order_ids" value="" id="sell_order_ids" />

		</form>
</div>
		<?php
		//	$model = new Product();
		//echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation',''));
		?>

		<div class="clearfix"></div>

	
	
	<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'brand-grid',
			'type'=>'striped bordered condensed',
			'dataProvider' => $model->searchSell(),
			'filter' => $model,
			'enableSorting'=>true,
			'selectableRows'=>2,
			'columns' => array(
	array(
														'name'=>'chk',
														'class'=>'CCheckBoxColumn',
														'id'=>'chks',
														'value'=>'$data->id',
	),
	//	'id',
	array(
														'name' => 'order_no',
														'value'=>'$data->id',
	),
	array(
														'name' => 'User',
														'value'=>'isset($data->createUser->first_name) ? $data->createUser->first_name : $data->createUser->email',
	),
			//		'createUser',
	array(
							 'name' => 'amount',
							 'value'=>'$data->cart->amount',
	),
	//'state_id',
	array(
														'name' => 'state_id',
														'value'=>'$data->getStatusOptions($data->state_id)',
														'filter'=>Payment::getStatusOptions(),

	),
	array(
									'name' => 'type_id',
									'value'=>'$data->getTypeOptions($data->type_id)',
									'filter'=>Payment::getTypeOptions(),
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
			array(
			'class'=>'booster.widgets.TbButtonColumn',
			'header'=>'Operation',
			'htmlOptions' => array('nowrap'=>'nowrap'),
			'template'=>'{update}'
			),

			array(
						'header'=>'Mark delete',
						'class'=>'CxButtonColumn',
						'template'=>'{delete_task}',
						'buttons'=>array(
								'delete_task' =>array(
										'label'=>'delete task',
												'url'=>'Yii::app()->createUrl("order/delete",array("id"=>$data->id))',
										'options'=>array('class'=>'badge badge-warning'),
			//'visible'=>'$data->task->state_id == 0',
			),


			),
			),




			),
			)); ?>

</div>


<script>
function  changesellstate() {

	//alert('dsdsd');

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();
		var state_id =  $('#state_id').val(); 
  //		alert(type);
		$.ajax({
			type: "POST",
			data: {checkedValues:checkedValues,state_id:state_id},
			url: "<?php echo Yii::app()->createUrl('order/updateState')?>",
			success: function(msg){
			    location.reload();		
			    
			    	}
			});
		
		};
	

		</script>

<!--  This is for making the csv of selling orders -->

<script>
	
	function sellcsv() {

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();

	//	alert((checkedValues).count);

	$('#sell_order_ids').val(checkedValues);

 $('#sell_order_form').submit();
		
		}
			</script>

<!-- here csv script ends -->
