<div class="total_items">

	<h3>
		<strong><?php echo 'Shop Name :'.' '.$shop_name;?> </strong>
	</h3>
</div>

<div class="clearfix mar_top2"></div>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
		'id' => 'cart-grid',
		'type'=>'bordered', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'template' => '{items}{pager}',
//	'htmlOptions'=>array('class'=>'row-fluid cart_grid pull-left'), //cart_grid
		'columns' => array(
//'id',
							
							array(
													'name'=>'photo',
													'type'=>'raw',
													'value'=>'$data->getImage()',
							),
							array(
													'name'=>'product_id',
													'value'=>'GxHtml::valueEx($data->product)',
							),
							
							array(
													'name' => 'option',
													'header' => 'option',
													'value' => '$data->actions',
													'filter' => false,
													'type'=>'raw',
							),
							array(
													'name'=>'price',
													'value'=>'$data->getPrice()',
							
							),
/* 			array(
 'name' => 'quantity',
 'header' => 'Quantity',
 'class' => 'bootstrap.widgets.TbEditableColumn',
 'headerHtmlOptions' => array('style' => 'width:200px'),
 'editable' => array(
 'type' => 'text',
 'url' => $this->createUrl('editable')
 )
 ), */
				'quantity',

/*
 'session_id',
 array(
 'name' => 'state_id',
 'value'=>'$data->getStatusOptions($data->state_id)',
 'filter'=>Cart::getStatusOptions(),
 ),
 array(
 'name' => 'type_id',
 'value'=>'$data->getTypeOptions($data->type_id)',
 'filter'=>Cart::getTypeOptions(),
 ),
 'update_time',
 */
array(
						'class' => 'CxButtonColumn',
						'template'=>'{edit}',
						'header'=>'Update Product',
						'buttons'=>array(
								'edit'=>array(
										'label'=>'edit',
										'url'=>'Yii::app()->createUrl("product/info",array("id"=>$data->product->id))',
										'options'=>array( 'class'=>'btn btn-gray','title'=>'edit product'),
),
),
),
),
)); ?>

<div id="dynamic_grid">

	<ul class="cart_detail">

		<li><span class="cart_title">Sub Total</span> <span
			class="cart_description"><?php echo $subtotal.'$'; ?> </span>
		</li>

		<li><span class="cart_title">Coupan</span> <span
			class="cart_description">
				<div class="pull-left">
					<input type="text" id="c_code" name="coupon_code"
						class="span2 coupon_code" value="" />
						<?php echo CHtml::link('Apply','#',array('class'=>'btn btn-gray','onclick'=>'checkCoupon()')); ?>
				</div> <?php echo '- '.$model->coupon_amount .' $'; ?> </span>
		</li>

		<li><span class="cart_title">Gst</span> <span class="cart_description"><?php echo $gst.'$'; ?>
		</span>
		</li>

		<li><span class="cart_title">Postage </span> <span
			class="cart_description"> <?php echo CHtml::link('<i class="fa fa-plus-square"></i> &nbsp; ADD POSTAGE OPTION','#postage_opt',array('class'=>'btn pull-left',  'onclick'=>"showpostage()"));?>
			<?php echo $model->postage_charge.'$'; ?> </span>

			<div id="postage_opt" style="display: none;">

			<?php
			echo CHtml::radioButtonList('postage_id',$model,$model->addpostage(),array(
					'labelOptions'=>array('class'=>'span6'), // add this code
					'separator'=>'<hr> ',
					'id'=>$model->id,
			//'onclick'=>'checkPostage(this)'
			));
			?>
				<div class="clearfix"></div>

				<div class="form-action">
					<a class="btn btn-primary btn-orange"
						onclick='checkPostage(<?php echo $model->id;?> )'>Confirm</a> <a
						class="btn btn-primary btn-gray"
						onclick="$('#postage_opt').hide();">Cancel</a>
				</div>

			</div>
		</li>

		<li class="order_total"><span class="cart_title">Order Total</span> <span
			class="cart_description"><?php echo $model->amount.'$';?> </span>
		</li>
	</ul>

</div>




<div class="clearfix mar_top4"></div>

			<?php echo CHtml::link('Continue Shopping',array('company/view','id'=>$model->shop->id),array('class'=>'btn btn-gray'));?>
			<?php echo CHtml::link('Checkout',array('cart/checkout','cart_id'=>$model->id),array('class'=>'btn btn-gray pull-right'));?>

<script>
	function showpostage() {
	 $( "#postage_opt" ).slideToggle();
	}

	function checkPostage(id) {

		var postage_id = ($("input:radio:checked").val());
	
	$.ajax({
		url : "<?php  echo Yii::app()->createUrl('cart/updateCart');?>",
		type : "Post",
		data :{id : id ,postage_id : postage_id},
		success: function(data){
			$('#postage_opt').hide();
			$('#dynamic_grid').html(data);
		//	alert('Updated postage');
		},
		}); 
	}

	function checkCoupon() {
		var id = '<?php echo $model->id;?>';

		var code = $('#c_code').val();
		$.ajax({
			url : "<?php  echo Yii::app()->createUrl('cart/updateCoupon');?>",
			type : "Post",
			data :{id : id , code : code},
			success: function(data){
				if(data == 'error')
					alert('This coupon is not valid');
				else {
				}
			//$('#dynamic_grid').html(data);
			//	alert('Updated postage');
			},
			}); 
	}

	function changeSize(data){

		var size = data.value;
		var id = data.id;
	
		$.ajax({
			url : "<?php  echo Yii::app()->createUrl('cart/updateSize');?>",
			type : "Post",
			data :{id : id ,size : size},

			success: function(data){
				alert('Size updated successfully');
			},
			}); 
	
	}

</script>


