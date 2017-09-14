
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'var-product-grid',
		'pager' => true,
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('varProduct/view') . "/id/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => isset($model) ? $model->search(): $dataProvider,
	//'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
       'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
		'id',
		'sku',
		array(
			'name'=>'product_id',
			'value'=>'Html::valueEx($data->product)',
			'filter'=>Html::listDataEx(Product::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'color_id',
			'value'=>'Html::valueEx($data->color)',
			'filter'=>Html::listDataEx(Color::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'size_id',
			'value'=>'Html::valueEx($data->size)',
			'filter'=>Html::listDataEx(Size::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'brand_id',
			'value'=>'Html::valueEx($data->brand)',
			'filter'=>Html::listDataEx(Brand::model()->findAllAttributes(null, true)),
			),
		
		'quantity',
		'price',
		//'discount_price',
		/* array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>VarProduct::getTypeOptions(),
				),
		array(
				//'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				//'labels' => VarProduct::getLabelOptions(),
				'filter'=>VarProduct::getStatusOptions(),		
				),
		 */
		array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CxButtonColumn',
		),
	),
)); ?>