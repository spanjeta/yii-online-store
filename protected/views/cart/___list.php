<div class="total_items"></div>

<div class="clearfix mar_top2"></div>


<?php
/*
 * echo "<pre>";
 * print_r($dataProvider);
 * die();
 */
$this->widget ( 'bootstrap.widgets.TbGridView', array (
		'id' => 'cart-section',
		'type' => 'hover', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'template' => '{items}{pager}',
		// 'htmlOptions'=>array('class'=>'row-fluid cart_grid pull-left'), //cart_grid
		'columns' => array (
				// 'id',
				
				array (
						'name' => 'Product',
						'type' => 'raw',
						
						'value' => 'isset($data->product)?CHtml::image($data->product->thumbnail_file):""' 
				
				),
				array (
						'type' => 'raw',
						'name' => 'product name',
						// 'value'=>'GxHtml::valueEx($data->product)',
						
						'value' => '$data->product' 
				),

                       
                        
                      /*(  array (
							'name'=>'quantity', //
						        'value'=>'$data->quantity',
								'filter'=>false,
							      'class' => 'editable.EditableColumn',
								   'editable' => array(
									'type' => 'text',
									'inputclass'=>'form-control m-r-3',
									'url' => 'updateQuantity',
									'model'=>$model,
									'name'=>'sku',
                        )
                        ),*/
				
				array (
						
						'name' => 'quantity',
						'value' => '$data->quantity' 
					// 'value'=>'$data->getProductQuantity()',
				
				),
				array (
						// 'header' => '<a>Actions</a>',
						'class' => 'CxButtonColumn',
						'template' => '{ } {  }',
						'buttons' => array (
								' ' => array (
										'url' => 'Yii::app()->createUrl("cart/addquantity", array("id" => $data->id ))',
										'options' => array (
												'class' => 'fa fa-plus' 
										) 
								),
								'  ' => array (
										'url' => 'Yii::app()->createUrl("cart/subquantity", array("id" => $data->id ))',
										'options' => array (
												'class' => 'fa fa-minus' 
										) 
								) 
						
						) 
				),
				/*array (
						'class' => 'CButtonColumn',
						'template' => '{view}{delete}' 
					
				 * 'name'=>'quantity',
				 * 'value'=>'$data->quantity',
				 
					// 'value'=>'$data->getProductQuantity()',
				
				),*/
				array (
						'name' => 'Price (€)',
						'value' => ' "€ ".$data->amount' 
				
				) 
			/*
		 * array(
		 * 'class' => 'CxButtonColumn',
		 * 'template'=>'{delete}',
		 * 'header'=>'Delete Product',
		 *
		 * ),
		 */
		) 
) ); // htmlentities("&#36;") ?>

<div class="actions text-right">
	<ul class="list-inline">
		<li>
			<div class="form-group apply-coupon">
				<div class="input-group">
					<input type="text" class="form-control" required> <a
						class="btn btn-default">Apply Coupon</a>
				</div>
			</div>
		</li>
		<li><a class="btn btn-default">Update Cart</a></li>
	</ul>
</div>
<div id="dynamic_grid<?php echo $model->id; ?>">
	<div class="cart-section">
		<table class="table">
			<tr>
				<td><h5>Subtotal</h5></td>
				<td class="text-right"><h5>
						<strong><?php echo '€ '. $model->amount; ?></strong>
					</h5></td>
			</tr>
			<tr>
				<td><h5>Estimated shipping</h5></td>
				<td class="text-right"><h5>
						<strong>€ 0.00</strong>
					</h5></td>
			</tr>
			<tr>
				<td><h3>Total</h3></td>
				<td class="text-right"><h3>
						<strong><?php echo '€ '. $model->amount; ?></strong>
					</h3></td>
			</tr>
			<tr>
				<td></td>
				<td align="left">
                    	 <?php echo CHtml::link('Continue Shopping',array('site/index'),array('class'=>'btn btn-primary'));?>
                      </td>
				<td align="right"><a class="btn btn-success"> Proceed to Checkout <span
						class="glyphicon glyphicon-play"></span>
				</a></td>
			</tr>
		</table>
	</div>
</div>

<div class="clearfix mar_top4"></div>



<div class="clearfix mar_top4"></div>
<script>
	function showpostage(id) {
	var id = parseInt(id);
		
	 $( "#postage_opt_"+id ).slideToggle();
	}

	function checkPostage(id) {

		var postage_id = ($("input:radio:checked").val());
	
	$.ajax({
		url : "<?php  echo Yii::app()->createUrl('cart/updateCart');?>",
		type : "Post",
		data :{id : id ,postage_id : postage_id},
		success: function(data){
			$('#postage_opt_'+id).hide();
			$('#dynamic_grid'+id).html(data);
		//	alert('Updated postage');
		},
		}); 
	}

	function checkCoupon(id) {

		var id = parseInt(id);

		var code = $('#c_code').val();
		$.ajax({
			url : "<?php  echo Yii::app()->createUrl('cart/updateCoupon');?>",
			type : "Post",
			data :{id : id , code : code},
			success: function(data){

				if(data == 'error'){
	
					alert('This coupon is inValid');
			
				}
				else {

					$('#dynamic_grid'+id).html(data);
				}
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


