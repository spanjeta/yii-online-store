<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="clearfix mar_top2"></div>
<div class="container">
	<div id="masonry">

	<?php if($deals)  {
		foreach($deals as $deal) {
			$Item = $deal->item;

			if($Item)
			{
				$dealItem = $deal->item->product;
			;
				$image = $dealItem->getImage();?>

		<div class="thumb">
			<div class="brick-header">


				<div class="thumb-holder">

					<ul class="tags"> <li>	<a href="#"><?php echo $deal->dealAmount();?></a></li></ul>
				


					<a class="featured-thumb-link"
						href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$dealItem->id));?>">
						<img class="featured-thumb" src="<?php echo $image; ?>"
						alt="image" style=""> </a>


				</div>


			</div>

			<div class="row-fluid">
				<div class="blog_content">

					<div class='link pull-right'>
						<a
							href='<?php echo Yii::app()->createUrl('product/info',array('id'=>$dealItem->id));?>'
							class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_DEAL)?>
						</a>
					</div>

					<div class="pull-left span8 product_name">
					<?php echo $dealItem->title; ?>
						<br>
					</div>

					<div class="pull-right product_price">
						<strong><?php echo 'NOW $'. $dealItem->calPrice(); ?></strong>
						<p class="old_price"><?php echo ' WAS  $ '.  $dealItem->price; ?></p>

					</div>
			

				</div>

			</div>

		</div>



		<?php }
		}
	}?>
		<!------            ------->

		<!------            ------->





	</div>
<div id="masonry">

	<?php if($offers)  {
		
		foreach($offers as $offer) {
		
			$Items = $offer->offerItems;
foreach($Items as $Item)
{
	if($Item)
			{
			
				$offerItem = $Item->product;
				//print_r($offerItem); exit;
				$image = $offerItem->getImage();
				?>

		<div class="thumb">
			<div class="brick-header">


				<div class="thumb-holder">
<?php 
			echo $offerItem->showOfferDealArrow();
			?>
				


					<a class="featured-thumb-link"
						href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$offerItem->id));?>">
						<img class="featured-thumb" src="<?php echo $image; ?>"
						alt="image" style=""> </a>


				</div>


			</div>

			<div class="row-fluid">
				<div class="blog_content">

					<div class='link pull-right'>
						<a
							href='<?php echo Yii::app()->createUrl('product/info',array('id'=>$offerItem->id));?>'
							class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_DEAL)?>
						</a>
					</div>

					<div class="pull-left span8 product_name">
					<?php echo $offerItem->title; ?>
						<br>
					</div>

					<div class="pull-right product_price">
						<strong><?php echo 'NOW $'. $offerItem->calPrice(); ?></strong>
						<p class="old_price"><?php echo ' WAS  $ '.  $offerItem->price; ?></p>

					</div>
			

				</div>

			</div>

		</div>



		<?php }
}
		}
	}?>
		<!------            ------->

		<!------            ------->





	</div>

</div>
<!----------- ROW-FLUID -------------->


<script>
obj_ipin = {},
$(window).load(function(){   
	myrun();

				});


</script>


