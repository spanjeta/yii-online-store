
	<?php
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('yiiactiveform');
$cs->registerCoreScript('multifile');
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('yiiactiveform');
$cs->registerCoreScript('multifile');

 
?>
<?php $images = $product->images;


$quantity = $product->quantity;

?>







<div class="row-fluid quik_view">
		<div class="span6 single_prodcut">
			<div class="zoomer row-fluid">
				<div class="holder">
					<div class="image" id="zoomerView">
						<img src="<?php echo isset($images) && !empty($images)? ( Yii::app()->createurl('product/download',array('file'=>$images[0]->image_path,'id'=>$images[0]->create_user_id))):
						(Yii::app()->createurl('product/download',array('file'=>'default.png')))	; ?>" class="target">
					</div>
					<div class="console"></div>
				</div>
			<?php if (count($images)>24) {?>
				<div class="thumbs_scroll">
                
				<?php foreach($images as $image) {?>
					<img
						id="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>"
						src="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>">

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
						src="<?php echo Yii::app()->createurl('product/download',array('file'=>$image->image_path,'id'=>$image->create_user_id));?>">

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
				<h2 class="pull-left">
				<?php echo $product->title;?>
				</h2>
				
				<a href='<?php echo Yii::app()->createUrl('product/info',array('id' => $product->id));?>'class="btn btn-black pull-right">View on page</a>
				
			</div><br/>
			
			

			<div class="discount_price row-fluid">
		

				<div class="clearfix"></div><br/>
				<h2 class="discounted_price pull-left ">
	
					<?php echo '$'. $product->price;?>
				</h2>
			
				<div class="clearfix"></div><br/>
				
				
				<p class="prd_shop_name pull-left">
				<?php echo CHtml::link($product->company->shop_name,array('site/index'),array('title'=>'Visit Store'));?>
				</p>
				
				
				<p class="product_code pull-left  offset1">
				<?php echo 'product code : &nbsp; '. $product->product_code;?>
				</p>

				<div class="clearfix"></div><br/>
				
				<div class="mar_top1"></div>
				
				
				<form class="">
				
		
				 <div class="control-group">
             <label class="control-label" for="inputEmail">Quantity</label>
             
            <div class="controls">          
          <input type="text" placeholder="1" name="quantity" value="1" id="<?php echo 'quant_'.$product->id;?>"
						class="">          
            </div>
            </div>
            
           
            
			
          
            
				<div class="control-group">
         
             
            <div class="controls"> 
            <?php          
            	if(Yii::app()->user->isGuest) {
					echo CHtml::link('Add To Cart', array('product/addCart','id'=>$product->id),array('class'=>'btn btn-orange span12'));
				}
				//	else if($product->showEnq()) // we will enable it after testing mode than user cant purchase from his own shop

				else	{ ?>
				
				
					<button type="button" class="btn add_to_cart"
						onclick="addcart(<?php echo $product->id;?>)">Add To Cart</button>

						<?php }?>	
					
				
            </div>
            </div>
            
            		
				
</form>

			</div>

		</div>

	
		
	</div> <!--  row-fluid -->
	
	<br/>


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
 
