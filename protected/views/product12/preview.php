<?php $images = $product->images;
$liked = $product->liked;
$quantity = $product->quantity;
?>
<div class="clearfix mar_top2"></div>

<div class="pull-right">
	<?php echo CHtml::link('update',array('product/update','id'=>$product->id),array('class'=>'btn btn-primary span1'))?>

	<?php echo CHtml::link('List',array('product/inventory'),array('class'=>'btn btn-primary span1'))?>
</div>
<div class="row-fluid">


	<div class="span10 single_prodcut offset1">

		<div class="span5 single_prodcut">
			<div class="zoomer row-fluid">
				<div class="holder">
					<div class="image" id="zoomerView">
						<img
							src="<?php echo isset($images) && !empty($images)? ( Yii::app()->createurl('product/download',array('file'=>$images[0]->image_path,'id'=>$images[0]->create_user_id))):
							( Yii::app()->createurl('product/download',array('file'=>'default.png')))
							; ?>"
							class="target">
					</div>
					<div class="console"></div>
				</div>
				<div class="thumbs">

					<?php foreach($images as $image) {?>
					<img
						id="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>"
						src="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>">
					<?php }?>
				</div>
				<div class="hidden lightbox">

					<?php foreach($images as $image) {?>
					<a
						href="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>"
						rel="prettyPhoto[gallery]"> </a>
					<?php }?>
				</div>
			</div>

			<div class="clearfix mar_top5"></div>
			<hr>

		</div>

		<div class="span6 product_description pull-right">

			<div class="product_name row-fluid">
				<h2>
					<?php echo $product->title;?>
				</h2>

			</div>

			<div class="discount_price row-fluid">
				<h2 class="discounted_price">
					Now
					<?php echo '$'. $product->price;?>
				</h2>

				<p class="product_code">
					<?php echo 'product code :'. $product->product_code;?>
				</p>

				<div class="quantity row-fluid">
					<span>Quantity</span><input type="text" placeholder="1"
						name="quantity" value="1" id="<?php echo 'quant_'.$product->id;?>"
						class="span2">

				</div>

				<div class="row-fluid">
					<?php if($product->getSizeOptions()) {?>
					<?php
					echo CHtml::dropDownList('type_id',$product,$product->getSizeOptions(),array('empty' => 'Select Options'));

							}
							?>
				</div>

				<div class="row-fluid">
					<?php if($product->getRelatedOptions()) {?>
					<?php
					echo CHtml::dropDownList('relate_id',$product,$product->getRelatedOptions(),array('empty' => 'Realated Items'));
							}
							?>
				</div>

				<div class="buttons row-fluid">
					<button type="button" class=" btn-primary span4 add_to_cart"
						onclick="addcart(<?php echo $product->id;?>)">Add To Cart</button>

					<button type="button" class=" btn-primary span6 enquire_btn">Enquire
						About This Product</button>

				</div>

				<div class="clearfix mar_top3"></div>

				<div class="full_description row-fluid">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs">
						<li class="active"><a href="#home" data-toggle="tab">Details</a>
						</li>
						<li><a href="#profile" data-toggle="tab">Delivery</a></li>
						<li><a href="#messages" data-toggle="tab">Warranty & Care</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div class="tab-pane active" id="home">
							<?php echo $product->description;?>
						</div>
						<div class="tab-pane" id="profile">
							<?php echo $product->company->delivery_info; ?>
						</div>
						<div class="tab-pane" id="messages">
							<?php echo $product->getWarranty();?>
						</div>
					</div>
					<!-- Nav tabs -->

				</div>


			</div>

		</div>


		<div class="clearfix"></div>

		<div class="reviews ">
			<h5>Reviews:</h5>
			<p>Lorem Ipsum is simply dummy text of the printing and typesetting
				industry. Lorem Ipsum has been the industry's standard dummy text</p>
		</div>

		<div class="clearfix"></div>

		<div class="other-products-container span12">

			<div class="row-fluid">

				<?php if($liked) { 
					foreach($liked as $relate) {
$image = $relate->likeProduct->getImage();
?>

				<div class="other-products span3">
					<div class="other-products_image row-fluid">

						<img src="<?php echo $image;?>">
						<div class="row-fluid">
							<p>
								<?php echo $relate->likeProduct->title; ?>
							</p>
							<span><?php echo '$' .$relate->likeProduct->price; ?> </span>
						</div>
						<button type="button" class="btn-primary btn-small add_to_cart">Add
							To Cart</button>
					</div>
				</div>

				<?php } 
} ?>


			</div>

		</div>

	</div>

</div>


<!--======================= JS =============================-->



<script type="text/javascript">
        $(document).ready(function(){
          $.zoomer();
          $("a[rel^='prettyPhoto']").prettyPhoto({
            theme: 'pp_default',opacity: 0.90,overlay_gallery: true,autoplay_slideshow: false,slideshow: 5000,}
                                                );
        });
      </script>



<script>

function addcart(id)
{

	
var quantity = document.getElementById('quant_'+id).value ; 
var type = document.getElementById('type_id').value ; 

var id = '<?php echo $product->id;?>';

$.ajax({
url : "<?php echo Yii::app()->createUrl('cart/add');?>",
type : "Post",
data :{id:id , quantity : quantity},

success: function(data){

	$('#cart_list_sesssion').html(data);
},

});
	
}
 </script>
