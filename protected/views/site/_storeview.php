

			<?php foreach($stores as $store)    {
				if($store->prodcounts > 0) {

					if(isset($store->image_file))
					{
						$logo = Yii::app()->createUrl('company/download',array('file'=>$store->image_file)) ;
					}
					else $logo = Yii::app()->theme->baseUrl.'/uploads/2013/brand-logo-50x50.jpg';

					?>
			<div class="span4 thumb">

				<div class="brick-header">


					<div class="shop_list_head">

						<div class="brand_logo">
							<img class="featured-thumb" src="<?php echo $logo; ?>"
								alt="image" style="">
						</div>

						<span class="blog_title"><?php echo $store->shop_name;?> </span>


						<?php if(Yii::app()->user->isGuest) { ?>
						<a href="<?php echo Yii::app()->createUrl('wishList/fav');?>"
							onclick="toggleFave(<?php echo $store->id. ','.WishList::TYPE_STORE?>)"><span
							class="rating pull-right"><span class="star"
								id="<?php echo 'fav_'.$store->id;?>"></span>
						
						</a>

						<?php }  else {
							$isfav = $store->myfav(WishList::TYPE_STORE); 
							if($isfav) $class= 'star_fill'; else $class= 'star'; 
						
						?>
						<a class="cursor"
							onclick="toggleFave(<?php echo $store->id. ','.WishList::TYPE_STORE?>)"><span
							class="rating pull-right"><span class="<?php echo $class;?>"
								id="<?php echo 'sfav_'.$store->id;?>"></span></span>
						
						</a>
						<?php }?>
					</div>

					<div class="mar_top2"></div>

					<div class="thumb-holder">

						<div class="new_tag"></div>


						<a class="featured-thumb-link"
							href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id))?>">
							<img class="featured-thumb"
							src="<?php echo Yii::app()->theme->baseUrl;?>/uploads/2013/1370997073a3ce2-200x220.jpg"
							alt="image" style="">
						</a>

					</div>

				</div>

				<div class="brick-footer">
					<span class="blog_content"> <?php echo $store->shop_slogan;?>
					</span>
				</div>

			</div>

			<?php  }
}?>
