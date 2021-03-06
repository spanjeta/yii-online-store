
<section class="content-header">
	<h1>
			<?php echo Yii::t('app','manage') . ' : ' . Html::encode(Yii::t('app',$model->label(2))); ?>
	
	</h1>

</section>
<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('color-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
				<?php

$this->widget ( 'booster.widgets.TbMenu', array (
		'items' => $this->actions,
		'type' => 'success',
		'htmlOptions' => array (
				'class' => 'pull-right' 
		) 
) );
?>
					<div class="pull-right">
						<div class="white-box">




							<div class="clearfix"></div>
						</div>




					</div>
				
	<?php
	
	/*
	 * $this->widget ( 'booster.widgets.TbMenu', array (
	 * 'type' => 'navbar',
	 * 'items' => $this->actions,
	 * 'htmlOptions' => array (
	 * 'class' => 'pull-right btn-group'
	 * )
	 * ) );
	 */
	?>
					
				
				</div>
				<!-- /.box-header -->
				<div class="box-body">

				<?php 	if(Yii::app()->user->hasFlash('delete')) { ?>
		<div class="alert alert-danger">
		<?php
					
					echo Yii::app ()->user->getFlash ( 'delete' );
					
					?>
			<button data-dismiss="alert" class="close" type="button">×</button>
					</div>
		<?php }?>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'brand-grid',
		'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'pager'=>true,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'title',
	/* 	'description',
		'type_id',
		'state_id', */
		'create_user_id',
		/*
		'create_time',
		'update_time',
		*/
			array(
					'class'=>'booster.widgets.TbButtonColumn',
					'htmlOptions' => array('nowrap'=>'nowrap'),
					'template'=>'{view}{update}{delete}'
			),
	),
)); ?>
	</div>
			</div>
		</div>
	</div>
</section>