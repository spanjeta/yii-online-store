<?php include(dirname(__FILE__).'/../user/tabs.php')?>
<hr>

<h3>
	<?php echo 'Postage Management'; ?>

	<div class="pull-right">
		<?php	echo CHtml::link('Add postage option','#',array('class'=>'btn btn-gray','onclick'=>'addPostage()'));?>
		
	</div>
</h3>
<hr>
<div id="postage-grid">


	<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'postage-grid-1',
			'type'=>'bordered', // 'condensed','striped',
			'dataProvider' => $dataProvider,
			'columns' => array(
					'id',
					'title',
					'first_item_cost',
					'additional_item_cost',
					/* 		array(
					 'name' => 'type_id',
							'value'=>'$data->getTypeOptions($data->type_id)',
							'filter'=>Postage::getTypeOptions(),
					),
	array(
			'name' => 'state_id',
			'value'=>'$data->getStatusOptions($data->state_id)',
			'filter'=>Postage::getStatusOptions(),
	), */
					//		'create_time:date',
					array(
							'class'=>'CButtonColumn',
							'template'=>'{update}',
							'header'=>'Update'
					),

					array(
						'class' => 'CxButtonColumn',
						'template'=>'{delete}',
						'header'=>'Delete'
				),
			),
)); ?>
</div>


<div id="id_view" style="display: none;">
	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/loader.gif')?>

</div>

<script>

function removeCity()
{
	alert('dff');
}


function addPostage()
{

	var url = '<?php echo Yii::app()->createUrl('postage/create')?>';

	$('#postage-grid').load(url);

}

function addCustom()
{

	var price =isNumber( ($('#custom_price').val()));
	if(price)
	{
	$.ajax({
		url : '<?php echo Yii::app()->createUrl('postage/custom')?>',
		type: 'Post',
		data : {price:price},
		success:function(){
			
		},
	});
	}
	else
	{
		alert('enter right value');
		return false;
	}


function isNumber(n) { return /^-?[\d.]+(?:e-?\d+)?$/.test(n); } 

}

</script>

