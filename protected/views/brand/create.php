<script type="text/javascript" src="/online-clothing-website-679/online-clothing/assets/e4d640f7/jquery.js"></script>
<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>
<div class="content-header">
	<h1><?php echo Yii::t('app','create brand');?> </h1>
</div>

<section class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-primary">
				<div class="create-brand">
				<?php 
if(!empty($error)){?>
<div class = "alert alert-error">
	<div class="flash-error">
		<?php echo $error;?>
	</div>
</div>
	
<?php }?>
					<?php $this->renderPartial('_form', array('model'=>$model)); ?>
				</div>
			</div>
		</div>
	
</section>

