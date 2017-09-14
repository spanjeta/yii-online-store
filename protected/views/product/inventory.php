

<?php include(dirname(__FILE__).'/../user/tabs.php')?>

<div class="tabs_inner">
	<div id="home" class="tab-pane active">

		<div class="span4 pull-right">
		<?php
		//	$model = new Product();
		echo CHtml::dropDownList('type_id',$model,$model->getInvOperation(),array('empty' => 'Select Operation'));
		?>
		<?php echo CHtml::link('Execute','',array('class'=>'btn btn-primary','id'=>'gridchk'))?>
	
			<form id="product_form"
				action="<?php echo Yii::app()->createUrl('inventory/makeCsv')?>"
				method="Post">

				<?php echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation')); ?>

				<input type="hidden" name="product_ids" value="" id="product_ids" />

				<?php echo CHtml::link('Generate csv','',array('class'=>'btn btn-primary pull-right','id'=>'makcsv'))?>

			</form>
		</div>
		<div class="clearfix"></div>
		<hr>

		<div id="pcontent">

		<?php
			//$this->renderPartial('_plist',array('dataProvider'=>$dataProvider),false);
		$this->widget('booster.widgets.TbGridView', array(
					'id' => 'product-grid-inv',
					'type'=>'bordered', // 'condensed','striped',
					'dataProvider' => $model->my()->search(),
		
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
							'title',
		//	'product_code',
						
							'price',
							'quantity',
		array(
									'name'=>'state_id',
									'value'=>'$data->getStatusOptions($data->state_id)',
									'filter'=>Product::getStatusOptions()
		),
		array(
									'name'=>'feature_site',
									'value'=>'$data->getFeatureOptions($data->feature_site)',
									'filter'=>Product::getFeatureOptions()
		),
		array(
			'name'=>'is_featured',
			'value'=>'$data->getFeatureOptions($data->is_featured)',
			'filter'=>Product::getFeatureOptions()
		),
		/* 		array(
		 'name'=>'is_sale',
		 'value'=>'$data->getSale($data->is_sale)',
		 'filter'=>Product::getSale()
			), */

		array(
			'name' => 'update_time',
			'value'=>'(strtotime($data->update_time)) ? date("j F", strtotime($data->update_time)) : date("j F", strtotime($data->create_time))',

		),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
		//	'htmlOptions' => array('nowrap'=>'nowrap'),
			'header'=>'Operation',
			'template'=>'{update}{delete}'
			),
			/* 		array(
			 'class'=>'booster.widgets.TbButtonColumn',
			 'htmlOptions' => array('nowrap'=>'nowrap'),
			 'header'=>'Delete',
			 'template'=>'{delete}'
			 ), */
			),
			));

			?>


		</div>

	</div>

</div>

<script>

$(document).ready(function() {

	
	$('#gridchk').click(function() {

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();

		var type =  $('#type_id').val(); 

  //		alert(type);
		$.ajax({
			type: "POST",
			data: {checkedValues:checkedValues,type:type},
			url: "<?php echo Yii::app()->createUrl('inventory/remove')?>",
			success: function(msg){
				window.location.href = '<?php echo Yii::app()->createUrl('product/inventory')?>';
			}
			});
		
		});
	
});
$(document).ready(function() {
	
	$('#makcsv').click(function() {

		

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();

	//	alert((checkedValues).count);

	$('#product_ids').val(checkedValues);

 $('#product_form').submit();

		
		});
	
});


		</script>