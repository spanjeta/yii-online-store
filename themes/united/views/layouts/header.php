<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="chrome=1" />
<meta name="description"
	content="<?php echo CHtml::encode($this->getPageDescription());?>">
<meta name="author" content="<?php echo Yii::app()->params['company']?>" />
<meta name="keywords"
	content="<?php echo CHtml::encode($this->getPageKeywords());?>">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link rel="icon" href="<?php 
echo Yii::app ()->theme->baseUrl
."/images/cart.png";

?>" type="image/gif" sizes="16x16">
<!-- Bootstrap -->
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/style.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/jquery.mobilemenu.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/nav.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/responsive1.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/owl.carousel.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/owl.theme.css" rel="stylesheet">


<link href="<?php echo Yii::app()->theme->baseUrl?>/css/slider/photoswipe.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/slider/default-skin.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/slider/slick.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/slider/slick-theme.css" rel="stylesheet" />
<link href="<?php echo Yii::app()->theme->baseUrl ?>/css/slider/smoothproducts.css" rel="stylesheet" />


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

 <!-- <script  src="< ?php echo Yii::app()->theme->baseUrl?>/js/bootstrap.min.js"></script> -->
 <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>	
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.zoom.js"></script>
 

 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/main.js"></script>
 <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/common.js"></script> 
 <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.mobilemenu.min.js"></script>
 
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/zoom.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/slick.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/smoothproducts.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/slider/photoswipe.min.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/slider/photoswipe-ui-default.min.js"></script>


 
<!-- Include all compiled plugins (below), or include individual files as needed -->
 

<script> (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-101237588-1', 'auto'); ga('send', 'pageview');

</script> 

</head>
<body>
	<header role="banner" id="top"
		class="navbar header-section navbar-static-top bs-docs-nav">
		
			<div class="top-bar animate-dropdown">
			<div class="container">
			<div class="header-top-inner">
					
			<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<?php
			
			//$data = "loginnnnnnn";
		//	echo TranslateModule::t('login');
			
		//	$data = TranslateModule::getTranslateLang("login",$lang);
			//echo Message::model()->getAttributeLabel('some text');
			/* echo "<pre>";
			print_r($lang);
			die(); */
			
			//$this->widget ( 'ext.widgets.LanguageSelector' );
			
			?>
				<div class="nav navbar-nav logo-nav">
		<a class=" brandName" 
						href="<?php echo Yii::app()->getHomeUrl();?>">
							<img class="img-responsive" height="100px" width="150px" src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/2017_Logo_IBIZA_Sunangel.png" />
						</a>
					
				</div>

			</div>
			
			

			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<div class="search-box">
						<form action="<?php echo Yii::app()->createUrl('product/searchResults');?>" id="products_search_form" >
							<div class="input-group custom-serach-input"
								style="min-width: 250px;">
								             <?php 
								             $search_key = Yii::app()->getRequest()->getQuery('q');
								             $this->widget ( 'booster.widgets.TbTypeahead', array (
														'name' => 'q',
														'id' => 'products',
								             			'value' => $search_key != null ?  Html::encode( $search_key ) : null,
														'htmlOptions' => array (

																'placeholder' => Yii::t('app','be yourself, look for your style').' ...' 

														),
														'options' => array (					
															'source' => Product::getAllProducts (),
															'items' => 50,
															'class' => 'form-control searchforminput',
															'matcher' => "js:function(item) {
                                                                			return ~item.toLowerCase().indexOf(this.query.toLowerCase());
																			}" 
													) ) );
											?>
								<?php  /* <input type="text" name="q" class="form-control searchforminput" placeholder="Be you, Search your style..." value="<?php echo $search_key != null ? $search_key : null; ?>"> */ ?>
								<span class="input-group-btn">
									<button type="submit" class="search-btn-u">
										<span class="fa fa-search"></span>
									</button>
								</span>
							</div>
						</form>


					</div>

				
				</div>
			<div class="cnt-account col-lg-5 col-md-5 col-sm-5 col-xs-12 text-right">
			
			<ul class="list-unstyled">
			<?php 
			
			$translate=Yii::app()->translate;
			//in your layout add
			echo $translate->dropdown();
			//adn this
			//if($translate->hasMessages()){
				//generates a to the page where you translate the missing translations found in this page
				//echo $translate->translateLink('Translate');
				//or a dialog
				//echo $translate->translateDialogLink('Translate','Translate page title');
			//}
			//link to the page where you edit the translations
			//echo $translate->editLink('Edit translations page');
			//link to the page where you check for all unstranslated messages of the system
			//echo $translate->missingLink('Missing translations page');
			?>
			<?php if(!Yii::app()->user->isGuest){
				
			$user = Yii::app()->user->model;?>
				<?php if(Yii::app()->user->isAdmin){?>

				<li class="<?php echo ($this->id == 'admin' and $this->action->id == 'index') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('admin/index');?>" ><i class="icon fa fa-dashboard"></i><?php echo Yii::t('app','control panel');?> </a></li>
				<li class="<?php echo ($this->id == 'user' and $this->action->id == 'account') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/account');?>" ><i class="icon fa fa-user"></i><?php echo Yii::t('app','my account');?> </a></li>
				<?php }else{?>
					<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'create') ? 'active' : ''?>"><!-- <i class="icon fa fa-globe"></i> <select class="lang-sel"><option>select Language</option><option>English</option><option>Português</option></select></li> -->


					</li>
				 <li class="<?php echo ($this->id == 'order' and $this->action->id == 'buy') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('order/buy');?>" ><i class="icon fa fa fa-shopping-cart"></i><?php echo Yii::t('app','my orders');?></a></li>
			<!-- 	 <li class="<?php //echo ($this->id == 'address' and $this->action->id == 'index') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('address/index');?>" ><i class="icon fa fa-user"></i> Shipping Address</a></li>  -->
				<li class="dropdown">
                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Hi! <?php echo isset($user)?$user->first_name:'';?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo Yii::app()->createUrl('user/accountb');?>"><i class="icon fa fa-user"></i> <?php echo Yii::t('app', 'my Account')?></a></li>
                
				<li><a href="<?php echo Yii::app()->createUrl('user/changePassword');?>"><i class="icon fa fa fa-key"></i> <?php echo Yii::t('app', 'change password')?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('user/update');?>"><i class="icon fa fa fa-pencil"></i> <?php echo Yii::t('app', 'update profile')?></a></li>
				<li><a href="<?php echo Yii::app()->createUrl('user/logout');?>"><i class="icon fa fa-sign-in"></i><?php echo Yii::t('app', 'logout')?> </a></li>
                </ul>
              </li>
		
				
				
			<?php }?>
			
			<?php }else{?>
			
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'create') ? 'active' : ''?>"><!-- <i class="icon fa fa-globe"></i> <select class="lang-sel"><option>select Language</option><option>English</option><option>Português</option></select></li> -->
				</li>

			
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'login') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/login');?>"> <?php echo Yii::t('app','login');?></a></li>
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'login') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/create');?>"><?php echo Yii::t('app','register')?></a></li>

			
			<?php }?>
			</ul>
			</div>
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
				<div class="header_right row">
					<div class="cart-box">
					<a href="<?php echo Yii::app()->createUrl('cart/index');?>">
					
						<div class="ic_wishlist">
						<?php 
						if(!Yii::app()->user->isGuest){
								$cart = Cart::model()->findByAttributes(array('create_user_id'=> Yii::app()->user->id));
								$count = 0;
								if($cart != null){
									$count = CartItem::model()->countByAttributes(array('cart_id'=>$cart->id));
									if($count != 0){
								?>
									<div class="ic_cart" id="cart_item_details">
						<span class="simpleCart_total">€<?php echo $cart->amount;?></span>
								<i class="fa  fa-shopping-cart" > <sup><?php echo $count;?></sup></i></a>
						</div>
									<?php }}else{
								?>
									<span class="simpleCart_total">€ 0.00</span> (<span
										id="simpleCart_quantity" class="simpleCart_quantity">0</span>
									<?php echo Yii::t('app','items');?>)
									<?php }}else{?>
									<span class="simpleCart_total">€ 0.00</span> (<span
										id="simpleCart_quantity" class="simpleCart_quantity">0</span>
									<?php echo Yii::t('app','items');?>)
									<?php }?>
									
						<?php if(Yii::app()->user->isGuest){?>
							<a href="<?php echo Yii::app()->createUrl('user/login');?>"><i class="fa fa-heart-o "> <sup></sup></i></a>
							<?php }else {
								$userid = Yii::app()->user->id;
								$list = WishList::getTotalWishList($userid);
								if(!empty($list)){ ?>
							<a href="<?php echo Yii::app()->createUrl('product/wishlist',array('id' => $userid));?>" id="total_wishlist_count">	<i class="fa fa-heart"></i><sup><?php echo $list; ?></sup> </a>
							<?php }else {?>
							<a href="<?php echo Yii::app()->createUrl('product/wishlist',array('id' => $userid));?>" id="total_wishlist_count">	<i class="fa fa-heart-o "></i><sup></sup></a>
							<?php }?>
						<?php }?>
						</div>
					</div>
			
			<div class="clearfix"></div>
			</div>
			</div>
			</div>
				
			
<div class="clearfix"></div>


		</div>
		</div>
		 <?php include 'nav2.php';?>
		 <?php $pages = Page::model()->findAll();
		 if(!empty($pages)){
		 ?>
		
		<div class="navigation-bottom">
			<div class="container">
			<div class="col-md-12">
				<ul class="list inline">
				<?php $count = 0?>
				 <?php foreach ($pages as $page){if($count!=3){?>
				 
					
						<li>
						<a href="<?php echo Yii::app()->createUrl('page/detailpage',array('id' => $page->id));?>">
						<?php echo $page->title;?>
						</a>
						</li>
					
					<?php $count ++;?>
				<?php }}?>
					
				</ul>
			</div>
</div>
		</div>
		<?php }?>
		
		
	</header>