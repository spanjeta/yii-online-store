

    
    <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>

<section class="slider">
	<!--slider-->

	 <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/poster.png" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/poster.png" alt="Chicago" style="width:100%;">
                </div>
                <div class="item">
                    <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/poster.png" alt="New york" style="width:100%;">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


</section>


<section class="exclsive-products">
<div class="container">
<div class="row">
	<div class=" col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<div class="product-item-box-1">
		<img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/product-img.png"
						 />
		</div>
	</div>
	<div class=" col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<div class="product-item-box-1">
		<img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/product-img2.png"
						  />
		</div>
	</div>
	<div class=" col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<div class="product-item-box-1">
		<img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/product-img3.png"
						  />
		</div>
	</div>
	<div class=" col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<div class="product-item-box-1">
		<img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/product-img4.png"
						  />
		</div>
	</div>
	<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<div class="product-banner-box-1">
		<img class="img-responsive" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/foot-poster.png" />
		</div>
	</div>

</div>
	
</div>
</section>
<section>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<?php 
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'create_user_id = 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	$products = Product::model ()->findAll($criteria);
	//print_r($product);exit;
	
	?>	
		<h2 class="product-title text-center">New Arrivals</h2>
	 	<div class="owl-carousel owl-theme product_slider">
	 	<?php foreach ($products as $product){ ?>
              <div class="item relative">
        			<a href="<?php echo $product->getUrl();?>"><img src="<?php echo $product->thumbnail_file;?>"

												class="placeholder placeholder-landscape width-full img-thumbnail" height=275px width =275px>
												</a>

    			<div class="product-inner">
                    <div class="actions">
                        <div class="rating">
                            <ul class="list-inline">
               
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="add-to-wishlist">
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
                    </div>
    				<p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" ><i
													class="fa fa-shopping-cart"></i> <div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"><i
													class="fa fa-shopping-cart"></i> <div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
    					<span class="label-new">New!</span>
    		    </div>
    		  </div>
    		    <?php 	}
	?>
    		  
             
            </div>
          </div>
          </div>
       </div>
</section>

<section>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<?php 
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'is_featured = 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll($criteria);
	
	?>	
		<h2 class="product-title text-center">Feature Products</h2>
	 	<div class="owl-carousel owl-theme product_slider1">
	 	<?php foreach ($products as $product){  ?>
               <div class="item relative">
        		<a href="<?php echo $product->getUrl();?>">	<img src="<?php echo $product->thumbnail_file;?>"
												class="placeholder placeholder-landscape width-full img-thumbnail" height=275px width =275px>
               </a> <div class="product-inner">
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
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
                    </div>
                   <p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
                   
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" ></i> <div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"></i> <div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
    					<span class="label-new">New!</span>
    		    </div>
    		  </div>
    		    <?php 	}
	?>
    		  
             
            </div>
          </div>
          </div>
       </div>
</section>
<section class="section-margin">
<div class="container">
	<div class="row">
	
	<div class="col-md-12">
	<?php 
	$criteria = new CDbCriteria ();
//	$criteria->addCondition ( 'category_id = 3099' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll($criteria);
	
	
	?>	
	<div class="slider-outer clearfix">
		<div class="col-md-5">
            <div class="category-img-holder">
           <img src="<?php echo Yii::app()->theme->baseUrl?>/images/men.jpg" class="placeholder placeholder-landscape width-full img-responsive" alt="">
                <p class="caption text-center text-uppercase">Men's Clothing</p>
            </div>
		</div>
		<div class="col-md-7">
	 	<div class="owl-carousel owl-theme product_slider2">
	 	<?php foreach ($products as $product){ ?>
            <div class="item relative">
            <a href="<?php echo $product->getUrl();?>">
        			<img src="<?php echo $product->thumbnail_file;?>"
												class="placeholder placeholder-landscape width-full img-thumbnail" height=275px width =275px>
             </a>
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
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
                    </div>
                      
                      <p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" > <div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"> <div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
    					<span class="label-new">New!</span>
    		    </div>
    		  </div>
    		    <?php 	}
	?>
    		  
             
            </div>
          </div>
          </div>
       </div>
</section>


<section class="section-margin">
<div class="container">
	<div class="row">
	
	<div class="col-md-12">
	<?php 
	$criteria = new CDbCriteria ();
//	$criteria->addCondition ( 'category_id = 3099' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll($criteria);
	
	
	?>	
	<div class="slider-outer2 slider-outer clearfix">
		
		<div class="col-md-7">
	 	<div class="owl-carousel owl-theme product_slider3">
	 	<?php foreach ($products as $product){ ?>
              <div class="item relative">
              <a href="<?php echo $product->getUrl();?>">
                   <img src="<?php echo $product->thumbnail_file;?>"
												class="placeholder placeholder-landscape width-full img-thumbnail" height=275px width =275px>
             </a>   <div class="product-inner">
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
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
                    </div>
                     <p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" > <div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"> <div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
    					<span class="label-new">New!</span>
    		    </div>
    		  </div>
    		    <?php 	}
	?>
    		
                </div>
              </div>
    		 
          <div class="col-md-5">
        	<div class="category-img-holder right_align">
                <img src="<?php echo Yii::app()->theme->baseUrl?>/images/women.jpg" class="placeholder placeholder-landscape width-full img-responsive" alt="">
                <p class="caption text-center text-uppercase">WoMen's Clothing</p>
            
          </div>
          </div>
       </div>
</section>

<section>
<div class="container">
	<div class="row">
	<div class="col-md-12">
	<?php 
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'is_discount= 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll($criteria);
	
	?>	
		<h2 class="product-title text-center">Popular Products</h2>
	 	<div class="owl-carousel owl-theme product_slider4">
	 	<?php foreach ($products as $product){ ?>
               <div class="item relative">
        			<img src="<?php echo $product->thumbnail_file;//$product->getImage();?>"
												class="placeholder placeholder-landscape width-full img-thumbnail" height=275px width =275px>
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
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
                    </div>
                   <p class="product-details text-center"><a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a></p>
    				<p class="product-price text-center">€ <?php echo $product->price?></p>
    					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" ></i> <div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"></i> <div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
    					<span class="label-new">New!</span>
    		    </div>
    		  </div>
    		    <?php 	}
	?>
    		  
             
            </div>
          </div>
          </div>
       </div>
</section>


<section class="how-to">
<div class="container">
<div class="row">
	
	<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="offer-box-1">
		<div class="offer-box-inner">
		<i class="fa fa-star" aria-hidden="true"></i>
<i></i>
		<h1>10% OFF</h1>
		<h2>For first time customers on their  first order</h2>
		<h3>Use Coupon Code</h3>
		<h4>OFF25</h4>
		</div>
		</div>
	</div>
	<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="offer-box-1">
		<div class="offer-box-inner">
	<i class="fa fa-truck" aria-hidden="true"></i>


		<h1>Worldwide Delivery</h1>
		<h2>USA from $20 - free over $400 </h2>
		<h3>UK from $25 - free over $500</h3>
		
		</div>
		</div>
	</div>
	<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div class="offer-box-1">
		<div class="offer-box-inner">
	<i class="fa fa-mouse-pointer" aria-hidden="true"></i>

		<h1>Click To Connect</h1>
		<h2>1. Reserve and Shop Online </h2>
		<h2>2. We'll Pick your orders in 4 hours </h2>

		
	
		</div>
		</div>
	</div>

</div>
	
</div>
</section>


<section class="AboutUs">
<div class="container	 desc-box">
	
	<h1>Leading Clothing Wholesaler for Women's Fashion</h1>
	<p>Online Clothing is a British International Wholesaler of fast-fashion Womenswear and bespoke design positioned as the world’s premier business-to-business supplier that combines commerce and content. Our elevated editorials of future trend reports, celebrity get-the-looks, live analytics and consumer engagement will help you make better, well-advised buying decisions to deliver fashion-forward women’s clothing to your style conscious customers.

 Our dedicated team of designers, technicians and merchandisers work meticulously for retail multiples, independents and e-commerce, providing a tailored B2B service for each client. We also offer a made to order bespoke service that embodies our principal values of quality, exclusivity and speed.

 Luxury and high street’s push for the buy now, wear now cycle has increased the demand for speed, closing the time gap between runway, retail and wholesale. Our award-winning logistics and state of the art manufacturers, guarantee an unrivalled source and supply of ready-to-wear that’s ready to go. 

 Our international coverage of Fashion Week Spring/Summer '17 takes note of catwalk couture, celebrity-filled front rows and blogger’s street style. We take inspiration from the world’s most stylish ladies and tastemakers making our collection of dresses, coats and jackets sure-fire bestsellers. Our weekly update of new season clothes and ahead of the trend pre-orders will refresh your range. </p>

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
})
</script>