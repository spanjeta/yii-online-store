<section class="content-header">
	<h1>
		View Details
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">View Details</li>
	</ol>
	</section>




	<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				
						
			<div class="btn-group pull-right">
				
<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
		
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>
</div>
						
				</div>
				<!-- /.box-header -->
				<div class="box-body">	

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
		
'title',


'create_time',

	),
)); ?>


</div>
<div class="box-body">
<?php $this->startPanel ();?>
<?php $this->addPanel($model->getRelationLabel('subCategories'), $model->getRelatedDataProvider('subCategories'),	'subCategories','category',$model);?> 
<?php  $this->endPanel(); ?>
</div></div>
</div>
</div>
</section>

