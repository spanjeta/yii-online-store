
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'feed-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('feed/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		
	/* 	array(
				'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'labels' => Feed::getLabelOptions(),
				'filter'=>Feed::getStatusOptions(),
			
                
				
				), */

	/* 	array(
				'name' => 'model_type',
				'type' =>'raw',
				'value'=>'$data->getModelObject()',
				), */
		'create_time:datetime',
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>