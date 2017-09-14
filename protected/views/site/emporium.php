
<div class="row-fluid ">

	<div class="span12"></div>

	<div class="mar_top2 cleafix"></div>

	<div class=" blog_container">

		<div class="blog_con_inner">


			<?php if($emporiums) { 
				foreach($emporiums as $emporium) {

					if(isset($emporium->image_file) && !empty($emporium->image_file))
						$imgset = Yii::app()->createUrl('emporium/download',array('file'=>$emporium->image_file));
					else
						$imgset = Yii::app()->theme->baseUrl.'/uploads/2013/1370997073a3ce2-200x220.jpg'
							?>

			<div class="span4 thumb">

				<div class="brick-header">

					<?php if(Yii::app()->user->isGuest) { ?>
					<a href="<?php echo Yii::app()->createUrl('wishList/fav');?>"><span
						class="rating pull-right"><span class="star"></span> </span> </a>

					<?php }  else {
						$isfav = $emporium->myfav(WishList::TYPE_EMPORIUM);
						if($isfav) $class= 'star_fill'; else $class= 'star';

						?>
					<a class="cursor"
						onclick="toggleFave(<?php echo $emporium->id. ','.WishList::TYPE_EMPORIUM?>)"><span
						class="rating pull-right"><span class="<?php echo $class;?>"
							id="<?php echo 'efav_'.$emporium->id;?>"></span>
					</a> <?php }?>
					
					<div class="emporium_list_head"></div>

					<div class="thumb-holder">

						<a class="featured-thumb-link"
							href="<?php echo Yii::app()->createUrl('emporium/info',array('id'=>$emporium->id));?>">
							<img class="featured-thumb" src="<?php echo $imgset ;?>"
							alt="image" style="">
						</a>

					</div>


				</div>

				<div class="brick-footer">

					<div class="blog_content span12">

						<strong class="post_name"><?php echo $emporium->title;?> </strong>

						<div class="product_name">
							<?php echo $emporium->productcount. ' tagged products'; ?>
						</div>
						<div class="clearfix mar_top1"></div>
						<p class="Shop_name pull-left">
							<?php echo $emporium->createUser->company->company_name; ?>
						</p>



						<div class="pull-right product_price">

							<p class="old_price">
								<i class="fa fa-star "></i> 
									<?php echo $emporium->starCount(); ?>
							</p>


						</div>

					</div>

				</div>

			</div>


			<?php } 
}?>
			<!------            ------->




		</div>



	</div>

</div>
<!----------- ROW-FLUID -------------->





