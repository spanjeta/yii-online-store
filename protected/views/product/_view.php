
<div class="col-md-3 ">
	<div class="product">
	<div class="product-image-box">
	<a href="<?php echo $data->getUrl();?>">
	<?php if(!empty($data->thumbnail_file)){?>
	<img src="<?php echo $data->thumbnail_file;?>"
			class="placeholder placeholder-landscape width-full img-thumbnail"
			alt="">
			
		<?php }else if(!empty($data->getImage())){?>
			<?php $prodimages = ProductImage::model ()->findAllByAttributes ( array (
					'product_id' => $data->id 
			) );
			
		?>
			<img src="<?php echo $data->getImage();?>"
			<?php if(!empty($prodimages)){?>
	onmouseover="this.src='<?php
		$count = 0;
		foreach ($prodimages as $proimage){
			if($count === 0)
				echo  $proimage->getSecondImage();
			else 
				break;
			
			$count++;
		}
		?>'"
    onmouseout="this.src='<?php echo $data->getImage();?>'"
			class="placeholder placeholder-landscape width-full img-thumbnail"
			alt="">
			
	<?php }}else if(!file_exists($prodimage->image_path)){?>
			<img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/default.png" alt="">
	<?php }?>	
	</a>
	</div>
		<div class="product-inner">
		 <div class="actions products-wislist-item" id="product_<?php echo $data->id; ?>">
				<div class="rating">
					
						
						<?php //echo $data->avg_rating;?>
						<?php
				$this->widget ( 'CStarRating', array (
						
						'name' => 'rating_3' . $data->id,
						'minRating' => 1,
						'maxRating' => 5,
						'starCount' => 5,
						'value' => $data->avg_rating,
						'readOnly' => true 
				) );
				?>
						
					
				</div>
				<div class="add-to-wishlist">
					<?php $wishlist = WishList::getWishList($data->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="javascript:;" onclick="addWishList(<?php echo $data->id;?>)" id="add_wishlist_<?php echo $data->id;?>"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="javascript:;" onclick="addWishList(<?php echo $data->id;?>)" id="add_wishlist_<?php echo $data->id;?>"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
			</div>
			<p class="product-details text-center"><a href="<?php echo $data->getUrl();?>"><?php echo Yii::t('app', $data->title)?></a></p>
			<p class="product-price text-center">€ <?php echo $data->price?></p>
			<div class="middle">
				<?php if(Yii::app()->user->isGuest){?>
			<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
									<div class="text"><?php echo Yii::t('app','add to cart');?></div></a>
		<?php }else{?>
		<?php $cri = new CDbCriteria ();
		$cri->select = " SUM(quantity) as total_quantity";
		$cri->compare ( 'product_id', $data->id );
		$varproduct = VarProduct::model ()->find ( $cri );
		?>
		<?php if(!empty($varproduct) and $varproduct->total_quantity > 0) {?>
		<a href="javascript:;" onclick="addCart(<?php echo $data->id;?>)">
									<div class="text">
										<i class="fa fa-shopping-cart"></i><?php echo Yii::t('app','add to cart');?>
									</div>
								</a>
		
		<?php }else{?>
			<div class="text out_of_stock"><p><?php echo Yii::t('app','out of stock');?></p></div>
		<?php }?>	
								
    	<?php }?>

			</div>
		</div>
	</div>
</div>

