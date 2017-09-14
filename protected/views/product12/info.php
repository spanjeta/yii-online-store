


<?php
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('yiiactiveform');
$cs->registerCoreScript('multifile');/**/
// Yii::app()->clientscript->scriptMap['jquery.js'] = false;


?>
<?php $images = $product->images;


$quantity = $product->quantity;
?>

<div class="clearfix mar_top2"></div>





<div class="row-fluid">
	<div class="span6 single_prodcut">
		<div class="zoomer row-fluid">
			<div class="holder">
				<div class="image" id="zoomerView">
					<img
						src="<?php echo isset($images) && !empty($images)? ( Yii::app()->createurl('product/download',array('file'=>$images[0]->image_path,'id'=>$images[0]->create_user_id))):
						(Yii::app()->createurl('product/download',array('file'=>'default.png')))	; ?>"
						class="target">
				</div>
				<div class="console"></div>
			</div>
			<?php if (count($images)>24) {?>
			<div class="thumbs_scroll">

			<?php foreach($images as $image) {?>
				<img
					id="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>"
					src="<?php echo isset($image) && !empty($image)? Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id)):'image';?>">

					<?php }?>


			</div>
			<?php }
			else
			{
				?>
			<div class="thumbs">

			<?php foreach($images as $image) {?>
				<img
					id="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>"
					src="<?php echo isset($image) && !empty($image)?  Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id)) : 'image';?>">

					<?php }?>


			</div>
			<?php }?>
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
	


			<div class="clearfix"></div>
			<h2 class="discounted_price pull-left ">
		
				<?php echo '$'. $product->price;?>
			</h2>
			
			<div class="clearfix"></div>


			<p class="prd_shop_name pull-left">
			<?php echo CHtml::link($product->company->shop_name,array('site/index'),array('title'=>'Visit Store'));?>
			</p>


			<p class="product_code pull-left  offset1">
			<?php echo 'product code : &nbsp; '. $product->product_code;?>
			</p>

			<div class="clearfix mar_top1"></div>
			<div class="quantity row-fluid">
				<span>Quantity</span><input type="text" placeholder="1"
					name="quantity" value="1" id="<?php echo 'quant_'.$product->id;?>"
					class="span2">
			</div>

			<div class="row-fluid">
		
           
			
			<?php if(Yii::app()->user->isGuest) {
				
			echo CHtml::link('Add To Cart', array('product/addCart','id'=>$product->id),array('class'=>'btn btn-orange '));
			?>
			<?php }
			
			else	{ 
			
				
				?>

				<br>
				
				<button type="button" class="btn add_to_cart"
					onclick="addcart(<?php echo $product->id;?>)">Add To Cart</button>

					<?php }?>

				<!--  here we close it  -->


				<!--  here we handle enquiry   -->
				
			</div>
			<div class="clearfix mar_top3"></div>
			<div class="full_description row-fluid">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a href="#details" data-toggle="tab">Details</a>
					</li>
					<li><a href="#delivery" data-toggle="tab">Delivery</a></li>
					<li><a href="#warranty" data-toggle="tab">Warranty & Care</a></li>
				</ul>

				<!-- Tab panes -->


				<div class="tab-content details">
					<div class="tab-pane active ">
					<?php echo $product->description;?>
					</div>
					<div class="tab-pane" id="delivery">
					<?php echo $product->company->delivery_info; ?>
					</div>
				
				</div>



				<!-- Nav tabs -->

			</div>

		</div>

	</div>

	<div class="clearfix"></div>




</div>
<!--  row-fluid -->

<!--======================= JS =============================-->




<script type="text/javascript">

	$(document).ready(function(){
          $.zoomer();
          $("a[rel^='prettyPhoto']").prettyPhoto({
            theme: 'pp_default',
            opacity: 0.90,
            overlay_gallery: true,
            autoplay_slideshow: true,
            slideshow: 5000,
            } );
        });
      </script>

<script>

function addcart(id)
{

var quantity = document.getElementById('quant_'+id).value ; 

if($("#type_id").length)
var size = document.getElementById('type_id').value; 
else var size = null;

var id = '<?php echo $product->id;?>';
var avlquantity = '<?php echo $quantity;?>';

console.log (quantity + 'available ' +avlquantity);
if( parseInt(quantity) > parseInt(avlquantity))
{
	alert ('Tatal available quantity ' + avlquantity + ' please select valid quantity' );
	return;
}

	$.ajax({
url : "<?php  echo Yii::app()->createUrl('cart/add');?>",
type : "Post",
data :{id:id , quantity : quantity ,size : size},
success: function(data){

	$('#cart_list_sesssion').html(data);
},
}); 
	
}
$('document').ready(function(){
$('.var_product_info').hide();
	$('#var_product_list').on('change',function(){
		$('.var_product_info').hide();
		 	var key = $(this).val();
		 	$('#' + key).show();		 
		});
	
});


 </script>

