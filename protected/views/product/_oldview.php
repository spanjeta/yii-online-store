<script type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/lightbox/js/lightbox.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/lightbox/css/lightbox.css" />
<section class="main_wrapper">
	<div class="internal-p-section">
		<div class="container">
			<div class="row">
			<?php
			$prodimages = ProductImage::model ()->findAllByAttributes ( array (
					'product_id' => $model->id 
			) );
			
			?>
					
				<div class="col-lg-5 col-md-5 product-slider">
					<div id='carousel-custom' class='carousel slide'
						data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
					<?php
					if (isset ( $prodimages )) {
						$count = 0;
						foreach ( $prodimages as $prodimage ) {
							
							?>
			        <div <?php if($count==0){?> class='item active'
						<?php }else{?> class='item' <?php }?> 
						<?php if($count==1){?>
							id="zoom_05" <?php }
							?>>
									<img src='<?php echo $prodimage->getProImage();?>' alt=''
										data-zoom-image="<?php echo $prodimage->getProImage();?>"
										id="zoom_05" />
								</div>
					 <?php
							$count ++;
						}
					}
					?>       
					            <!-- <div class='item active'>
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/print/image1xxl.jpg' alt=''  data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/print/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'  id="zoom_05">
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg" id="zoom_05"/>
					            </div>
					                
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpgg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpg" id="zoom_05"/>
					            </div> -->
							</div>
						</div>
						<script>
						  $("#zoom_05").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });
						</script>
						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
					   <?php
								if (isset ( $prodimages )) {
									$count = 0;
									foreach ( $prodimages as $prodimage ) {
										?>
					        <li data-target='#carousel-custom'
								data-slide-to='<?php echo "".$count;?>' <?php if($count==0){?>
								class='active' <?php }?>><img
								src='<?php echo $prodimage->getProImage();?>' alt='' /></li>
							<!--  <li data-target='#carousel-custom' data-slide-to='1'><img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='2'><img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='3'><img src='http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='4'><img src='http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='5'><img src='http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='6'><img src='http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpg' alt='' /></li> -->
						<?php
										$count ++;
									}
								}
								?>
					    </ol>
					</div>
				</div>
				<div class="p-right-column col-lg-7 col-md-7 product-description">
					<h1 class="cart-detail1"><?php echo $model->title;?></h1>
					<p class="detail-price">$<?php echo $model->price;?></p>
					<p class="detail-price1"><?php echo $model->description?></p>
					<ul class="detail-price2">
						<li>Formal Print</li>
						<li>Formal Print</li>
						<li>Formal Print</li>
					</ul>
					<div class="row">
						<div class="col-md-6">
							<div class="product-attributes-label label1">
								<select class="color-btn">

									<option><?php echo $model->color;?></option>

								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="product-attributes-label label1">
								<select class=" color-btn">
									<option><?php echo $model->size;?></option>
								</select>
							</div>
						</div>
					</div>




					<div class="cart-add">
						<div class="row product-actions">
							<div class="col-md-6">
								<a href="" class="cart-wishlist form-control"><i
									class="fa fa-heart"></i> Add to wishlist</a>
							</div>
							<div class="col-md-6">
								<!-- <a href="" class="cart-wishlist form-control"><i class="fa fa-shopping-cart"></i> Add to cart</a> -->
							<?php //echo CHtml::link('Add to cart',array('site/register'),array('class'=>'cart-wishlist form-control fa fa-shopping-cart',  )); ?>
							<?php if(Yii::app()->user->isGuest){?>
									<a href="<?php echo Yii::app()->createUrl('user/login');?>" class="cart-wishlist form-control fa fa-shopping-cart">
										Add To Cart
									</a>
											<?php }else{?>
												 <div>
									<a href="#" onclick="addCart(<?php echo $model->id;?>)"
										class="cart-wishlist form-control fa fa-shopping-cart">Add To Cart</a>
								</div>
											<?php }?>
							</div>
							<div class="middle"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel-group" id="accordion" role="tablist"
								aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseOne" aria-expanded="true"
												aria-controls="collapseOne"> Delivery & Returns </a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in"
										role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">Anim pariatur cliche reprehenderit,
											enim eiusmod high life accusamus terry richardson ad squid.le
											VHS.</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
	<?php
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'is_featured = 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
		<h2 class="product-title text-center">Feature Products</h2>
						<div class="owl-carousel owl-theme product_slider1">
	 	<?php foreach ($products as $product){  ?>
               <div class="item relative">
								<img src="<?php echo $product->thumbnail_file;?>"
									class="placeholder placeholder-landscape width-full img-thumbnail"
									height=275px width=275px>
								<div class="product-inner">
									<div class="actions">
										<div class="rating">
											<ul class="list-inline">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<div class="add-to-wishlist">
											<a href="#"><i class="fa fa-heart"></i></a>
										</div>
									</div>
									<p class="product-details text-center">
										<a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a>
									</p>

									<p class="product-price text-center">€ <?php echo $product->price?></p>
									<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
											<div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"></i>
											<div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
									<span class="label-new">New!</span>
								</div>
							</div>
    		    <?php
			
}
			?>
    		  
             
            </div>
					</div>
				</div>
			</div>
		</section>
	</div>
</section>


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