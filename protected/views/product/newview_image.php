
<section class="main_wrapper">
	<div class="internal-p-section">
		<div class="container">
			<div class="row">
<div class="page">
      <!-- Galley wrapper that contains all items -->
      <div id="gallery" class="gallery slider slider-for" itemscope itemtype="http://schema.org/ImageGallery">

        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
          <a href="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/1.jpg" class='zoom' id='ex1'   data-width="1000" data-height="1219" itemprop="contentUrl">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/1.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
        <figure itemprop="associatedMedia" itemscope itdata-width="1000" data-height="1219"  itemprop="contentUrl">
          <a href="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/2.jpg" class='zoom' id='ex2' data-width="1000" data-height="1219" itemprop="contentUrl">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/2.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
          <a href="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/3.jpg" class='zoom' id='ex3' data-width="1000" data-height="1219" itemprop="contentUrl">
            <img src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/img/3.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
          <a href="images/4.jpg" class='zoom' id='ex4' data-width="1000" data-height="1219"  itemprop="contentUrl">
            <img src="images/4.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
          <a href="images/5.jpg" class='zoom' id='ex5' data-width="1000" data-height="1219"  itemprop="contentUrl">
            <img src="images/5.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
        <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
          <a href="images/6.jpg" class='zoom' id='ex6' data-width="1000" data-height="1219"  itemprop="contentUrl">
            <img src="images/6.jpg" itemprop="thumbnail" alt="Image description">
          </a>
        </figure>
      </div>
      <div class="slider slider-nav">
	    <div><img src="images/1.jpg" alt=""></div>
	    <div><img src="images/2.jpg" alt=""></div>
	    <div><img src="images/3.jpg" alt=""></div>
	    <div><img src="images/4.jpg" alt=""></div>
	    <div><img src="images/5.jpg" alt=""></div>
	    <div><img src="images/6.jpg" alt=""></div>
	  </div>
</div>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <!-- Background of PhotoSwipe. 
           It's a separate element as animating opacity is faster than rgba(). -->
  <div class="pswp__bg"></div>
  <!-- Slides wrapper with overflow:hidden. -->
  <div class="pswp__scroll-wrap">
    <!-- Container that holds slides. 
              PhotoSwipe keeps only 3 of them in the DOM to save memory.
              Don't modify these 3 pswp__item elements, data is added later on. -->
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <!--  Controls are self-explanatory. Order can be changed. -->
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
        <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
        <!-- element will get class pswp__preloader--active when preloader is running -->
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
      </button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
      </button>
      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>



			<?php
			$prodimages = ProductImage::model ()->findAllByAttributes ( array (
					'product_id' => $model->id 
			) );
			$image = Product::model ()->findByAttributes ( array (
					'id' => $model->id 
			) );
			
			?>
					
				<div class="col-lg-5 col-md-5 product-slider">
					<div id='carousel-custom' class='carousel slide'
						data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
					<?php
					if (! empty ( $prodimages )) {
						$count = 0;
						foreach ( $prodimages as $prodimage ) {
							?>
			        <div <?php if($count==0){?> class='item active'
									<?php }else{?> class='item' <?php }?> <?php if($count==1){?>
									id="zoom_05" <?php }?>>
									<img src='<?php echo $prodimage->getProImage();?>' alt=''
										data-zoom-image="<?php echo $prodimage->getProImage();?>"
										id="zoom_05" />
								</div>
					 <?php
							$count ++;
						}
					} else { // echo "<pre>"; print_r($image->thumbnail_file);exit; ?>
				
		
						<img src="<?php echo $image->thumbnail_file;?>"
									class="placeholder placeholder-landscape width-full img-thumbnail"
									height=275px width=275px>
					<?php
					}
					?>       
					            <!-- <div class='item active'>
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/print/image1xxl.jpg' alt=''  data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/print/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'  id="zoom_05">
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg" id="zoom_05"/>
					            </div>
					                
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg" id="zoom_05"/>
					            </div>
					            <div class='item'>
					                <img src='http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpgg' alt='' data-zoom-image="http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpg" id="zoom_05"/>
					            </div> -->
					            
					            
				
					            
							</div>
						</div>
						<script>
						  $("#zoom_05").elevateZoom({ zoomType    : "inner", cursor: "crosshair" });
						</script>
						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
					   <?php
								if (isset ( $prodimages )) {
									$count = 0;
									foreach ( $prodimages as $prodimage ) {
										?>
					        <li data-target='#carousel-custom'
								data-slide-to='<?php echo "".$count;?>' <?php if($count==0){?>
								class='active' <?php }?>><img
								src='<?php echo $prodimage->getProImage();?>' alt='' /></li>
							<!--  <li data-target='#carousel-custom' data-slide-to='1'><img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image2xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='2'><img src='http://images.asos-media.com/inv/media/8/2/3/3/5313328/image3xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='3'><img src='http://images.asos-media.com/inv/media/3/6/7/0/4850763/multi/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='4'><img src='http://images.asos-media.com/inv/media/5/2/1/3/4603125/gold/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='5'><img src='http://images.asos-media.com/inv/media/5/3/6/8/4948635/mink/image1xxl.jpg' alt='' /></li>
					        <li data-target='#carousel-custom' data-slide-to='6'><img src='http://images.asos-media.com/inv/media/1/3/0/8/5268031/image2xxl.jpg' alt='' /></li> -->
						<?php
										$count ++;
									}
								}
								?>
					    </ol>
					</div>








				</div>
				<div class="p-right-column col-lg-7 col-md-7 product-description">
					<h1 class="cart-detail1"><?php echo $model->title;?></h1>


					<p class="product-price">€ <?php if($model) {if($model->discount_price){  echo "<strike>".$model->price."</strike>"; echo " &nbsp;&nbsp;&nbsp;  € ".$model->discount_price; }else { echo $model->price; }} ?></p>

<b>You Rated</b>
<?php
		
					$html = '';
					
					if ($model->getAverageRating ( $model->id )) {
						
						$averageStars = $model->getAverageRating ( $model->id );
						
						
					
						for($i = 0; $i < $averageStars; $i ++) {
							
							
							
							$html .= " 
					      
					           <i class='fa fa-star'></i>
					     
					    ";
						}
						$html .= "<span>";
						echo $html;
					}
						?> 



					<p class="detail-price"><?php //echo $model->price;?></p>


					<p class="detail-price1"><?php echo $model->description?></p>
					<!-- <ul class="detail-price2">
						<li>Formal Print</li>
						<li>Formal Print</li>
						<li>Formal Print</li>
					</ul> -->


					
									<?php
									
$colors = Product::getVarProdColors ( $model->id );
									if ($colors) {
										?>
									<div class="left-browsebox categoris categori-border">
									<span class="cat-title">Colors</span>
									<ul class="list-unstyled  no-border">
									<?php
										foreach ( $colors as $key => $color ) {
											?>
										<li><span><input type="radio" class="radio" name="Color"
									value="<?php echo $key;?>"></span> <label>
												<?php echo $color;?>
										</label></li>
										<?php }?>
									
									</ul>
									</div>
									
									<?php }else{?>
									<div class="row">
						<div class="col-md-6">
									
							<div class="product-attributes-label label1">
								<select class="color-btn">

									<option><?php echo $model->color;?></option>

								</select>
							</div>	
							</div>	
							</div>
				<?php }?>
									<?php
									
$sizes = Product::getVarProdSizes ( $model->id );
									if ($sizes) {
										?>
									<div class="left-browsebox categoris categori-border">
									<span class="cat-title">Sizes</span>
									<ul class="list-unstyled  no-border">
									<?php
										foreach ( $sizes as $key => $size ) {
											?>
										<li><span><input type="radio" class="radio" name="Size"
									value="<?php echo $key;?>"></span> <label>
												<?php echo $size;?>
										</label></li>
										<?php }?>
									
									</ul>
								</div>
									
									<?php }else {?>
								<div class="row">
						<div class="col-md-6">
							<div class="product-attributes-label label1">
								<select class=" color-btn">
									<option><?php echo $model->size;?></option>
								</select>
							</div>
							</div>
							</div>
						
										<?php }?>
					


									

					<div class="cart-add">
						<div class="row product-actions">
						
						<div class="col-md-6">
								<!-- <a href="" class="cart-wishlist form-control"><i class="fa fa-shopping-cart"></i> Add to cart</a> -->
							<?php //echo CHtml::link('Add to cart',array('site/register'),array('class'=>'cart-wishlist form-control fa fa-shopping-cart',  )); ?>
							<?php if(Yii::app()->user->isGuest){?>
									<a href="<?php echo Yii::app()->createUrl('user/login');?>"
									class="cart-wishlist form-control fa fa-shopping-cart"> Add To
									Cart </a>
											<?php }else{?>
												 <div>
									<a href="#" onclick="addCartView(<?php echo $model->id;?>)"
										class="cart-wishlist form-control fa fa-shopping-cart">Add To
										Cart</a>
								</div>
											<?php }?>
							</div>
							<div class="col-md-6">
							 <?php if(Yii::app()->user->isGuest){?>
                	<a href="<?php echo Yii::app()->createUrl('user/login'); ?>" class="cart-wishlist1 form-control"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                <?php }else {?>
							<?php $wishlist = WishList::getWishList($model->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#"  class="cart-wishlist1 form-control" onclick="addWishList(<?php echo $model->id;?>)"><i class="fa fa-heart-o"></i>Add to wishlist</a>
					<?php }else {?>
					<a href="#" class="cart-wishlist1 form-control" onclick="addWishList(<?php echo $model->id;?>)"><i class="fa fa-heart"></i>Remove From wishlist</a>
					<?php }} ?>
								
							</div>
							
							
							<div class="middle"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel-group" id="accordion" role="tablist"
								aria-multiselectable="true">
								<div class="panel panel-default">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion"
												href="#collapseOne" aria-expanded="true"
												aria-controls="collapseOne"> Delivery & Returns </a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in"
										role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">Anim pariatur cliche reprehenderit,
											enim eiusmod high life accusamus terry richardson ad squid.le
											VHS.</div>
									</div>
								</div>
							</div>
						</div>

					</div>


					<div class="clearfix"></div>
					<div><?php
$this->widget ( 'CStarRating', array (
		
		'name' => 'rating',
		'minRating' => 1,
		'maxRating' => 5,
		'starCount' => 5,
		'value' => 4,
		'readOnly' => true 
) );
?></div>
					<div>
<?php 

$this->widget('ext.YaShareSocial.YaShare.YaShare', array(
		'services' => 'twitter,facebook,gplus',
		'iconLimit' => 3,
		'title' => 'Share ...',
));
?>
</div>
				</div>

			</div>
</div>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
	<?php
	$criteria = new CDbCriteria ();
	$criteria->addCondition ( 'is_featured = 1' );
	$criteria->order = 'id ASC';
	$criteria->limit = 10;
	
	$products = Product::model ()->findAll ( $criteria );
	
	?>	
		<h2 class="product-title text-center">Feature Products</h2>
						<div class="owl-carousel owl-theme product_slider1">
	 	<?php foreach ($products as $product){  ?>
               <div class="item relative">
								<img src="<?php echo $product->thumbnail_file;?>"
									class="placeholder placeholder-landscape width-full img-thumbnail"
									height=275px width=275px>
								<div class="product-inner">
									<div class="actions">
										<div class="rating">
											<ul class="list-inline">
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>
										</div>
										<div class="add-to-wishlist">
					<?php $wishlist = WishList::getWishList($product->id,Yii::app()->user->id);
					if(empty($wishlist)){?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart-o"></i></a>
					<?php }else {?>
					<a href="#" onclick="addWishList(<?php echo $product->id;?>)"><i class="fa fa-heart"></i></a>
					<?php } ?>
				</div>
									</div>
									<p class="product-details text-center">
										<a href="<?php echo $product->getUrl();?>"><?php echo $product->title?></a>
									</p>

									<p class="product-price text-center">€ <?php echo $product->price?></p>
									<div class="middle">
    						<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>"></i>
											<div class="text">Add To Cart</div></a>
											<?php }else{?>
												<a href="#" onclick="addCart(<?php echo $product->id;?>)"></i>
											<div class="text">Add To Cart</div></a>
											<?php }?>
    					
  						</div>
									<span class="label-new">New!</span>
								</div>
							</div>
						</div>
    		    <?php
			}
			?>
            </div>
				</div>
			</div>
		</section>

	</div>

</section>
<script>

$("#rating").click(function()
		{
var rateValue = $("input[name='rating']:checked").val() 

rateProduct(rateValue);

});

</script>

 	<script>

function rateProduct(rateValue){
	$.ajax({
		url:'<?= yii::app()->createAbsoluteUrl('product/rate')?>',
		data:{'rateValue':rateValue, 'product_id': <?= $model->id;   ?> },
		method:'get',
		
		"success":function(response){                
				
				var data = $.parseJSON(response);
				if(data.status == "OK") {
				
				}
				else
				{
					
					}
	         }
		
	});
}

$('#apply ').click(function()
{
	
	
	applypromo($('#promo-box').val());
});

</script> 
<script>
		$(document).ready(function(){
			$('#ex1').zoom();
			$('#ex2').zoom();
			$('#ex3').zoom();			 
			$('#ex4').zoom();
			$('#ex5').zoom();
			$('#ex6').zoom();
			$('#ex7').zoom();			 
			$('#ex8').zoom();
		});
	</script>
	<script>
		window.onload=function(){
		  $('.slider').slick({
		  autoplay:true,
		  autoplaySpeed:1500,
		  arrows:true,
		  prevArrow:'<button type="button" class="slick-prev"></button>',
		  nextArrow:'<button type="button" class="slick-next"></button>',
		  centerMode:true,
		  slidesToShow:3,
		  slidesToScroll:1
		  });
		};


		 $('.slider-for').slick({
		   slidesToShow: 1,
		   slidesToScroll: 1,
		   arrows: false,
		   fade: true,
		   asNavFor: '.slider-nav'
		 });
		 $('.slider-nav').slick({
		   slidesToShow: 5,
		   slidesToScroll: 1,
		   asNavFor: '.slider-for',
		   dots: false,
		   focusOnSelect: true
		 });

		 $('a[data-slide]').click(function(e) {
		   e.preventDefault();
		   var slideno = $(this).data('slide');
		   $('.slider-nav').slick('slickGoTo', slideno - 1);
		 });
	</script>
<script>
'use strict';

/* global jQuery, PhotoSwipe, PhotoSwipeUI_Default, console */

(function($) {

  // Init empty gallery array
  var container = [];

  // Loop over gallery items and push it to the array
  $('#gallery').find('figure').each(function() {
    var $link = $(this).find('a'),
      item = {
        src: $link.attr('href'),
        w: $link.data('width'),
        h: $link.data('height'),
        title: $link.data('caption')
      };
    container.push(item);
  });

  // Define click event on gallery item
  $('a').click(function(event) {

    // Prevent location change
    event.preventDefault();

    // Define object and gallery options
    var $pswp = $('.pswp')[0],
      options = {
        index: $(this).parent('figure').index(),
        bgOpacity: 0.85,
        showHideOpacity: true
      };

    // Initialize PhotoSwipe
    var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
    gallery.init();
  });

}(jQuery));
</script>