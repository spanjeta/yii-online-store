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




<script src="<?php echo Yii::app()->theme->baseUrl?>/js/owl.carousel.js"></script>
<script
	src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.mobilemenu.min.js"></script>
<script
	src="<?php echo Yii::app()->theme->baseUrl?>/js/bootstrap.min.js"></script>

<script src="<?php echo Yii::app()->theme->baseUrl?>/js/zoom.js"></script>

</head>

<body class="skin-blue skin-black">


	<div class="wrapper">

		<!-- Top Content Bar Start -->

		<header class="main-header">
			<!-- Logo -->


			<a class="logo" href="<?php echo Yii::app()->getHomeUrl();?>"> Online
				Store </a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav role="navigation" class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<!--<a role="button" data-toggle="offcanvas" class="sidebar-toggle"
					href="#"> <span class="sr-only">Toggle navigation</span>
				</a>-->
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->

						<!-- User Account: style can be found in dropdown.less -->

						<li class="dropdown user user-menu"><a data-toggle="dropdown"
							class="dropdown-toggle" href="#"> <?php $file = Yii::app ()->basePath . '/..' . UPLOAD_PATH . Yii::app()->user->model->image_file;?>
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
								<li class="user-header"><?php $file = Yii::app ()->basePath . '/..' . UPLOAD_PATH . Yii::app()->user->model->image_file;?>
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
											href="<?php echo Yii::app()->createUrl('user/view')?>">My
											Account </a>
									</div>

									<div class="pull-right">
										<a class="btn btn-warning btn-flat"
											href="<?php echo Yii::app()->createUrl('user/logout')?>">Sign
											out</a>
									</div>
								</li>
							</ul></li>

					</ul>
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
							class="fa fa-dashboard"></i><span> DashBoard </span> </a>
					</li>
					<li class="treeview"><a href="#" class="active"> <i
							class="fa fa-tasks"></i> <span>Products </span><i
							class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">

						
							<?php if (Yii::app()->user->isAdmin) {?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('product/admin')?>">
									Products</a></li>
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
									Product Variant</a></li>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('category/admin')?>"><span>
										Product Categories </span> </a></li>
										
										
										
							<?php }?>
						</ul></li>


					<li class="treeview"><a href="#" class="active"> <i
							class="fa fa-clipboard"></i> <span>Add Attributes </span><i
							class="fa fa-angle-left pull-right"></i>
					</a>
						<ul class="treeview-menu">

						
							<?php if (Yii::app()->user->isAdmin) {?>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('color/admin')?>"> Add
									Colors</a></li>
							<li class="active"><a
								href="<?php echo Yii::app()->createUrl('brand/admin')?>"> Add
									Brand</a></li>
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
										Add Sizes </span> </a></li>
										
										
										
							<?php }?>
						</ul></li>


					<li
						class="<?php echo ($this->id == 'user' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('user/index')?>"> <i
							class="fa fa-users"></i><span> Users </span>
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
						class="<?php echo ($this->id == 'page' and $this->action->id == 'admin') ? 'active' : ''?>">
						<a href="<?php echo Yii::app()->createUrl('page/admin')?>"> <i
							class="fa fa-file-text"></i><span> Pages </span>
					</a>
					</li>

					<li
						class="<?php if(Yii::app()->controller->id == 'page'  && Yii::app()->controller->action->id =="admin") echo "active";  ?>">
						<a href="<?php echo $this->createUrl('/backup/default/index'); ?>">
							<i class="fa fa-database"></i> <span>Backup</span>
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
					<li><a href="<?php echo Yii::app()->createUrl('/user/signup');?>">Sign
							up</a></li>
					<li class="login_menu"><a
						href="<?php echo Yii::app()->createUrl('/user/login');?>"
						tabindex="-1">Log in</a></li>
					<?php }?>

				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>





		<div class="content-wrapper" style="min-height: 700px;">


		<?php
			$this->breadcrumbs=array(
					'Manage'=>array('index'),
			);?>

			<section class="content-header">
				<h1>Manage database backup files</h1>
			</section>


			<section class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header with-border">

								<?php   $this->widget('booster.widgets.TbMenu', array(
									'items'=>$this->actions,
									'type'=>'success',
									'htmlOptions'=>array('class'=> 'pull-right'),
									));
								?>
							</div>
							<div class="box-body">
								<?php $this->renderPartial('_list', array(
					'dataProvider'=>$dataProvider,
			));
			?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>


		<footer class="main-footer text-center">

			<strong> Copyrights  &copy; <?php echo date('Y');?> <a href=""><?php echo Yii::app()->params['company']?></a>.
			</strong> All rights reserved | Powered by</span> | <a target=_blank
				href="http://toxsl.com/">ToXSL TECHNOLOGIES Pvt. Ltd.</a>
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
	
</script>






</body>
</html>







