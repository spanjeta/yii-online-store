<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="clearfix"></div>
<div id="masonry">
	<div class="container">
		<?php
		foreach($stores as $store) {
			$logo_file = $store->getLogo();
			$img_file = $store->getImage();
			?>
		<div class="thumb">

			<div class="brick-header">

				<div class="shop_list_head">

					<a
						href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id))?>">
						<div class="brand_logo pull-left">
							<img class="featured-thumb" src="<?php echo $logo_file; ?>"
								alt="image">
						</div>
					</a> <a
						href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id))?>">
						<span class="blog_title pull-left"><?php echo $store->shop_name;?>
					</span>
					</a>

					<?php if(Yii::app()->user->isGuest) { ?>


					<a href="#" onclick="addData()" data-toggle="modal"
						data-target="#myModal"><span class="rating pull-right"><span
							class="star"></span> </span> </a>

					<?php } else {
						$isfav = $store->myfav(WishList::TYPE_STORE);
						if($isfav) $class= 'star_fill'; else $class= 'star';
						?>
					<a class="cursor pull-right"
						onclick="toggleFave(<?php echo $store->id. ','.WishList::TYPE_STORE?>)"><span
						class="rating pull-right"><span class="<?php echo $class;?>"
							id="<?php echo 'sfav_'.$store->id;?>"></span> </span> </a>
					<?php }?>

				</div>

				<div class="mar_top2"></div>

				<div class="thumb-holder">
					<?php $onsale = $store->showlabel();  if($onsale) {?>
					<div class="new_tag"></div>
					<?php }?>


					<a class="featured-thumb-link"
						href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id))?>">
						<img class="featured-thumb" src="<?php echo $img_file;?>"
						alt="image">
					</a>

				</div>

			</div>

			<div class="clearfix"></div>

			<div class="shop_brick_footer">
				<span class="blog_content"> <?php echo $store->shop_slogan;?>

					<div class='link pull-right'>
						<a
							href='<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id));?>'
							class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_STORE)?>
						</a>
					</div>

				</span>

			</div>

		</div>


		<?php }?>

	</div>
</div>


<script>
obj_ipin = {},
$(window).load(function(){   
	myrun();
				});


</script>
