<section class="content-header">
	<h1><?php echo Yii::t('app', 'dashboard')?></h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i
				class="fa fa-dashboard"></i> <?php Yii::t('app','home')?></a></li>
		<li class="active"><?php Yii::t('app','dashboard')?></li>
	</ol>
</section>


<section class="content">

	<div class="row">
		<!-- fix for small devices only -->
		<div class="clearfix visible-sm-block"></div>



		<!-- /.col -->
		<div class="clearfix visible-sm-block"></div>

	<?php if(Yii::app()->user->isAdmin) {?>
	<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-users"></i> </span>
				<div class="info-box-content">
					<span class="info-box-text"><a
						href="<?php echo Yii::app()->createUrl('user/index')?>"><span>
								<?php echo Yii::t('app','total users')?>  </span> </a><span class="info-box-number"><?php echo $allusers;?></span> </span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->


		</div>

		<!--	<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-user"></i> </span>
				<div class="info-box-content">
					<span class="info-box-text">New Users</span> <span
						class="info-box-number"><?php //echo $newusers;?> </span>
				</div>
				<!-- /.info-box-content -->
		<!--	</div>
			<!-- /.info-box -->
		<!--</div> -->
	<?php }?>
	<!--<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-tasks"></i> </span>
				<div class="info-box-content">
					<span class="info-box-text">Total Products</span> <span
						class="info-box-number"><?php //echo $products;?> </span>
				</div>
				<!-- /.info-box-content -->
		<!--</div>
			<!-- /.info-box -->
		<!--</div>
		<!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-credit-card"></i>
				</span>
				<div class="info-box-content">
					<span class="info-box-text"></span> <span class="info-box-text"><a
						href="<?php echo Yii::app()->createUrl('order/admin')?>"><span>
								<?php echo Yii::t('app','total orders')?> </span> </a><span class="info-box-number"><?php echo $orders;?></span> </span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
		<!-- /.col -->
		<div class="col-md-12">
			<!-- TABLE: LATEST ORDERS -->
			<div class="box box-info">

				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					
				<?php
				
$this->widget ( 'booster.widgets.TbHighCharts', array (
						'options' => array (
								'chart' => array (
										'type' => 'line' 
								),
								'title' => array (
										'text' => 'Roupas Online' 
								),
								'subtitle' => array (
									// 'text' => 'Online Clothing'
								),
								'tooltip' => array (
										// 'valueSuffix' => '/-',
										'valuePrefix' => '€ ' 
								),
								'plotOptions' => array (
										'pie' => [ 
												'allowPointSelect' => true,
												'cursor' => 'pointer',
												'dataLabels' => [ 
														'enabled' => false 
												],
												'showInLegend' => true 
										] 
								),
								'series' => array (
										[ 
												'name' => 'Amount',
												'data' => $dataPrice 
										] 
								
								),
				
				/* 'series' => array (
						[ 
								'data' => [
										[
												'name' => 'Amount',
												'y' => $dataPrice
										]
								] 
						
						] 
				
				), */
				'xAxis' => array (
										'categories' => $dataTime 
								
								) 
						
						),
						'htmlOptions' => array (
								'style' => 'min-width: 310px; height: 400px; margin: 0 auto' 
						) 
				) );
				?>

					
					
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<!-- TABLE: LATEST ORDERS -->
			<div class="box box-info">

				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">

				<?php
				
				$this->renderPartial ( 'baseUser', array (
						'model' => $model 
				) );
				?>
				</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col -->
		<div class="col-md-4">
			<!-- PRODUCT LIST -->
			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
</section>
