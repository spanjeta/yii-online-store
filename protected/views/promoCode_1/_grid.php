
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'promo-code-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('promoCode/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	//'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		'title',
		'code',
		'discount',
		'expiry_date:datetime',
		array(
				//'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				//'labels' => PromoCode::getLabelOptions(),
				'filter'=>PromoCode::getStatusOptions(),
			
                
				
				),
		/*
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>PromoCode::getTypeOptions(),
				),
		*/
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>