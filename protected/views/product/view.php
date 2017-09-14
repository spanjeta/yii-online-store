<script type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/lightbox/js/lightbox.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/lightbox/css/lightbox.css" />
<section class="main_wrapper">
	<div class="internal-p-section">
		<div class="container">
			<div class="row">
			<?php
			$prodimages = ProductImage::model ()->findAllByAttributes ( array (
					'product_id' => $model->id 
			) );
			$image = Product::model ()->findByAttributes ( array (
					'id' => $model->id 
			) );
			
			?>		
				<div class="col-lg-5 col-md-5 product-slider">
					<div class="page">
						<!-- Galley wrapper that contains all items -->
						<div id="gallery" class="gallery slider slider-for" itemscope
							itemtype="http://schema.org/ImageGallery">
<?php if(!empty($prodimages)){
	$count = 1;
foreach ($prodimages as $prodimage) { ?>
							<figure itemprop="associatedMedia" itemscope
								itemtype="http://schema.org/ImageObject">
								<a href="<?php echo $prodimage->getProImage();?>"
									class='zoom' id='ex<?php echo $count?>' data-width="1000" data-height="1219"
									itemprop="contentUrl"> <img
									src="<?php echo $prodimage->getProImage();?>"
									itemprop="thumbnail" alt="Image description">
								</a>
							</figure>
							<?php 
							$count++;
							}}
						?>
						</div>
						<div class="slider slider-nav">
						<?php if(!empty($prodimages)){
						foreach ($prodimages as $prodimage){?>
						
							<div>
								<img
									src="<?php echo $prodimage->getProImage();?>"
									alt="">
							</div>
							<?php }}?>
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
									<button class="pswp__button pswp__button--close"
										title="Close (Esc)"></button>
									<button class="pswp__button pswp__button--share" title="Share"></button>
									<button class="pswp__button pswp__button--fs"
										title="Toggle fullscreen"></button>
									<button class="pswp__button pswp__button--zoom"
										title="Zoom in/out"></button>
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
								<div
									class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
									<div class="pswp__share-tooltip"></div>
								</div>
								<button class="pswp__button pswp__button--arrow--left"
									title="Previous (arrow left)"></button>
								<button class="pswp__button pswp__button--arrow--right"
									title="Next (arrow right)"></button>
								<div class="pswp__caption">
									<div class="pswp__caption__center"></div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div id="product_<?=$model->id?>"></div>
				
				<div class="p-right-column col-lg-7 col-md-7 product-description">
					<h1 class="cart-detail1" itemprop="name"><?php echo $model->title;?></h1>


				<p class="product-price" itemprop="offers" itemtype="http://schema.org/Offer"><meta itemprop="priceCurrency" content="GBP"><span ><?php echo Yii::t('app','price')?></span>&nbsp;&nbsp;€  <span id="product_price_data" itemprop="price" content="<?php echo ($model->discount_price > 0) ? $model->discount_price : $model->price?>"><?php if($model) {if($model->discount_price){  echo "<strike>".$model->price."</strike>"; echo " &nbsp;&nbsp;&nbsp;  € ".$model->discount_price; }else { echo $model->price; }} ?> </span></p>
<?php

/* $html = '';

if ($model->getAverageRating ( $model->id )) {
	
	$averageStars = $model->getAverageRating ( $model->id );
	
	for($i = 0; $i < $averageStars; $i ++) {
		
		$html .= " 
					      
					           <i class='fa fa-star'></i>
					     
					    ";
	}
	$html .= "<span>";
	echo $html;
} */
?> 



					<p class="detail-price"><?php //echo $model->price;?></p>


					<p class="detail-price1" itemprop="description"><?php echo $model->description?></p>
					<!-- <ul class="detail-price2">
						<li>Formal Print</li>
						<li>Formal Print</li>
						<li>Formal Print</li>
					</ul> -->


					
									<?php
									
									$colors = Product::getVarProdColors ( $model->id );
									if ($colors) {
										?>
										<div class="row">
						<div class="col-md-6">

							<div class="product-attributes-label label1">
								<select class="color-btn" id="product_color">

									<?php
										foreach ( $colors as $key => $color ) {
											?>
											<option value = "<?php echo $key ;?>"><?php echo $color;?></option>
										
										<?php }?>
										</select>
							</div>
						</div>
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
									<div class="row">
						<div class="col-md-6">

							<div class="product-attributes-label label1">
								<select class="color-btn" id="product_size">
									<?php
										foreach ( $sizes as $key => $size ) {
											?>
											<option value="<?php echo $key ;?>"><?php echo $size;?></option>
										
										<?php }?>
									</select>
							</div>
						</div>
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
									class="cart-wishlist form-control fa fa-shopping-cart"> <?php echo Yii::t('app','add to cart');?></a>
											<?php }else{?>
											
<?php $cri = new CDbCriteria ();
		$cri->select = " SUM(quantity) as total_quantity";
		$cri->compare ( 'product_id', $model->id );
		$varproduct = VarProduct::model ()->find ( $cri );
	
		?>
		<?php if(!empty($varproduct) and $varproduct->total_quantity > 0) {?>
												 <div>
									<a href="#" onclick="addCartView(<?php echo $model->id;?>)"
										class="cart-wishlist form-control fa fa-shopping-cart"><?php echo Yii::t('app','add to cart');?></a>
								</div>
								<?php }else{?>
			<div class="out_of_stock" style="color:red;"><?php echo Yii::t('app','out of stock');?></div>
		<?php }?>
								
											<?php }?>
							</div>
							<div class="col-md-6">
							 <?php if(Yii::app()->user->isGuest){?>
                	<a
									href="<?php echo Yii::app()->createUrl('user/login'); ?>"
									class="cart-wishlist form-control"><i class="fa fa-heart"></i><?php echo Yii::t('app','add to wishlist');?></a>
									
                <?php }else {?>
							<?php
									
$wishlist = WishList::getWishList ( $model->id, Yii::app ()->user->id );
									if (empty ( $wishlist )) {
										?>
										
					<a id="add_wishlist_<?=$model->id?>" href="#" class="cart-wishlist form-control"
									onclick="addWishList(<?php echo $model->id;?>,'detail')"><i
									class="fa fa-heart-o"></i><?php echo Yii::t('app','add to wishlist');?></a>
					<?php }else {?>
					<div id="product_<?=$model->id?>"></div>
					<a id="add_wishlist_<?=$model->id?>" href="#" class="cart-wishlist form-control"
									onclick="addWishList(<?php echo $model->id;?>,'detail')"><i
									class="fa fa-heart"></i><?php echo Yii::t('app','remove from wishlist');?></a>
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
												aria-controls="collapseOne"><?php echo Yii::t('app','about the product');?>  </a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in"
										role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body" itemprop="description"><?php echo Yii::t('app','about the product');?><?php echo $model->large_description ?></div>
									</div>
								</div>
							</div>
						</div>

					</div>


					<div class="clearfix"></div>
					<div><?php 
					if(Yii::app()->user->id){
					$criteria = new CDbCriteria ();
					//$criteria->addCondition ( 'create_user_id = '.Yii::app()->user->id );
					$criteria->addCondition ( 'product_id = '.$model->id );
					
					$order_item = OrderItem::model ()->find($criteria);
					
					if(!empty($order_item)){
						//print_r($order_item->create_user_id);exit;
						if($order_item->create_user_id == Yii::app()->user->id ){
							
							$this->widget ( 'CStarRating', array (
									
									'name' => 'rating',
									'minRating' => 1,
									'maxRating' => 5,
									'starCount' => 5,
									'value' => $model->getAverageRating($model->id),
									//'readOnly' => true
							) );
						}}else{ ?>
						</div><h5><?php echo Yii::t('app','you are not allowed to giving ratings for this product')?></h5>
						<div><?php 
							
							$this->widget ( 'CStarRating', array (
									
									'name' => 'rating_2',
									'minRating' => 1,
									'maxRating' => 5,
									'starCount' => 4,
									'ratingStepSize' => 0.5,
									'value' => $model->getAverageRating($model->id),
									'readOnly' => true
							) );
							
						}
					

}  else{?>
					
					
					
					<div><?php
					$this->widget ( 'CStarRating', array (
							
							'name' => 'rating_2',
							'minRating' => 1,
							'maxRating' => 5,

							'starCount' => 4,
							'ratingStepSize' => 0.5,
							'value' => $model->getAverageRating($model->id),
							'readOnly' => true 

					) );
}	?></div>
<div class="clearfix"></div>
					<div>
<?php

/* $this->widget ( 'ext.YaShareSocial.YaShare.YaShare', array (
		'services' => 'twitter,facebook,gplus',
		'iconLimit' => 3,
		'title' => 'Share ...' 
) ); */
?>
</div>
				</div>

			</div>
		</div>

		<!-- 
		Product View Feature product start
		
		
		 -->
<!-- End -->
	</div>
<?php   $this->widget('CommentPortlet', array(
	'model' => $model,
));
?>
</section>

<script>

$(document).ready(function() {
	var id = $("#product_color").val();

	//getProductPrize(id);

	var sizeId = $("#product_size").val();

	getProductsize(sizeId, id);

	$("#product_color").on("change", function() {
		var id = $("#product_color").val();

		getProductPrize(id);

		var sizeId = $("#product_size").val();

		getProductsize(sizeId, id);
	});

	$("#product_size").on("change", function() {
			var sizeId = $("#product_size").val();

			var cId = $("#product_color").val();

			getProductsize(sizeId, cId);
	});
});

function getProductPrize(id) {

	$.ajax({
		url : "<?= yii::app()->createAbsoluteUrl('product/productPrice')?>?cId="+id+"&&pId=<?= $model->id ?>",
		type : 'GET',
		dataType:'json',
		success : function( response ) {
			var html = '';
			var img = '';
			$.each(response.data, function (index, value) {
				html += '<option value="'+ value.size_id +'"> ' + value.color_title + ' </option>';

				if( typeof value.image != 'undefined' && value.image != '' ) {

					$.each(value.image, function (key, val) {
						img += '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';

						img += '<a href="'+val+'"class="zoom" id="ex12" data-width="1000" data-height="1219" itemprop="contentUrl">';
						img += '<img src="'+val+'" itemprop="thumbnail" alt="Image description"></a></figure>';
					});
				}
			});

			//$("#gallery").prepend(img);

			$('#gallery #ex12').zoom();
			
			$("#product_size").html('');
			$("#product_size").append(html);

			var sizeId = $("#product_size").val();

			var cId = $("#product_color").val();
			
			getProductsize(sizeId, cId);
		} 
	});
}

function getProductImage(id) {

	$.ajax({
		url : "<?= yii::app()->createAbsoluteUrl('product/productImages')?>?vId="+id+"&&pId=<?= $model->id ?>",
		type : 'GET',
		dataType:'json',
		success : function( response ) {
			var html = '';

			$.each(response.data, function (index, value) {
				html += '<option value="'+ value.size_id +'"> ' + value.color_title + ' </option>';
			});

			$("#product_size").html('');
			$("#product_size").append(html);

			var sizeId = $("#product_size").val();

			var cId = $("#product_color").val();
			
			getProductsize(sizeId, cId);
		} 
	});
}

function getProductsize(sId, cId) {

	$.ajax({
		url : "<?= yii::app()->createAbsoluteUrl('product/productSize')?>?cId="+cId+"&&pId=<?= $model->id ?>&&sId="+sId,
		type : 'GET',
		dataType:'json',
		success : function( response ) {
			$("#product_price_data").html("");
			$("#product_price_data").html(response.data.price);
		} 
	});
}

$("#rating").click(function() {
var rateValue = $("input[name='rating']:checked").val() 
	rateProduct(rateValue);
});


function rateProduct(rateValue){
	$.ajax({
		url:'<?= yii::app()->createAbsoluteUrl('product/rate')?>',
		data:{'rateValue':rateValue, 'product_id': <?= $model->id;   ?> },
		method:'get',
		success:function(response){                
				var data = $.parseJSON(response);
				if(data.status == "OK") {
				
				}
	         }
		
	});
}

$('#apply ').click(function() {
	applypromo($('#promo-box').val());
});

</script>
<script>
		$(document).ready(function() {
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

/* global jQuery, PhotoSwipe, PhotoSwipeUI_Default, console */

(function($) {

  // Init empty gallery array
  var container = [];

  // Loop over gallery items and push it to the array
  $('#gallery').find('figure').each(function() {
    var $link = $(this).find('.zoom'),
      item = {
        src: $link.attr('href'),
        w: $link.data('width'),
        h: $link.data('height'),
        title: $link.data('caption')
      };
    container.push(item);
  });

  // Define click event on gallery item
  $('.zoom').click(function(event) {

    // Prevent location change
    event.preventDefault();

    // Define object and gallery options
    var $pswp = $('.pswp')[0],
      options = {
        index: $(this).parent('figure').index(),
        bgOpacity: 0.75,
        showHideOpacity: true
      };

    // Initialize PhotoSwipe
    var gallery = new PhotoSwipe($pswp, PhotoSwipeUI_Default, container, options);
    gallery.init();
  });

}(jQuery));
</script>