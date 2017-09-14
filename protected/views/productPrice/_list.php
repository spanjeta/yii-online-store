
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'product-price-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('productPrice/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'min_price',
		'max_price',
		'min_quantity',
		'max_quantity',
		array(
			'name'=>'category_id',
			'value'=>'Html::valueEx($data->category)',
			'filter'=>Html::listDataEx(Category::model()->findAllAttributes(null, true)),
			),
		/*
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>ProductPrice::getStatusOptions(),
				),
		*/
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>