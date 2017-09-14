<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Online store</title>
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
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/css/slick.css" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/css/slick-theme.css" />
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/css/smoothproducts.css" />


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->


	
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/main.js"></script>
 <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/common.js"></script>
  <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>
 <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.mobilemenu.min.js"></script>
  <script  src="<?php echo Yii::app()->theme->baseUrl?>/js/bootstrap.min.js"></script>

 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/zoom.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery-2.1.3.min.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/slick.js"></script>
 <script src="<?php echo Yii::app()->theme->baseUrl?>/js/smoothproducts.js"></script>
  <script src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.zoom.js"></script>
 
   
 
<!-- Include all compiled plugins (below), or include individual files as needed -->
 
</head>
<body>
	<header role="banner" id="top"
		class="navbar header-section navbar-static-top bs-docs-nav">
		
			<div class="top-bar animate-dropdown">
			<div class="container">
			<div class="header-top-inner pull-right">
			<div class="cnt-account">
			<ul class="list-unstyled">
			<?php if(!Yii::app()->user->isGuest){
			$user = Yii::app()->user->model;?>
				<?php if(Yii::app()->user->isAdmin){?>
				<li class="<?php echo ($this->id == 'admin' and $this->action->id == 'index') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('admin/index');?>" ><i class="icon fa fa-dashboard"></i> Dashboard</a></li>
				<li class="<?php echo ($this->id == 'user' and $this->action->id == 'account') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/account');?>" ><i class="icon fa fa-user"></i> My Account</a></li>
				<?php }else{?>
					<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'create') ? 'active' : ''?>"><!-- <i class="icon fa fa-globe"></i> <select class="lang-sel"><option>select Language</option><option>English</option><option>Português</option></select></li> -->

					


					<div id="google_translate_element"></div><script type="text/javascript">
					function googleTranslateElementInit() {
					  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
					}
					</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

					
					
					
					</li>
				 <li class="<?php echo ($this->id == 'order' and $this->action->id == 'buy') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('order/buy');?>" ><i class="icon fa fa-user"></i> My Orders</a></li>
			<!-- 	 <li class="<?php //echo ($this->id == 'address' and $this->action->id == 'index') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('address/index');?>" ><i class="icon fa fa-user"></i> Shipping Address</a></li>  -->
				<li class="dropdown">
                <a aria-expanded="false" aria-haspopup="true" role="button" data-toggle="dropdown" class="dropdown-toggle" href="#">Hi! <?php echo isset($user)?$user->first_name:'';?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a href="<?php echo Yii::app()->createUrl('user/accountb');?>"><i class="icon fa fa-user"></i> My Account</a></li>
                
				<li><a href="<?php echo Yii::app()->createUrl('user/changePassword');?>"><i class="icon fa fa fa-key"></i> Change Password</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('user/update');?>"><i class="icon fa fa fa-pencil"></i> Update Profile</a></li>
				<li><a href="<?php echo Yii::app()->createUrl('user/logout');?>"><i class="icon fa fa-sign-in"></i> Logout</a></li>
                </ul>
              </li>
		
				
				
			<?php }?>
			
			<?php }else{?>
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'create') ? 'active' : ''?>"><!-- <i class="icon fa fa-globe"></i> <select class="lang-sel"><option>select Language</option><option>English</option><option>Português</option></select></li> -->

					


					<div id="google_translate_element"></div><script type="text/javascript">
					function googleTranslateElementInit() {
					  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
					}
					</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

					
					
					
					</li>

			
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'login') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/login');?>"> Login</a></li>
			<li  class="<?php echo ($this->id == 'user' and $this->action->id == 'login') ? 'active' : ''?>"><a href="<?php echo Yii::app()->createUrl('user/create');?>">Register</a></li>

			
			<?php }?>
			</ul>
			</div>
			
			<div class="clearfix"></div>
			</div>
			</div>
			</div>
				
			
<div class="clearfix"></div>
<div class="main-header">
		<div class="container">
			
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 row">
				<div class="search-box">
						<form action="<?php echo Yii::app()->createUrl('product/searchResults');?>" id="products_search_form" >
							<div class="input-group custom-serach-input"
								style="min-width: 300px;">
								             <?php 
								             $search_key = Yii::app()->getRequest()->getQuery('q');
								             $this->widget ( 'booster.widgets.TbTypeahead', array (
														'name' => 'q',
														'id' => 'products',
								             			'value' => $search_key != null ?  Html::encode( $search_key ) : null,
														'htmlOptions' => array (
																'placeholder' => 'Be you, Search your style...' 
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
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
				<div class="nav navbar-nav logo-nav">
		<a class=" brandName"
						href="<?php echo Yii::app()->getHomeUrl();?>">
							<strong>Your</strong>Logo
						</a>
					
				</div>

			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
									<div class="ic_cart">
						<span class="simpleCart_total">€<?php echo $cart->amount;?></span>
								<i class="fa  fa-shopping-cart" > <sup><?php echo $count;?></sup></i></a>
						</div>
									<?php }}else{?>
									<span class="simpleCart_total">€ 0.00</span> (<span
										id="simpleCart_quantity" class="simpleCart_quantity">0</span>
									items)
									<?php }}else{?>
									<span class="simpleCart_total">€ 0.00</span> (<span
										id="simpleCart_quantity" class="simpleCart_quantity">0</span>
									items)
									<?php }?>
						<?php if(Yii::app()->user->isGuest){?>
							<a href="<?php echo Yii::app()->createUrl('user/login');?>"><i class="fa fa-heart-o "> <sup></sup></i></a>
							<?php }else {
								$userid = Yii::app()->user->id;
								$list = WishList::getTotalWishList($userid);
								if(!empty($list)){
									$countlist = WishList::model()->countByAttributes(array(
											'create_user_id' => $userid
									));
								?>
							<a href="<?php echo Yii::app()->createUrl('product/wishlist',array('id' => $userid));?>">	<i class="fa fa-heart"> <sup><?php echo $countlist;?></sup></i></a>
							<?php }else {?>
							<a href="<?php echo Yii::app()->createUrl('product/wishlist',array('id' => $userid));?>">	<i class="fa fa-heart-o "> <sup></sup></i></a>
							<?php }?>
						<?php }?>
						</div>
						

						

					</div>
				</div>
			</div>
		</div>
		</div>
		 <?php include 'nav2.php';?>
		 <?php $pages = Page::model()->findAll();
		 if(!empty($pages)){
		 ?>
		
		<div class="navigation-bottom">
			<div class="container">
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
		<?php }?>
	</header>