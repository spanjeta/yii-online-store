<script type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/lightbox/js/lightbox.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/lightbox/css/lightbox.css" />
<section class="main_wrapper">
	<div class="internal-p-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5">
					<div>
						<a href="<?php echo $model->image_file;?>" data-title=""
							data-lightbox="example-set"> <img class="img-responsive"
							src="<?php echo $model->image_file;?>" alt="image-1"
							id="product_image" />
						</a>
					</div>

				</div>
				<div class="p-right-column col-lg-7 col-md-7">
					<h1 class="product-name"><?php echo $model->title;?></h1>
					<div class="product-comments">
						<div class="product-star">
							<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
								class="fa fa-star"></i> <i class="fa fa-star"></i> <i
								class="fa fa-star-half-o"></i>
						</div>

						<div class="comments-advices">
							<a href="#">Based on 3 ratings</a> <a href="#"><i
								class="fa fa-pencil"></i> write a review</a>
						</div>
					</div>

					<div>
                
                  <?php
																		
																		$prices = $product->getProductPrices ();
																		if ($prices != null) {
																			?>
																			<form id="cart-form" method="post">
                    <table class="table table-bordered">
							<tr>
								<th></th>
                  <?php foreach($prices as $price){?>
                  <?php if($price->max_quantity != 0){?>
                   <th> <?php echo $price->min_quantity;?>-<?php echo $price->max_quantity?>
                   
                  </th>
                  <?php }else{?>
                   <th> <?php echo $price->min_quantity;?>+
                   
                  </th>
                  <?php }?>
                  <?php }?>
                  </tr>
                    <?php
																			
																			$sizes = $model->getProductSizeOptions ();
																			if ($sizes != null) {
																				?>
																					
																					<?php
																				$i = 0;
																				foreach ( $sizes as $key => $size ) {
																					$amount = $product->getProductSizePrice ( $size );
																					$size_id = $model->getProductSizeID ( $size );
																					?><tr>
																						<?php //if($key == $i){?>
																						<td><?php echo $size;?></td>
																						
																						<?php
																					$i = $i + 1;
																					// }
																					?>
																					<?php
																					
																					foreach ( $prices as $price ) {
																						$product_price = $amount + ($amount) * ($price->discount) / 100?>
                  <td> <?php echo 'R '.round($product_price,2);?>
                  </td>
                  <?php
																					}
																					?>
																					<td><input type="text" id="quantity"
									name="size[<?php echo $size_id ?>]"></td>
																					</tr>
                       <?php }?>
                       <?php }?>
                  
                  </table>
                   </form>
                  <?php }?>
                  </div>

					<div class="item-info">
						<p>Item Code: #<?php echo $model->product_code;?></p>
                     <?php
																					
																					$brand = Brand::model ()->findByPk ( $model->brand_id );
																					?>
                     <p>Brand: <?php echo isset($brand)?$brand->title:'';?><span
								class="in-stock"></span>
						</p>

					</div>

					<div class="product-desc">
                       <?php echo $product->description;?>
                      </div>
					<div class="product-desc">
						Quantity : <input type="number" name="quantity" value="1"
							id="product_quantity">
					</div>
					<div class="form-option">
						<p class="form-option-title">Attribuites:</p>
						<div class="row">
							<div class="col-md-4">
								<div class="product-attributes">
									<div class="product-attributes-label">
                          
                           <?php
																											
																											$colors = $model->getProductColorOptions ();
																											?>
                    
                       <select style="width: 125px;" id="color_code"
											onchange="changeAttribute()">
											<option value="<?php echo $model->color_id;?>"><?php echo $model->getProductColor(); ?></option>
                       <?php
																							
																							$colors = $model->getProductColorOptions ();
																							
																							foreach ( $colors as $key => $color ) {
																								?>
	<option value="<?php echo $key;?>"><?php echo $color; ?></option>
	<?php }?>
	

</select>
									</div>
								</div>
							</div>


						</div>
					</div>


					<div class="clearfix"></div>


					<div class="pin-heading">

						<a href="#" class="btn btn-warning">Buy Now</a>
                         <?php if(Yii::app()->user->isGuest){?>
                          <a
							href="<?php echo Yii::app()->createUrl('user/login');?>"
							class="btn btn-primary" onclick="addtoCart()">Add to Cart</a>
                         <?php }else{?>
                         <a href="#" class="btn btn-primary"
							onclick="addtoCart()">Add to Cart</a>
                         <?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<section class="related-section">
		<div class="container">
			<div class="box">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h2 class="related">related Products</h2>
					</div>
			
			<?php
			
			foreach ( $relatedProducts as $prod ) {
				if ($prod->thumbnail_file != '') {
					?>
			
			<div class="col-lg-2 col-md-2">
						<div class="related-box-a">
							<a href="<?php echo $prod->getUrl();?>"> <img
								class="img-responsive" src="<?php echo $prod->thumbnail_file;?>" />

							</a>
							<p><?php echo $prod->color;?></p>

						</div>

					</div>
			
			<?php }}?>
					<?php if($product->thumbnail_file != ''){?>
			<div class="col-lg-2 col-md-2">
						<div class="related-box-a">
							<a href="<?php echo $product->getUrl();?>"> <img
								class="img-responsive"
								src="<?php echo $product->thumbnail_file;?>" />

							</a>
							<p><?php echo $product->color;?></p>

						</div>

					</div>
			<?php }?>	
			
			</div>



			</div>
		</div>

	</section>
	<section class="support">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="support-inner">
						<h2>Have a question?</h2>
						<p>Get answers from experts and customers who have used this item.</p>
						<div class="contact">
							<a href="#" class="btn btn-primary ask-question">Submit a request</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</section>





</section>
<script>
function changeAttribute(){
	var id = <?php echo $model->id?>;
	var val = $('#color_code').val();
	$.ajax({
        url: "<?php echo Yii::app()->createUrl("product/searchVariant")?>/id/"+id,
        type: "POST",
        data : {color:val},
        success: function(response){
   	        if(response.status == 'OK'){  
	   	      if(response.image != 'null'){
	   	    	 $('#product_image').attr('src',response.image);
        	}
        	
    	}
        }
	});
}
function addtoCart(){
	
	
	var id = <?php echo $model->id;?>;
	var quantity = $('#product_quantity').val();
	var size = $('#size').val();
	 var postData = $('#cart-form').serializeArray();
	$.ajax({
    url: "<?php echo Yii::app()->createUrl("cart/varAdd")?>/id/"+id,
    type: "post",
    data: postData,
   success: function(response){
	        if(response.status == 'OK'){  
   	       alert("Item is added to cart, Continue shopping");  
   			location.reload();
    	}else {
    	
    			alert(response.error);
    	}
    	 
    
	}
});
}

</script>