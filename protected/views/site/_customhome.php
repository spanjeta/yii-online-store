<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="clearfix"></div>

<?php if($sitehomes) {

	foreach($sitehomes as $sitehome) { ?>

	<?php if($sitehome->type_id == WishList::TYPE_PRODUCT) {

		$product = $sitehome->product;

		if($product && $product->images) {
			$image = $product->getImage(); ?>

<div class="hentry thumb">

	<div class="brick-header">
		<div class="thumb-holder">
		
		<div class="masonry-actionbar">

		<p><?php echo $product->title;?></p>
		
       <p> <a href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$product->company->id))?>">
		 <?php echo $product->company->shop_name;?></a></p>
	
			<?php if(Yii::app()->user->isGuest) { ?>
			<a href="#" onclick="addData()" data-toggle="modal"
				data-target="#myModal"><span class="rating pull-right"><span
					class="star"></span> </span> </a>

					<?php }  else {
						$isfav = $product->myfav(WishList::TYPE_PRODUCT);
						if($isfav) $class= 'star_fill'; else $class= 'star';

						?>
			<a class="cursor"
				onclick="toggleFave(<?php echo $product->id. ','.WishList::TYPE_PRODUCT?>)"><span
				class="rating pull-right"><span class="<?php echo $class;?>"
					id="<?php echo 'fav_'.$product->id;?>"></span>
			
			</a>
			<?php }?>

  </div>
  
  		<?php 
			echo $product->showOfferDealArrow();
			?>
  
			<a class="featured-thumb-link"
				href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$product->id));?>">
				<img class="featured-thumb" src='<?php echo $image; ?>'
				alt="<?php echo $product->title; ?>" style="width: 200px;" /> </a>
		</div>

	</div>
	<div class="masonry-pin-middle">
		<div class='es_affiliate_masonry_bar button'>
			<div class='link right'>
			<a href="#myModal" role="button" class="btn btn-mini" data-toggle="modal" onclick="quickProductView(<?php echo $product->id;?>)">Quick View</a>
				<!-- <a
					href='<?php //echo Yii::app()->createUrl('product/info',array('id'=>$product->id));?>'
					class='btn btn-mini'><?php //echo Button::viewButton(Button::BUTTON_PRODUCT)?>
				</a>-->
			</div>
			<div class='price left'>
			<?php echo '$'.$product->price;?>
			</div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="blog_content">

			<div class="masonry-meta-comment">
				<span class="masonry-meta-content"> <?php echo $product->title;?> </span>
				onto <span class=" masonry-meta-author">
						<strong> <?php echo $product->company->shop_name;?> </strong> 
				</span>
			</div>

		</div>
	</div>


</div>

			<?php }
	}  ?> 




		<?php }
	} 


?>



</div>


<script>

$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});

});
</script>

<p id="back-top" style="display: block;" class="scroll-top">
	<a href="#top"><i class="icon-chevron-up"></i><br />Top</a>
</p>
<!-- scroll top-->




