<?php
/* @var $this BrandController */
/* @var $model Brand */

$this->breadcrumbs=array(
	'Brands'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Brand', 'url'=>array('index')),
	array('label'=>'Create Brand', 'url'=>array('create')),
	array('label'=>'View Brand', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Brand', 'url'=>array('admin')),
);
?>
<div class="content-header">
<h1>Update Brand <?php echo $model->id; ?></h1>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="panel-heading vd_bg-yellow">
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
	</div>
</section>