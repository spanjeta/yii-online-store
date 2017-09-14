<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('size-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="content-header">
	<h1><?php echo Yii::t('app','manage') . ' : ' .Html::encode(Yii::t('app',$model->label(2)))?></h1>
</div>


<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary dfhgdfghfd">

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
			<button data-dismiss="alert" class="close" type="button"><?php echo Yii::t('app', '×') ?></button>
					</div>
		<?php }?>
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'size-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'pager' => true,
	'filter' => $model,
	'columns' => array(
		'id',
		'title',
		/* 
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Size::getStatusOptions(),
				),
	 */
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		),
	),
)); ?>

				</div>
			</div>
		</div>
	</div>
</section>