<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Category</li>
	</ol>
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
				<!-- /.box-header -->
				<div class="box-body">			

		<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'category-grid',
	'type'=>'striped bordered condensed',
			'htmlOptions'=>array('style'=>'cursor: pointer;'),
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('category/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
'pager'=>true,
				'enablePagination'=>true,
	'dataProvider' => $model->search(),
				
	'filter' => $model,
			'pager'=>array(
      'class'=>'CLinkPager',

'htmlOptions' => array(
            'class' => 'pager',
		),

		),
	'columns' => array(
		'id',
	/* 	array(
'header'=>'<a>Image</a>',

		'type' => 'html',
'value'=>'CHtml::image($data->getImage($data))'

), */
		'title',
/* array(
			 'header'=>'Total Product',
			 'type'=>'html',
			 'value'=> '$data->totalProductCount($data->id)'

			 ), */


		
			 /*array(
			  'name'=>'file_path',
			  'type'=>'html',
			  'value'=>'$data->userCheck()'

			  ),*/

			 	array(
			 			'header'=>'Actions',
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

