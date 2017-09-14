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
				
<?php   $this->widget('bootstrap.widgets.TbButtonGroup', array(
	'buttons'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>
</div>
						
				</div>
				<!-- /.box-header -->
				<div class="box-body">	

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'title',

array(
			'name' => 'createUser',
			'type' => 'raw',
			'value' => $model->createUser !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->createUser)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->createUser, true))) : null,
			),
'create_time',
'update_time',
	),
)); ?>

</div>

</div>
</div>
</div>
</section>