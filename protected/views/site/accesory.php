<style>
body
{
background:#E8E8E8;
}
</style>


<div id="masonry">
<?php if($products) {

	foreach($products as $product) { 


		if($product && $product->images) {
			$image = $product->getImage(); ?>

<div class="hentry thumb">

	<div class="brick-header">
		<div class="thumb-holder">
		

  		<?php 
			//echo $product->showOfferDealArrow();
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

			<?php }}  ?> 
		<?php }?>

</div> <!-- masonry -->
			