<section class="content-header">
	<h1>
		<?php echo Yii::t('app','manage') . ' : ' .Html::encode(Yii::t('app',$model->label(2))); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i
				class="fa fa-dashboard"></i> <?php echo Yii::t('app', 'home')?></a></li>
		<li class="active"><?php echo Yii::t('app', 'manage pages')?></li>
	</ol>
</section>


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
				</div>
				<!-- /.box-header -->
				<div class="box-body">			

	<?php
	
$this->widget ( 'booster.widgets.TbGridView', array (
			'id' => 'page-grid',
			'type' => 'striped bordered condensed',
			'htmlOptions' => array (
					'style' => 'cursor: pointer;' 
			),
			'selectionChanged' => "function(id){window.location='" . Yii::app ()->createAbsoluteUrl ( 'page/view' ) . "/' + $.fn.yiiGridView.getSelection(id);}",
			'pager' => true,
			'dataProvider' => $model->search (),
			'filter' => $model,
			'columns' => array (
					
					array (
							'header' => Yii::t('app','id'),
							'name' =>'id',
							'type' => 'raw',
							
							// 'value'=>'Html::valueEx($data->product)',
							
							'value' => '$data->id'
					), 
					array (
							'header' => Yii::t('app','title'),
							'name' =>'title',
							'type' => 'raw',
							
							// 'value'=>'Html::valueEx($data->product)',
							
							'value' => '$data->title'
					), 
					
					// 'url',
					/*
					 * array(
					 * 'name' => 'type_id',
					 * 'value'=>'$data->getTypeOptions($data->type_id)',
					 * 'filter'=>Page::getTypeOptions(),
					 * ),
					 * array(
					 * 'name' => 'state_id',
					 * 'value'=>'$data->getStatusOptions($data->state_id)',
					 * 'filter'=>Page::getStatusOptions(),
					 * ),
					 */
					array (
							'header' => Yii::t('app','type'),
							'name' => 'type_id',
							'value' => '$data->getTypeOptions($data->type_id)',
							'filter' => Page::getTypeOptions () 
					),
		/*
		'update_time',
		*/
		
					array(
							'class'=>'booster.widgets.TbButtonColumn',
							'header'=>Yii::t('app','actions'),
							'htmlOptions' => array('nowrap'=>'nowrap'),
							'template'=>'{view}{update}{delete}'
					),  
			) 
	) );
	?>
</div>
			</div>
		</div>
	</div>
</section>

