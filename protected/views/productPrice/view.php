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
'id',
'min_price',
'max_price',
'min_quantity',
'max_quantity',
array(
			'name' => 'category',
			'type' => 'raw',
			'value' => $model->category !== null ? Html::link(Html::encode(Html::valueEx($model->category)), array('category/view', 'id' => ActiveRecord::extractPkValue($model->category, true))) : null,
			),
array(
				'name' => 'state_id',
				'type' => 'raw',
				'value'=>$model->getStatusOptions($model->state_id),
				),
array(
			'name' => 'createUser',
			'type' => 'raw',
			'value' => $model->createUser !== null ? Html::link(Html::encode(Html::valueEx($model->createUser)), array('user/view', 'id' => ActiveRecord::extractPkValue($model->createUser, true))) : null,
			),
'create_time',
	),
)); ?>

</div>
</div>
</div>
</div>
</section>

