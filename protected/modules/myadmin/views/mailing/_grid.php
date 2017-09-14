
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'mailing-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('mailing/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		'subject',
		'queue:html',
		'sent:html',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Mailing::getTypeOptions(),
				),
		array(
				//'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				//'labels' => Mailing::getLabelOptions(),
				'filter'=>Mailing::getStatusOptions(),
			
                
				
				),
		/*
		'finishedOn:datetime',
		*/
			array (
					'header' => '<a>Actions</a>',
					'class' => 'CxButtonColumn',
					'buttons' => array (
							'view' => array (
									'url' => 'Yii::app()->createUrl("/myadmin/mailing/view",  array("id"=>$data->id) )'
							),
							'update' => array (
									'url' => 'Yii::app()->createUrl("/myadmin/mailing/update",  array("id"=>$data->id) )'
							),
							'delete' => array (
									'url' => 'Yii::app()->createUrl("/myadmin/mailing/delete",  array("id"=>$data->id) )'
							)
					)
			) /* 
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		), */
	),
)); ?>