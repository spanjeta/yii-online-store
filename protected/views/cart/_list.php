<div class="total_items"></div>

<div class="clearfix mar_top2"></div>

<div class="cart-container">
<?php
/*
 * echo "<pre>";
 * print_r($dataProvider);
 * die();
 */
$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => 'cart-section',
		'type' => 'hover', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'template' => '{items}{pager}',
		// 'htmlOptions'=>array('class'=>'row-fluid cart_grid pull-left'), //cart_grid
		'columns' => array (
				// 'id',
				
				array (
				'header' => Yii::t('app','product'),
						
						'type' => 'raw',
						
						'value' => 'isset($data->product->thumbnail_file)?CHtml::image($data->product->thumbnail_file):CHtml::image($data->product->getImage())',
						'htmlOptions' => array (
								'class' => 'cart-image',
								'height'=> '150'

						
						) 
				),
				array (
				'header' => Yii::t('app','product name'),
						'type' => 'raw',
						
						// 'value'=>'Html::valueEx($data->product)',
						
						'value' => '$data->product' 
				),
				array (
				'header' => Yii::t('app','color'),
						'type' => 'raw',
						
						// 'value'=>'Html::valueEx($data->product)',
						
						'value' => '$data->color' 
				),
				array (
				'header' => Yii::t('app','size'),
						'type' => 'raw',
						
						// 'value'=>'Html::valueEx($data->product)',
						
						'value' => '$data->size' 
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
				'header' => Yii::t('app','quantity'),
						
						'value' => '$data->quantity',
						'htmlOptions' => array (
								'id' => 'quantity' 
						) 
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
												'class' => 'fa fa-plus',
												'id' => 'plus' 
										
										) 
								),
								'  ' => array (
										'url' => 'Yii::app()->createUrl("cart/subquantity", array("id" => $data->id ))',
										'options' => array (
												'class' => 'fa fa-minus',
												'id' => 'minus' 
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
				'header' => Yii::t('app','price'),
						
						'value' => ' "€ ".$data->amount' 
				
				),
				array (
				'header' => Yii::t('app','actions'),
						'class' => 'CxButtonColumn',
						'template' => '{view} {delete}',
						'buttons' => array (
								'view' => array (
										'url' => 'Yii::app()->createUrl("/product/view", array("id" => $data->product_id ) )' 
								),
								'delete' => array (
										'url' => 'Yii::app()->createUrl("/cartItem/delete", array("id" => $data->id, "cart_id" => $data->cart_id ) )' 
								
								) 
						),
						'afterDelete' => 'function(link,success,data){
								    if(success) { // if ajax call was successful !!!
								            window.location.reload();
						
								    } else {
								        alert("Error! delete request failed, see console for mor info");
								        console.log(data);
								    }
								}' 
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

<div class="actions">
<div id="message"></div>
			<div class="form-group apply-coupon">
					<div class="input-group">
						<input type="text" class="form-control" id="promo-box"> 
						<a id="apply" class="btn btn-default"><?php echo Yii::t('app','apply coupon');?></a>							
					</div>
				</div>

			</li>

		</ul>
		<h3><?php echo Yii::t('app','available coupon');?></h3>
		<?php $coupons = PromoCode::model()->findAll();
		foreach ($coupons as $coupon){
		?>
		<h6><?php echo $coupon->code;?></h6>
		<?php }?>
	</div>

</div>
<div id="dynamic_grid<?php echo $model->id; ?>">
	<div class="cart-section">
		<table class="table">
			<tr>
				<td><h5><?php echo Yii::t('app','subtotal');?></h5></td>
				<td class="text-right"><h5>
						<strong><?php echo '€ '. $model->amount; ?></strong>
					</h5></td>
			</tr>
			<tr>
				<td><h5><?php echo Yii::t('app','estimated shipping');?></h5></td>
				<td class="text-right"><h5>
						<strong>€ 0.00</strong>
					</h5></td>
			</tr>
			<tr>
				<td><h5><?php echo Yii::t('app','discount amount');?></h5></td>
				<td class="text-right"><h5>
						<strong><span id="discount"></span></strong>
					</h5></td>
			</tr>
			<tr>
				<td><h3><?php echo Yii::t('app','total');?></h3></td>
				<td class="text-right"><h3>
						<strong><span id="total-price-now"></span><div id="hide"><?php echo '€ '. $model->amount; ?></div></strong>
					</h3></td>
			</tr>
			<tr>
				<td align="left">
                    	 <?php echo CHtml::link(Yii::t('app','continue shopping'),array('site/index'),array('class'=>'btn btn-primary'));?>
                      </td>
				<td align="right">
				<?php if(!Yii::app()->user->hasFlash('checkout_button')){?>	
				 <?php echo CHtml::link(Yii::t('app','check out'),array('cart/checkout','cart_id'=>$model->id),array('class'=>'btn btn-success pull-right'));?>
				<?php }?>
				</a>
	
	</td>
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
	
					alert('Este cupom é inValid');
			
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
				alert('Tamanho atualizado com sucesso');
			},
			}); 
	
	}
	
</script>



<script>


function applypromo(code){
	$.ajax({
		url:'<?= yii::app()->createAbsoluteUrl('promoCode/applyPromo')?>',
		data:{'code':code, 'amount': <?= $model->amount;?>},
		method:'get',
		
		"success":function(response){                
				
				var data = $.parseJSON(response);
				if(data.status == "OK") {
				var totalPrice = '€ '+data.totalPrice;
				var message = "<span style='color:green;'>"+data.message+"</span>";
				$("#message").html(message);
				
				 $("#response2").text(data.percentage); 
				 $("#success").text(data.success); 

				 
				 	$("#discount").text(data.discountPrice);
			 $("#total-price-now").text(totalPrice);
			 
				 
			 $("#hide").hide();
				}
				else
				{
					var message = "<span style='color:green;'>"+data.message+"</span>";
					$("#message").html(message);

					}
	         }
		
	});
}


$('#apply ').click(function()
{
	
	
	applypromo($('#promo-box').val());
});

</script>






