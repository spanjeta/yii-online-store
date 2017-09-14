<section class="subscribeUs">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="">
	<div class="col-xs-12 col-sm-8">
		<div class="su-left">
			<i class="fa fa-envelope" aria-hidden="true"></i>
            <span> <?php echo Yii::t('app','Subscribe to the latest
Womens fashion trends, news, stock updates and get 5% off your first order');?></span>
		</div>
	</div>
	<div class="col-xs-12 col-sm-4 text-right">
		<div class="search-box">
		<div id="subscribe-message"></div>
			<form>
				<div class="input-group search-bar sub-box">
					<input class="form-control searchforminput" id="email_value" placeholder="<?php echo Yii::t('app', 'Enter Your Email Address');?>" type="text"> <span class="input-group-btn">
						<button type="button" onclick="subscribe()" class="btn-u">
							<span class="fa fa-angle-right"></span>					
						</button>
					</span>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>
</section>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-3">
			<h4>conecte-se conosco</h4>
				<div class="payment-method">
					<ul class="list-unstyled list-inline">
					<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script >
  window.___gcfg = {
    lang: 'zh-CN',
    parsetags: 'onload'
  };
</script>




<script src="https://apis.google.com/js/platform.js" async defer></script>

	<li><a href="https://www.facebook.com/Ibizasunangel/"  ><i class="fa fa-facebook-square" aria-hidden="true"></i></a> </li>
	<li><a href="https://twitter.com/IbizaSunAngel"><i class="fa fa-twitter-square" aria-hidden="true"></i> </a> </li>
	<li><a href="https://www.pinterest.com/ibizasunangel/ "><i class="fa fa-pinterest-square" aria-hidden="true"></i></a> </li>
	<li><a href="https://plus.google.com/u/0/+IbizaSunAngelMaputoShowRoom"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </li>
	<li><a href="http://ibizasunangel.tumblr.com/"><i class="fa fa-tumblr-square" aria-hidden="true"></i></a> </li>
	<li><a href="https://www.instagram.com/ibizasunangel/"><i class="fa fa-instagram" aria-hidden="true"></i></a> </li>
 	
				  </ul>
				
			
				
				
				</div>
				</div>
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-3">
				<h4><?php echo  Yii::t('app', 'Follow us')?></h4>
<div class="footer-text">
				<ul>
				
<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/about');?>">Sobre nós</a></li>
<li><a href="<?php echo Yii::app ()->createAbsoluteUrl ( 'site/contact' );?>">Contate-Nos</a></li>

<li><a href="<?php echo Yii::app ()->createAbsoluteUrl ( 'site/review' );?>">Avaliações de Clientes</a></li>
<li><a href="<?php echo Yii::app ()->createAbsoluteUrl ( 'site/rating' );?>">Avaliação</a></li>
</ul>
</div>
		
			</div>
			<div class="col-lg-4 col-md-3 col-sm-3 col-xs-3">
				<h4><?php echo Yii::t('app', 'our policies')?></h4>
<div class="footer-text">
									<ul>


<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/terms');?>">termos e Condições</a></li>
<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/privacy');?>">Política de Privacidade</a></li>
<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/returns');?>">Política de retorno e cancelamento</a></li>
<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/policy');?>">Política de Envio</a></li>
<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/faq');?>">FAQs</a></li>
</ul>
</div>
			</div>
						
			</div>
		</div>
	</div>
</footer>
	<section class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 text-center">
					<p class="footer-copyright"> <?php echo Yii::t('app', 'copyrights')?> &copy; <?php echo date('Y');?> <?php echo Yii::app()->params['company']?> | Todos os direitos reservados | Distribuído por <a target="_blank" href="http://toxsl.com/">TOXSL TECHNOLOGIES privado limitado</a> </p>
				</div>
			</div>
		</div>
	</section>
<script>
$(document).ready(function() {   
    function setHeight() {
        windowHeight = $(window).innerHeight()-373;
        $('.main_wrapper').css('min-height', windowHeight);   
    };   
    setHeight();
    $(window).resize(function() {
        setHeight();   
    }); 
});
function subscribe(){
var value = $("#email_value").val();
	if(value != ''){
		$.ajax({
			url:"<?php echo Yii::app()->createUrl("/subscriber/subscribeemail")?>/value/"+value,
			global:false,
			success: function(response){
				if(response.status == 'OK'){
					var $html = '<div id="subscribe-message_email" class="alert alert-success alert-dismissable">';
					$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					$html += '<strong>Success!</strong> '+response.error+' </div>';
					$('#subscribe-message').parent( ).after($html);
				}else{
					var $html = '<div id="subscribe-message_email" class="alert alert-danger alert-dismissable">';
					$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
					$html += '<strong>Something Went Wrong!</strong> '+response.error+' </div>';
					$('#subscribe-message').parent( ).after($html);
				}
			}	
			});
	} else {
		var $html = '<div id="subscribe-message_email" class="alert alert-danger alert-dismissable">';
		$html += '<strong>Something Went Wrong!</strong> Enter the email first<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		$html += ' </div>';
		$('#subscribe-message').parent( ).after($html);
	}
	$( '#subscribe-message_email' ).fadeOut( 5000, "linear" );
}

function addCart(id){
	$.ajax({
    url: "<?php echo Yii::app()->createUrl("cart/add")?>",
    global:false,
    type:'POST',
    data:{id:id},
    success: function(response){    
	        if(response.status == 'OK'){  
   	       // alert("Item is added to cart, Continue shopping");  
   	       var $html = '<div id="product_message_'+id+'" class="alert alert-success alert-dismissable">';

				$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				$html += '<strong>Success!</strong> '+response.error+' </div>';

				
				$('#product_'+id).parent( ).after($html);

				$( '#product_message_'+id ).fadeOut( 8000, "linear" );

				
   			location.reload();
    	}else {
    	
    		//	alert(response.error);
    		var $html = '<div id="product_message_'+id+'" class="alert alert-success alert-dismissable">';

			$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
			$html += '<strong>Success!</strong> '+response.error+' </div>';

			
			$('#product_'+id).parent( ).after($html);

			$( '#product_message_'+id ).fadeOut( 8000, "linear" );
    	}
    	
    
	}
});
	
}

function addCartView(id){
	var checkedcolor = $('.radio:checked').val();
	var checkedsize = $('input[name=Size]:checked').val();
	
	$.ajax({
    url: "<?php echo Yii::app()->createUrl("cart/addcart")?>/",
	data : {
		id:id,
		checkedValueColor : checkedcolor,
		checkedValueSize : checkedsize,
	},
	type: 'post',
    global:false,
    success: function(response){
	        if(response.status == 'OK'){  
   	       //alert("Item is added to cart, Continue shopping");  
   			window.location= '<?php echo Yii::app()->createUrl("cart/index")?>';
    	}
	}
});
	
}

function addWishList(id, d='list') {
	var color_id = '';
	var size_id = '';
	if(d == 'detail'){
		color_id = $('#product_color').val();
		size_id = $('#product_size').val();
	}
	$.ajax({
	    url: "<?php echo Yii::app()->createUrl("cart/addWishList")?>/id/"+id,
	    dataType: 'json',
	    type:'post',
	    data: {
			color_id : color_id,
			size_id : size_id,
	        },
   		global:false,
    success: function(response) {
	    if( typeof response.count != 'undefined' ) {
		    if( response.count != '' && response.count != 0 ) {
		    	$("#total_wishlist_count").html('');
				$("#total_wishlist_count").html('<i class="fa fa-heart"></i><sup>'+response.count+'</sup>');
			} else {
				$("#total_wishlist_count").html('');
				$("#total_wishlist_count").html('<i class="fa fa-heart-o "></i>');
			}

			if(  typeof response.status != 'undefined' && response.status == 'OK'  ) {
				$("#add_wishlist_"+id).html("");
				$("#add_wishlist_"+id).html('<i class="fa fa-heart"></i>');
			}

			if(  typeof response.status != 'undefined' && response.status == 'NOK'  ) {
				$("#add_wishlist_"+id).html("");
				$("#add_wishlist_"+id).html('<i class="fa fa-heart-o"></i>');
			}
		    
			if( typeof response.error != 'undefined' && response.error != '' ) {

				var $html = '<div id="product_message_'+id+'" class="alert alert-success alert-dismissable">';

				$html += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
				$html += '<strong>Success!</strong> '+response.error+' </div>';

				
				$('#product_'+id).parent( ).after($html);

				$( '#product_message_'+id ).fadeOut( 8000, "linear" );
			}
		}
	}
});
	
}
</script>

<script type="text/javascript">
	$('.multi-item-carousel').carousel({
  interval: false
});

// for every slide in carousel, copy the next slide's item in the slide.
// Do the same for the next, next item.
$('.multi-item-carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  if (next.next().length>0) {
    next.next().children(':first-child').clone().appendTo($(this));
  } else {
  	$(this).siblings(':first').children(':first-child').clone().appendTo($(this));
  }
});
</script>
    
  </body>
</html>