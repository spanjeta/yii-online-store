
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'comment-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('comment/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		array(
				'name' => 'model_type',
				'value'=>'$data->getTypeOptions($data->model_type)',
				'filter'=>Comment::getTypeOptions(),
				),
		'model_id',
		'comment:html',
		array(
				//'class' => 'LabelColumn',
				'name' => 'state_id',
				//'value'=>'$data->getStatusOptions($data->state_id)',
				//'labels' => Comment::getLabelOptions(),
				//'filter'=>Comment::getStatusOptions(),
			
                
				
				),
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>