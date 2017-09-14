<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords"
	content="<?php echo CHtml::encode($this->getPageKeywords());?>" />
<meta name="description"
	content="<?php echo CHtml::encode($this->getPageDescription());?>" />
<meta name="author" content="<?php echo Yii::app()->params['company']?>" />
<title><?php echo Yii::app()->params['company'] ?></title>
<script type="text/javascript">
var url11 = '<?php echo Yii::app()->theme->baseUrl;?>';
</script>
<link
	href="<?php echo Yii::app()->theme->baseUrl;?>/css/bootstrap.min.css"
	rel="stylesheet">
<link
	href="<?php echo Yii::app()->theme->baseUrl;?>/css/AdminLTE.min.css"
	rel="stylesheet">
<link
	href="<?php echo Yii::app()->theme->baseUrl;?>/css/_all-skins.min.css"
	rel="stylesheet">

<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/css/font-awesome.min.css" />
<link href='//fonts.googleapis.com/css?family=Questrial'
	rel='stylesheet' type='text/css'>
<link href="<?php echo Yii::app()->theme->baseUrl?>/css/uploadfile.css"
	rel="stylesheet">


<link rel="icon" href="<?php 

echo Yii::app ()->theme->baseUrl
."/images/cart.png";

?>" type="image/gif" sizes="16x16">
<!--  <script	src="<?php //echo Yii::app()->theme->baseUrl?>/js/bootstrap.min.js"></script> -->
<script src="<?php echo Yii::app()->theme->baseUrl?>/js/common.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>

<script	src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.mobilemenu.min.js"></script>


<script src="<?php echo Yii::app()->theme->baseUrl?>/js/zoom.js"></script>

</head>

<body class="skin-blue skin-black">


	<div class="wrapper">

		<!-- Top Content Bar Start -->

		<header class="main-header">
			<!-- Logo -->


			<a class="logo" href="<?php echo Yii::app()->getHomeUrl();?>">Loja online
				 </a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav role="navigation" class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<!--<a role="button" data-toggle="offcanvas" class="sidebar-toggle"
					href="#"> <span class="sr-only">Toggle navigation</span>
				</a>-->
				
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
				<ul class="nav navbar-nav list-wrapper">
						<!-- Messages: style can be found in dropdown.less-->

						<!-- User Account: style can be found in dropdown.less -->
						
					<li class="dropdown user user-menu clearfix"><a data-toggle="dropdown"
							class="dropdown-toggle" href="#">
							
							<span class="mega-icon"><i
						class="fa fa-globe"></i></span> <span class="badge vd_bg-red"><?php echo Feed::getFeedsCount();?></span>
							</a>
							<ul class="dropdown-menu">
							<?php
		
		$feeds = Feed::getRecentFeeds ( false );
		foreach ( $feeds as $feed ) {
			
			$class = $feed->model_type;
			$model = $class::model ()->findByPk ( $feed->model_id );
		
			?>
			
			<li class="notification-menu-list">
			<a href="#">
											<div class="menu-icon">
												<i class="fa fa-globe"></i>
											</div>
											<div class="menu-text">
										
										<?php echo $feed->content; echo ' ' ;?>
											<?php if ( $model != null){?>	
											<a href="<?php echo $model->url ;?>"><?php echo $model ;?></a>
										<?php }?>
				
		
											
											</div>
									</a>
									</li>
										
									<?php } ?>	
									<li class="closing text-center" style="">
								<a href="<?php echo Yii::app()->createUrl('feed/index')?>">
								<?php echo Yii::t('app', 'See All Notifications')?> <i class="fa fa-angle-double-right"></i>
								</a>
							</li>
									
								</ul></li>
			
				<li class="user-account">

					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->

						<!-- User Account: style can be found in dropdown.less -->
						
							
						<li class="dropdown user user-menu"><a data-toggle="dropdown"
							class="dropdown-toggle" href="#"> <?php $file = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER.Yii::app()->user->model->image_file;?>
							<?php if(file_exists($file)) {?> <?php
								
								if (! empty ( Yii::app ()->user->model->image_file )) {
									$user = Yii::app ()->user->model;
									echo CHtml::image ( $user->getImage (), 'image', array (
											'class' => 'user-image' 
									) );
								} else {
									echo CHtml::image ( Yii::app ()->theme->baseUrl . '/images/user.png', 'image', array (
											'class' => 'user-image' 
									) );
								}
							} else {
								echo CHtml::image ( Yii::app ()->theme->baseUrl . '/images/user.png', 'image', array (
										'class' => 'user-image' 
								) );
							}
							?> <span class="hidden-xs"> <?php echo Yii::app()->user->model->first_name;?>
							</span> <i class="fa fa-angle-down"></i>
						</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="drop-list"><?php $file = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER.Yii::app()->user->model->image_file;?>
								<?php if(file_exists($file)) {?> <?php
									
									if (! empty ( Yii::app ()->user->model->image_file )) {
										$user = Yii::app ()->user->model;
										echo CHtml::image ( $user->getImage (), 'image', array (
												'class' => 'img-circle' 
										) );
									} else {
										echo CHtml::image ( Yii::app ()->theme->baseUrl . '/images/user.png', 'image', array (
												'class' => 'img-circle' 
										) );
									}
								} else {
									echo CHtml::image ( Yii::app ()->theme->baseUrl . '/images/user.png', 'image', array (
											'class' => 'img-circle' 
									) );
								}
								?>

									
								</li>

								<li class="user-footer">

									<div class="pull-left">
										<a class="btn btn-warning btn-flat"
											href="<?php echo Yii::app()->createUrl('user/view')?>"><?php 
											echo Yii::t('app', 'my account');
											?>
											</a>
									</div>

									<div class="pull-right">
										<a class="btn btn-warning btn-flat"
											href="<?php echo Yii::app()->createUrl('user/logout')?>"><?php 
											echo Yii::t('app', 'logout');
											?>
										</a>
									</div>
								</li>
							</ul></li>

			
				</li>
				</div>
			</nav>
		</header>




		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar" style="height: auto;">
				<!-- Sidebar user panel -->




				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">

					
					<?php if(!Yii::app()->user->isGuest){?>



					<?php if( Yii::app()->user->isAdmin ){?>
					<li
						class="<?php echo ($this->id == 'admin' and $this->action->id == 'index') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('admin/index')?>"><i
							class="fa fa-dashboard"></i><span> <?php echo Yii::t('app','dashboard');?> </span> </a>
					</li>
					<li class="treeview"><a href="#" class="active"> <i
							class="fa fa-tasks"></i> <span><?php echo Yii::t('app','products');?> </span><i
							class="fa fa-angle-right pull-right"></i>
					</a>
						<ul class="treeview-menu">

						
							<?php if (Yii::app()->user->isAdmin) {?>
							
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('category/admin')?>"><span>
										<?php echo Yii::t('app','product categories');?> </span> </a></li>
										
										
							
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('product/admin')?>">
									<?php echo Yii::t('app','products');?></a></li>
							<?php
								/*
								 * ?>
								 * <li class="active"><a
								 * href="<?php echo Yii::app()->createUrl('couponOptions/admin')?>">Manage
								 * Coupon Credit Options </a>
								 * </li>
								 */
								?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('varProduct/admin')?>">
									<?php echo Yii::t('app','product variant');?></a></li>


						<li class="active">
								<a href="<?php echo Yii::app()->createUrl('promoCode/index')?>">
									<?php echo Yii::t('app','add coupon');?> </a></li> 

										
							<?php }?>
						</ul></li>

					<li class="treeview"><a href="#" class="active"> <i
							class="fa fa-clipboard"></i> <span><?php echo Yii::t('app','add attributes');?> </span><i
							class="fa fa-angle-right pull-right"></i>
					</a>
						<ul class="treeview-menu">

						
							<?php if (Yii::app()->user->isAdmin) {?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('color/admin')?>"> <?php echo Yii::t('app','add colors');?>
								</a></li>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('brand/admin')?>"> <?php echo Yii::t('app','add brand');?>
									</a></li>
							
							<?php
								/*
								 * ?>
								 * <li class="active"><a
								 * href="<?php echo Yii::app()->createUrl('couponOptions/admin')?>">Manage
								 * Coupon Credit Options </a>
								 * </li>
								 */
								?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('size/admin')?>"><span>
									<?php echo Yii::t('app','add sizes');?>	 </span> </a></li>
								
										
										
							<?php }?>
						</ul></li>
<li class="treeview"><a href="#" class="active"> <i
							class="fa fa-tasks"></i> <span><?php echo Yii::t('app','news letter');?> </span><i
							class="fa fa-angle-right pull-right"></i>
					</a>
						<ul class="treeview-menu">

						
							<?php if (Yii::app()->user->isAdmin) {?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('emailTemplate/add')?>"><span>
										<?php echo Yii::t('app','create new template');?> </span> </a></li>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('/myadmin/mailing/add')?>"><span>
										<?php echo Yii::t('app','create new mail');?> </span> </a></li>
						

<?php }?>
</ul></li>

					<li
						class="<?php echo ($this->id == 'user' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('user/index')?>"> <i
							class="fa fa-users"></i><span> <?php echo Yii::t('app','users');?> </span>
					</a>
					</li>

					<!-- 		<li
						class="<?php //echo ($this->id == 'rssFeed' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php // echo Yii::app()->createUrl('rssFeed/admin')?>"> <i
							class="fa fa-file-text"></i><span> RssFeed </span>
					</a>
					</li> - -->
					<!-- -	<li
						class="<?php //echo ($this->id == 'order' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php //echo Yii::app()->createUrl('order/admin')?>"> <i
							class="fa fa-file-text"></i><span> Orders </span>
					</a>
					</li>  --->
					<!-- -	<li
						class="<?php //echo ($this->id == 'productPrice' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php //echo Yii::app()->createUrl('productPrice/admin')?>">
							<i class="fa fa-file-text"></i><span> Price </span>
					</a>
					</li> --->
					<li
						class="<?php echo ($this->id == 'order' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('order/admin')?>"> <i
							class="fa fa-credit-card"></i><span>  <?php echo Yii::t('app','orders');?> </span>
					</a>
					</li>
					<li
						class="<?php echo ($this->id == 'banner' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('banner/manage')?>"> <i
							class="fa fa-picture-o"></i><span><?php echo Yii::t('app','add banner');?>  </span>
					</a>
					</li>
					<li
						class="<?php echo ($this->id == 'banner' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('paymentSetting/add')?>"> <i
							class="fa fa-money"></i><span><?php echo Yii::t('app','paypal setting');?>  </span>
					</a>
					</li>
					<li
						class="<?php echo ($this->id == 'page' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('page/admin')?>"> <i
							class="fa fa-info"></i><span><?php echo Yii::t('app','pages ');?>  </span>
					</a>
					</li>
					
					<li
						class="<?php echo ($this->id == 'page' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('setting/admin')?>"> <i
							class="fa fa-cog"></i><span><?php echo Yii::t('app','setting ');?>  </span>
					</a>
					</li>
					
					<li
						class="<?php echo ($this->id == 'page' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('emailTemplate/admin')?>"> <i
							class="fa fa-envelope"></i><span> <?php echo Yii::t('app','email template ');?> </span>
					</a>
					</li>
					
					
					<li
						class="<?php if(Yii::app()->controller->id == 'page'  && Yii::app()->controller->action->id =="admin") echo "active";  ?>">
						<a href="<?php echo $this->createUrl('/backup/default/index'); ?>">
							<i class="fa fa-database"></i> <span><?php echo Yii::t('app','backup ');?></span>
					</a>
					</li>
					<li
						class="<?php if(Yii::app()->controller->id == 'page'  && Yii::app()->controller->action->id =="admin") echo "active";  ?>">
						<a href="<?php echo $this->createUrl('/translate/edit/admin'); ?>">
							<i class="fa fa-language"></i> <span><?php echo Yii::t('app','edit translations page');?></span></span>
					</a>
					</li>
					
					<li
						class="<?php if(Yii::app()->controller->id == 'page'  && Yii::app()->controller->action->id =="admin") echo "active";  ?>">
						<a href="<?php echo $this->createUrl('/translate/edit/missing'); ?>">
							<i class="fa fa-language"></i> <span><?php echo Yii::t('app','missing translations page');?></span>
					</a>
					</li>
					
					<?php }?>

						

					
					<?php  if(Yii::app()->user->isAdmin){?>
				
							
							<?php
							/*
							 * $business_model = Yii::app ()->user->model->business [0];
							 * if ($business_model == null) {
							 * ?>
							 * <li><a
							 * href="<?php echo Yii::app()->createUrl('/business/create');?>"
							 * tabindex="-1">Add Brand</a></li>
							 * <?php } else {?>
							 * <li><a
							 * href="<?php echo Yii::app()->createUrl('business/view',array ('id' => $business_model->id));?>"
							 * tabindex="-1"> <span>My Business </span>
							 * </a></li>
							 * <?php }
							 */
							?>


	<?php
							/*
							 * ?>
							 * <li class="treeview"><a href="#" class=""><i class="fa fa-desktop"></i>
							 * <span>Payment Options </span><i
							 * class="fa fa-angle-left pull-right"></i> </a>
							 * <ul class="treeview-menu">
							 *
							 * <li class="active"><a
							 * href="<?php echo Yii::app()->createUrl('transaction/admin')?>">
							 * <span> Transactions </span> </a>
							 * </li>
							 * <li class="active"><a
							 * href="<?php echo Yii::app()->createUrl('creditOptions/admin')?>">
							 * <span>Credit Options </span> </a>
							 * </li>
							 *
							 * </ul>
							 * </li>
							 */
							?>
	<?php
							/*
							 * ?><li
							 * class="<?php echo ($this->id == 'page' and $this->action->id == 'admin') ? 'active' : ''?>">
							 * <a href="<?php echo Yii::app()->createUrl('page/admin')?>"><span>
							 * <i class="fa fa-paper-plane"></i> Pages</span> </a>
							 * </li>
							 */
							?>
				




					<?php }?>
					<?php
					} else {
						
						?>
					<li><a href="<?php echo Yii::app()->createUrl('/user/signup');?>"><?php echo Yii::t('app','sign up');?>
							</a></li>
					<li class="login_menu"><a
						href="<?php echo Yii::app()->createUrl('/user/login');?>"
						tabindex="-1"><?php echo Yii::t('app','log in');?> </a></li>
					<?php }?>

				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>





		<div class="content-wrapper" style="min-height: 700px;">


		<?php echo $content;?>
		</div>


		<footer class="main-footer text-center">

			<strong> <?php echo Yii::t('app','copyrights');?>  &copy; <?php echo date('Y');?> <a href=""><?php echo Yii::app()->params['company']?></a>.
			</strong> <?php echo Yii::t('app','all rights reserved | powered by');?></span> | <a target=_blank
				href="http://toxsl.com/"><?php echo Yii::t('app','toxsl technologies pvt. ltd.');?></a>
		</footer>


		<script
			src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.uploadfile.min.js"></script>



		<script src="<?php echo Yii::app()->theme->baseUrl;?>/js/app.min.js"
			type="text/javascript"></script>



	</div>
	<!-- Wrapper -->


	<script>

$(document).ready(function () {

	$('[data-toggle="offcanvas"]').click(function () {
	    $('.content-wrapper').toggleClass('active'),
	    $('.main-sidebar').toggleClass('active')
	  });
	});

$(document).ready(function(){
	$(".child-list").find('span').contents().unwrap();
});

var recusive_time = 1;
$(document).ready(function(){
	//alert('dddd');
		recursively_ajax();
			});
function recursively_ajax(recurlsive){


	recurlsive = (typeof recurlsive !== 'undefined') ? recurlsive : true;
	var file_count  = $('#file_count');
	//var lead_count  = $('#lead_count');
	//var task_count  = $('#task_count');

    $.ajax({
        type:"GET",
        //timeout: 10000,
    	// async: false,
        url: "<?php
echo Yii::app ()->createUrl ( 'admin/notification' );
								?>",
        success: function(data){
        		if(data['status'] == 'OK'){
	          	//file_count.html(data['feed_count']);
        		//lead_count.html(data['lead_count']);
        		//task_count.html(data['task_count']);

	 if(recurlsive == true) {
	            setTimeout(function(){
										recursively_ajax(true);
	        						 },10000);
        }

        }

    }

    });
}	

</script>







</body>
</html>

