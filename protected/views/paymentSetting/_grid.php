
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'payment-setting-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('paymentSetting/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		'email',
		array(
				'name' =>'mode',
				'value'=>'$data->getModeOptions($data->type_id)',
				'filter'=>PaymentSetting::getModeOptions(),
		),
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>PaymentSetting::getTypeOptions(),
				),
		array(
				//'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				//'labels' => PaymentSetting::getLabelOptions(),
				'filter'=>PaymentSetting::getStatusOptions(),
			
                
				
				),
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>