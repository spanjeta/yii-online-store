<script  src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>		
<section class="section-margin">		
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<?php 
	//$criteria = new CDbCriteria ();
	//$criteria->addCondition ( 'create_user_id = 1' );
	//$criteria->order = 'id ASC';
	//$criteria->limit = 10;
	//$products = Product::model ()->findAll($criteria);
	//print_r($product);exit;
	
	?>	
		<h2 class="product-title text-center"><?php echo Yii::t('app','wish list');?></h2>
	 	<div class="owl-carousel owl-theme product_slider1">
	 	<?php 
	 	$prod_id = array();
		if(!empty($relatedProducts)){
		 	foreach ($relatedProducts as $relatedProduct){
		 		$prod_ids [] = $relatedProduct->model_id;
		 	}
		 	foreach ($prod_ids as $prod_id){
			 	$products[] = Product::model()->findByAttributes(array(
			 			'id' => $prod_id
			 	));
		 	}
	 	}
	 	?>
	 	<?php if(!empty($products) && !empty($prod_ids)) { ?>
	 	<?php foreach ($products as $product){ ?>
              <div class="item relative wishlist-item"  id="delete_wishlist_prodcut_<?php echo $product->id ?>" >
        			   <a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
			class="placeholder placeholder-landscape width-full img-thumbnail"
			alt="">
			
		<?php } else { ?>
			<img src="<?php echo $product->getImage();?>"
			class="placeholder placeholder-landscape width-full img-thumbnail"
			alt="">
			
	<?php }?>	
	</a>
		<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>

								<a href="<?php echo Yii::app()->createUrl('user/login');?>" ></i> <div class="text"><?php echo Yii::t('app','add to cart');?></div></a>
							<?php }else{?>
		<?php $cri = new CDbCriteria ();
		$cri->select = " SUM(quantity) as total_quantity";
		$cri->compare ( 'product_id', $product->id );
		$varproduct = VarProduct::model ()->find ( $cri );
		?>
		<?php if(!empty($varproduct) and $varproduct->total_quantity > 0) {?>
		<?php if($product->type_id == Product::TYPE_SIMPLE) {?>
			<a href="javascript:;" onclick="addCart(<?php echo $product->id;?>)">
									<div class="text">
										<i class="fa fa-shopping-cart"></i><?php echo Yii::t('app','add to cart');?>
									</div>
								</a>
			<?php }else{?>
				<a href="<?php echo $product->getUrl();?>"><div class="text">
										<i class="fa fa-shopping-cart"></i><?php echo Yii::t('app','view');?>
									</div></a>
			<?php }?>
		<?php }else{?>
			<div class="text out_of_stock"><p><?php echo Yii::t('app','out of stock');?></p></div>
		<?php }?>	
								
    	<?php }?>

    					
  						</div>
  						
    			<div class="product-inner">
                   <div class="actions products-wislist-item" id="product_<?php echo $product->id; ?>">
                        <div class="rating">
                     <?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_0' . $product->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $product->avg_rating,
						'readOnly' => true 
				) );
				?>
                        </div>
                        <div class="add-to-wishlist">
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="javascript:;" class="remove-from-wishlist" id="remove_wishlist_item_<?= $product->id ?>" data-id="<?= $product->id ?>" data-type="delete" ><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;" class="remove-from-wishlist" id="remove_wishlist_item_<?= $product->id ?>" data-id="<?= $product->id ?>" data-type="delete" ><i class="fa fa-heart"></i></a>

					<?php } ?>
				</div>
                    </div>
    				<p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					
    					<span class="label-new"><?php echo Yii::t('app','liked product');?>!</span>
    		    </div>
    		  </div>
    		    <?php 	} } else { ?>
	    		    <div class="col-md-12" id="default_product">
	    		    	<div class="cart-section">
							<table class="table">
								
								<tr>
									<td class="text-center"><h3><?php echo Yii::t('app','no item found in the cart'); ?></h3></td>
									
								</tr>
								<tr>
									<td align="left">
					                    	 <?php echo CHtml::link('Continue Shopping',array('site/index'),array('class'=>'btn btn-primary'));?>
					                      </td>
								</tr>
							</table>
						</div>
	    		    </div>
    		    <?php }	?>
    		    
    		    <div class="col-md-12" style="display:none" id="default_product">
	    		    	<div class="col-md-12">
							<table class="table">
								
								<tr>
									<td class="text-center"><h3><?php echo Yii::t('app','no item found in the wishList'); ?></h3></td>
									
								</tr>
						<tr>
				<td align="left">
				
                    	 <?php echo CHtml::link(Yii::t('app','continue shopping'),array('site/index'),array('class'=>'btn btn-primary'));?>
                      </td>
						</tr>
							</table>
						</div>
	    		    </div>
    		    
            </div>
          </div>
          </div>
       </div>

</section>


<script type="text/javascript">
$('.product_slider').owlCarousel({
    loop: true,
    margin: 10,
    items:4,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
</script>
<script type="text/javascript">
$('.product_slider1').owlCarousel({
    loop: true,
    margin: 10,
    items:4,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
</script>
<script type="text/javascript">
$('.product_slider2').owlCarousel({
    loop: true,
    margin: 10,
    items:3,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
</script>
<script type="text/javascript">
$('.product_slider3').owlCarousel({
    loop: true,
    margin: 10,
    items:3,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
})
</script>
<script type="text/javascript">
$('.product_slider4').owlCarousel({
    loop: true,
    margin: 10,
    pagination: true,
    items:4,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
});

$(".remove-from-wishlist").click(function () {
	var id = $(this).attr('data-id');

	$.ajax({
	    url: "<?php echo Yii::app()->createUrl("cart/addWishList")?>/id/"+id,
	    global:false,
	    success: function(response) {
		    if( typeof response.count != 'undefined' ) {
			    if( response.count != '' && response.count != 0 ) {
			    	$("#total_wishlist_count").html('');
					$("#total_wishlist_count").html('<i class="fa fa-heart"></i><sup>'+response.count+'</sup>');
				} else {
					$("#total_wishlist_count").html('');
					$("#total_wishlist_count").html('<i class="fa fa-heart-o "></i>');
				}

				if(  typeof response.status != 'undefined' && response.status == 'OK'  ) {
					$("#add_wishlist_"+id).html("");
					$("#add_wishlist_"+id).html('<i class="fa fa-heart"></i>');
				}

				if(  typeof response.status != 'undefined' && response.status == 'NOK'  ) {
					$("#add_wishlist_"+id).html("");
					$("#add_wishlist_"+id).html('<i class="fa fa-heart-o"></i>');
				}
			    
				if( typeof response.error != 'undefined' && response.error != '' ) {

					var $html = '<div id="product_message_'+id+'" class="alert alert-success alert-dismissable">';

					$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					$html += '<strong>Success!</strong> '+response.error+' </div>';

					
					$('#product_'+id).parent( ).after($html);

					$( '#product_message_'+id ).fadeOut( 8000, "linear" );
				}
			}

			$("#delete_wishlist_prodcut_"+id).remove();

			var length = $( ".wishlist-item" ).length;
			
			if( length <= 0 ) {
				$("#default_product").show();
			}
		}
	});
});

</script>
