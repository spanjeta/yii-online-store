
<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id' => 'group-category-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('groupCategory/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => $dataProvider,
	'columns' => array(
		array(
								'header'=>'<a>Sr. No.</a>',
								'value'=>'$row+1',
								
						),
		'title',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>GroupCategory::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>GroupCategory::getStatusOptions(),
				),
		'update_time',
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>