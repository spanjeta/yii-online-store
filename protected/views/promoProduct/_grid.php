
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'promo-product-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('promoProduct/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	//'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		array(
			'name'=>'cart_id',
			'value'=>'Html::valueEx($data->cart)',
			'filter'=>Html::listDataEx(Cart::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'promo_id',
			'value'=>'Html::valueEx($data->promo)',
			'filter'=>Html::listDataEx(PromoCode::model()->findAllAttributes(null, true)),
			),
		array(
			//	'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
			//	'labels' => PromoProduct::getLabelOptions(),
				'filter'=>PromoProduct::getStatusOptions(),
			
                
				
				),
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>PromoProduct::getTypeOptions(),
				),
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>