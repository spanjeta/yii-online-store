<script src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>

<section class="slider">
	<!--slider-->
<?php
$criteria = new CDbCriteria ();

$images = Banner::model ()->findAll ();
if (! empty ( $images )) {
	// var_dump($images);exit;
	
	?>
	 <div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
        		<?php
	$count = 0;
	foreach ( $images as $image ) {
		?>
        		<li data-target="#myCarousel"
				data-slide-to="<?php echo $count?>" <?php if($count == 0){?>
				class="active" <?php }?>></li>
        		<?php
		$count ++;
	}
	?>
        		
            </ol>
		<!-- Wrapper for slides -->
		<div class="carousel-inner">
                <?php
	$count = 0;
	foreach ( $images as $image ) {
		?>
                <div class="item <?php if($count==0){?>active<?php }?>">
				<a target="_blank" href="<?php echo $image->url;?>"> <img
					src="<?php
		
		echo Yii::app ()->createAbsoluteUrl ( 'product/download', array (
				'file' => $image 
		) );
		?>"
					alt="Los Angeles" style="width: 100%; height: 550px;">
				</a>
			</div>
               <?php
		$count ++;
	}
}
?>
            </div>
		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span> <span
			class="sr-only"><?php Yii::t('app', 'Previous')?></span>
		</a> <a class="right carousel-control" href="#myCarousel"
			data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only"><?php Yii::t('app', 'next')?></span>
		</a>
	</div>


</section>


<section class="exclsive-products mar-tp-1">
	<div class="container">
		<div class="">
		<div class="col-md-12">
		<div class="">
<?php
$criteria = new CDbCriteria ();
// $criteria->addCondition ( 'is_featured = 1' );
$criteria->order = 'id DESC';
$criteria->limit = 4;
$brands = Brand::model ()->findAll ( $criteria );

?>
<?php
if (! empty ( $brands )) {
	foreach ( $brands as $brand ) {
		?>
	<div class=" col-xs-12 col-sm-3 col-md-3 col-lg-3">
	<div class="row">
				<div class="product-item-box-1">
					<a
						href="<?php echo Yii::app()->createUrl('product/brandlist',array('id'=>$brand->id));?>">
		<?php if(!empty($brand->image_file) && $brand->image_file != null){?>
		<img class="img-responsive"
						src="<?php
			
			echo Yii::app ()->createAbsoluteUrl ( 'product/download', array (
					'file' => $brand->image_file 
			) );
			?>" />
		<?php }else {?>
			<img class="img-responsive"
						src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/no_image_available.jpeg" />
		<?php }?>
		</a>
				</div>
				</div>
			</div>
	<?php
	}
}
?>
	</div>
</div>
</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="">
			<div class="col-md-12">
			<div class="">
	<?php
	$criteria = new CDbCriteria ();
	// $criteria->addCondition ( 'create_user_id = 1' );
	$criteria->order = 'id DESC';
	$criteria->limit = 10;
	$products = Product::model ()->findAll ( $criteria );
	// print_r($product);exit;
	
	?>	
		<h2 class="product-title text-center"><?php echo Yii::t('app','new arrivals')?></h2>
				<div class="owl-carousel owl-theme product_slider">
	 	<?php foreach ($products as $product){ ?>
              <div class="item relative">
						<div class="product-image-box">
							<a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
		<?php }else{?>
		<?php
					
					$prodimages = ProductImage::model ()->findAllByAttributes ( array (
							'product_id' => $product->id 
					) );
					
					?>
			<img src="<?php echo $product->getImage();?>"
								<?php if(!empty($prodimages)){?>
								onmouseover="this.src='<?php
						$count = 0;
						foreach ( $prodimages as $proimage ) {
							if ($count === 0)
								echo $proimage->getSecondImage ();
							else
								break;
							
							$count ++;
						}
						?>'"
								onmouseout="this.src='<?php echo $product->getImage();?>'"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
			
			
	<?php }}?>	
	</a>
							<div class="middle">
    	<?php if(Yii::app()->user->isGuest){?>
			<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
									<div class="text"><?php echo Yii::t('app','add to cart');?></div></a>
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
										<i class="fa fa-shopping-cart"></i><?php echo Yii::t('app', 'view')?>
									</div></a>
			<?php }?>
		<?php }else{?>
			<div class="text out_of_stock"><p><?php echo Yii::t('app','out of stock');?></p></div>
		<?php }?>	
								
    	<?php }?>
  		</div>
						</div>

						<div class="product-inner">
							<div class="actions products-wislist-item"
								id="product_<?php echo $product->id; ?>">
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
                <?php if(Yii::app()->user->isGuest){?>
                	<a
										href="<?php echo Yii::app()->createUrl('user/login');?>"><i
										class="fa fa-heart-o"></i></a>
                <?php }else {?>
					<?php
					
					$wishlist = WishList::getWishList ( $product->id, Yii::app ()->user->id );
					if (empty ( $wishlist )) {
						?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart"></i></a>
					<?php } }?>
				</div>
							</div>
							<p class="product-details text-center">
								<a href="<?php echo $product->getUrl();?>"><?php echo Yii::t('app', $product->title)?></a>
							</p>
							<p class="product-price text-center">€ <?php echo $product->price?></p>

							<span class="label-new"><?php echo Yii::t('app','new');?></span>
						</div>

					</div>
    		    <?php
			}
			
			?>
    		  
      
            </div>
			</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
		<div class="">
			<div class="col-md-12">
			<div class="">
	<?php
	$criteria = new CDbCriteria ();
	// $criteria->addCondition ( 'is_featured = 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
	
	
	
		<h2 class="product-title text-center"><?php echo Yii::t('app','featured products')?></h2>
				<div class="owl-carousel owl-theme product_slider1">
	 	<?php foreach ($products as $product){  ?>
               <div class="item relative">
						<div class="product-image-box">
							<a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
		<?php }else{?>
			<img src="<?php echo $product->getImage();?>"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
	<?php }?>	
	</a>
					<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
									<div class="text"><?php echo Yii::t('app','add to cart');?></div></a>
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
						</div>
						
						<div class="product-inner">
							<div class="actions products-wislist-item"
								id="product_<?php echo $product->id; ?>">
								<div class="rating">
                            <?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_1' . $product->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $product->avg_rating,
						'readOnly' => true 
				) );
				?>
                        </div>
								<div class="add-to-wishlist">
                <?php if(Yii::app()->user->isGuest){?>
                	<a
										href="<?php echo Yii::app()->createUrl('user/login');?>"><i
										class="fa fa-heart-o"></i></a>
                <?php }else {?>
					<?php
					
					$wishlist = WishList::getWishList ( $product->id, Yii::app ()->user->id );
					if (empty ( $wishlist )) {
						?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart"></i></a>
					<?php } }?>
				</div>
							</div>
							<p class="product-details text-center">
								<a href="<?php echo $product->getUrl();?>"><?php echo Yii::t('app', $product->title)?></a>
							</p>

							<p class="product-price text-center">€ <?php echo $product->price?></p>

							<span class="label-new"><?php echo Yii::t('app','new');?></span>
						</div>
					</div>
    		    <?php
			}
			?>
    		  
             
            </div>
			</div>
			</div>
		</div>
	</div>
</section>
<section class="section-margin">
	<div class="container">
		<div class="">

			<div class="col-md-12">
			<div class="">
	<?php
	$criteria = new CDbCriteria ();
	// $criteria->addCondition ( 'category_id = 3099' );
	$criteria->order = 'id DESC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
	<div class="slider-outer clearfix">
	<div class="row">
					<div class="col-md-5">
						<div class="category-img-holder">
							<img src="<?php echo Yii::app()->theme->baseUrl?>/images/men.jpg"
								class="placeholder placeholder-landscape width-full img-responsive"
								alt="">
							<p class="caption text-center text-uppercase"><?php echo Yii::t('app','men clothing');?></p>
							
						</div>
					</div>
					<div class="col-md-7">
						<div class="owl-carousel owl-theme product_slider2">
	 	<?php foreach ($products as $product){ ?>
            <div class="item relative">
								<div class="product-image-box">
									<a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
										class="placeholder placeholder-landscape width-full img-thumbnail"
										alt="">
			
		<?php }else{?>
			<?php
					
					$prodimages = ProductImage::model ()->findAllByAttributes ( array (
							'product_id' => $product->id 
					) );
					
					?>
			<img src="<?php echo $product->getImage();?>"
										onmouseover="this.src='<?php
					$count = 0;
					foreach ( $prodimages as $proimage ) {
						if ($count === 0)
							echo $proimage->getSecondImage ();
						else
							break;
						
						$count ++;
					}
					?>'"
										onmouseout="this.src='<?php echo $product->getImage();?>'"
										class="placeholder placeholder-landscape width-full img-thumbnail"
										alt="">
			
	<?php }?>	
	</a>
									<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>">
											<div class="text"><?php echo Yii::t('app','add to cart');?></div>
											
										</a>
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
										<i class="fa fa-shopping-cart"></i><?php echo Yii::t('app','new');?>
									</div></a>
			<?php }?><?php }else{?>
			<div class="text out_of_stock"><p><?php echo Yii::t('app','out of stock');?></p></div>
		<?php }?>


			
											<?php }?>
    					
  						</div>
								</div>
								<div class="product-inner">
									<div class="actions products-wislist-item"
										id="product_<?php echo $product->id; ?>">
										<div class="rating">
                             <?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_2' . $product->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $product->avg_rating,
						'readOnly' => true 
				) );
				?>
                        </div>
										<div class="add-to-wishlist">
                <?php if(Yii::app()->user->isGuest){?>
                	<a
												href="<?php echo Yii::app()->createUrl('user/login');?>"><i
												class="fa fa-heart-o"></i></a>
                <?php }else {?>
					<?php
					
					$wishlist = WishList::getWishList ( $product->id, Yii::app ()->user->id );
					if (empty ( $wishlist )) {
						?>
					<a href="javascript:;"
												onclick="addWishList(<?php echo $product->id;?>)"
												id="add_wishlist_<?php echo $product->id;?>"><i
												class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;"
												onclick="addWishList(<?php echo $product->id;?>)"
												id="add_wishlist_<?php echo $product->id;?>"><i
												class="fa fa-heart"></i></a>
					<?php } }?>
				</div>
									</div>

									<p class="product-details text-center">
										<a href="<?php echo $product->getUrl();?>"><?php echo Yii::t('app', $product->title);?></a>
									</p>
									<p class="product-price text-center">€ <?php echo $product->price?></p>

									<span class="label-new"><?php echo Yii::t('app','new');?></span>
								</div>
							</div>
    		    <?php
			}
			?>
    		  
             
            </div>
					</div>
					</div>
				</div>
			</div>
			</div>

</section>
<section class="section-margin">
	<div class="container">
		<div class="">
			<div class="col-md-12">
			<div class="row">
	<?php
	$criteria = new CDbCriteria ();
	// $criteria->addCondition ( 'category_id = 3099' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
	<div class="slider-outer2 slider-outer clearfix">

					<div class="col-md-7">
						<div class="owl-carousel owl-theme product_slider3">
	 	<?php foreach ($products as $product){ ?>
              <div class="item relative">
								<div class="product-image-box">
									<a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
										class="placeholder placeholder-landscape width-full img-thumbnail"
										alt="">
			
		<?php }else{?>
			<?php
					
					$prodimages = ProductImage::model ()->findAllByAttributes ( array (
							'product_id' => $product->id 
					) );
					
					?>
			<img src="<?php echo $product->getImage();?>"
										onmouseover="this.src='<?php
					$count = 0;
					foreach ( $prodimages as $proimage ) {
						if ($count === 0)
							echo $proimage->getSecondImage ();
						else
							break;
						
						$count ++;
					}
					?>'"
										onmouseout="this.src='<?php echo $product->getImage();?>'"
										class="placeholder placeholder-landscape width-full img-thumbnail"
										alt="">
			
	<?php }?>	
	</a>
									<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
								<a href="<?php echo Yii::app()->createUrl('user/login');?>">
											<div class="text"><?php echo Yii::t('app','add to cart');?></div>
										</a>
							<?php } else { ?>
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
							<?php } ?>
    					
  						</div>
								</div>
								<div class="product-inner">
									<div class="actions products-wislist-item"
										id="product_<?php echo $product->id; ?>">
										<div class="rating">
                            <?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_3' . $product->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $product->avg_rating,
						'readOnly' => true 
				) );
				?>
                        </div>
										<div class="add-to-wishlist">
                <?php if(Yii::app()->user->isGuest){?>
                	<a
												href="<?php echo Yii::app()->createUrl('user/login');?>"><i
												class="fa fa-heart-o"></i></a>
                <?php }else {?>
					<?php
					
					$wishlist = WishList::getWishList ( $product->id, Yii::app ()->user->id );
					if (empty ( $wishlist )) {
						?>
					<a href="javascript:;"
												onclick="addWishList(<?php echo $product->id;?>)"
												id="add_wishlist_<?php echo $product->id;?>"><i
												class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;"
												onclick="addWishList(<?php echo $product->id;?>)"
												id="add_wishlist_<?php echo $product->id;?>"><i
												class="fa fa-heart"></i></a>
					<?php } }?>
				</div>
									</div>
									<p class="product-details text-center">
										<a href="<?php echo $product->getUrl();?>"><?php echo Yii::t('app', $product->title)?></a>
									</p>
									<p class="product-price text-center">€ <?php echo $product->price?></p>

									<span class="label-new"><?php echo Yii::t('app','new');?></span>
								</div>
							</div>
    		    <?php
			}
			?>
    		
                </div>
					</div>

					<div class="col-md-5">
						<div class="category-img-holder right_align">
							<img
								src="<?php echo Yii::app()->theme->baseUrl?>/images/women.jpg"
								class="placeholder placeholder-landscape width-full img-responsive"
								alt="">
							<p class="caption text-center text-uppercase"><?php echo Yii::t('app','feminine clothes');?></p>

						</div>
					</div>
				</div>
</div>
			</div>
		</div>
	</div>
</section>

<section class="section-margin">
	<div class="container">
		<div class="">
			<div class="col-md-12">
			<div class="">
	<?php
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'is_discount = '.Product::DISCOUNT_ACTIVE );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
		<h2 class="product-title text-center"><?php echo Yii::t('app','popular products')?></h2>
				<div class="owl-carousel owl-theme product_slider4">
	 	<?php foreach ($products as $product){ ?>
               <div class="item relative">
						<div class="product-image-box">
							<a href="<?php echo $product->getUrl();?>">
	<?php if(!empty($product->thumbnail_file)){?>
	<img src="<?php echo $product->thumbnail_file;?>"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
		<?php }else{?>
			<?php
					
					$prodimages = ProductImage::model ()->findAllByAttributes ( array (
							'product_id' => $product->id 
					) );
					
					?>
			<img src="<?php echo $product->getImage();?>"
								onmouseover="this.src='<?php
					$count = 0;
					foreach ( $prodimages as $proimage ) {
						if ($count === 0)
							echo $proimage->getSecondImage ();
						else
							break;
						
						$count ++;
					}
					?>'"
								onmouseout="this.src='<?php echo $product->getImage();?>'"
								class="placeholder placeholder-landscape width-full img-thumbnail"
								alt="">
			
	<?php }?>	
	</a>

							<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
									<div class="text"><?php echo Yii::t('app','add to cart');?> </div></a>
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
						</div>
						<div class="product-inner">
							<div class="actions products-wislist-item"
								id="product_<?php echo $product->id; ?>">
								<div class="rating">
									   <?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_4' . $product->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $product->avg_rating,
						'readOnly' => true 
				) );
				?>
								</div>
								<div class="add-to-wishlist">
                <?php if(Yii::app()->user->isGuest){?>
                	<a
										href="<?php echo Yii::app()->createUrl('user/login');?>"><i
										class="fa fa-heart-o"></i></a>
                <?php }else {?>
					<?php
					
					$wishlist = WishList::getWishList ( $product->id, Yii::app ()->user->id );
					if (empty ( $wishlist )) {
						?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;"
										onclick="addWishList(<?php echo $product->id;?>)"
										id="add_wishlist_<?php echo $product->id;?>"><i
										class="fa fa-heart"></i></a>
					<?php } }?>
				</div>
							</div>
							<p class="product-details text-center">
								<a href="<?php echo $product->getUrl();?>"><?php echo Yii::t('app', $product->title)?></a>
							</p>
							<p class="product-price text-center">€ <?php echo $product->price?></p>

							<span class="label-new"><?php echo Yii::t('app','new');?></span>
						</div>
					</div>
    		    <?php
			}
			?>
    		  
             
            </div>
			</div>
		</div>

</section>


<section class="how-to">
	<div class="container">
		<div class="">
		<div class="col-md-12">
		<div class="">

			<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="offer-box-1">
					<div class="offer-box-inner">
						<i class="fa fa-star" aria-hidden="true"></i> <i></i>
						<h1>10% DE DESCONTO</h1>
						<h2>Para clientes da primeira vez em sua primeira ordem</h2>
						<h3>Use o código do cupom</h3>
						<h4>OFF25</h4>
					</div>
				</div>
				
			</div>
			<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
		
				<div class="offer-box-1">
					<div class="offer-box-inner">
						<i class="fa fa-truck" aria-hidden="true"></i>


						<h1>Entrega em todo o mundo</h1>
						<h2>EUA de US $ 20 - grátis mais de US $ 400</h2>
						<h3>Reino Unido de US $ 25 - grátis mais de US $ 500</h3>

					</div>
				</div>
				
			</div>
			<div class=" col-xs-12 col-sm-12 col-md-4 col-lg-4">
			
				<div class="offer-box-1">
					<div class="offer-box-inner">
						<i class="fa fa-mouse-pointer" aria-hidden="true"></i>

						<h1>Clique para se conectar</h1>
						<h2>1. Reserve e compre online</h2>
						<h2>2. Escolheremos suas encomendas em 4 horas</h2>



					</div>
				</div>
			
</div>
		</div>
</div>
</div>
	</div>
</section>


<section class="AboutUs">
	<div class="container	 desc-box">
	<div class="">
<div class="col-md-12">
<div class="">
		<h1>
		
		Grossista de roupas principais para moda feminina</h1>
		<p>Online Clothing é um atacadista internacional britânico de
Moda feminina de moda rápida e design personalizado, posicionado como o mundo
Fornecedor principal de empresa para empresa que combina comércio e
conteúdo. Nossos editoriais elevados de relatórios de tendências futuras, celebridades
As análises ao vivo, as análises ao vivo e o envolvimento do consumidor irão ajudá-lo
Faça decisões de compra melhores e bem-aconselhadas para entregar moda para frente
Roupas femininas para seus clientes conscientes de estilo. Nosso dedicado
Equipe de designers, técnicos e comerciantes trabalham meticulosamente
Para múltiplos de varejo, independentes e comércio eletrônico, fornecendo um
Serviço B2B sob medida para cada cliente. Nós também oferecemos um pedido por encomenda
Serviço personalizado que incorpora nossos principais valores de qualidade,
Exclusividade e velocidade. O impulso de luxo e rua para comprar agora,
Agora o ciclo de uso aumentou a demanda de velocidade, fechando o tempo
Intervalo entre pista, varejo e atacado. Nossa premiada logística
E fabricantes de estado da arte, garantem uma fonte incomparável
E fornecimento de pronto-a-vestir que está pronto para ir. Nosso internacional
Cobertura da Fashion Week Spring / Summer '17 toma nota da passarela
Couture, filas dianteiras cheias de celebridades e estilo de rua do blogger. Nós
Inspire-se das damas e provas de moda mais elegantes do mundo
Fazendo nossa coleção de vestidos, casacos e jaquetas com certeza-fogo
mais vendidos. Nossa atualização semanal de roupas da nova temporada e à frente do
As pré-encomendas de tendências irão atualizar seu alcance.</p>

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
})
</script>
