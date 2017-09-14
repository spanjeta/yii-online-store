
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'product-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'title',
		'sku',
'price',
							'quantity',
		array(
								
				'header' => Yii::t('app','state_id'),
									'value'=>'$data->getStatusOptions($data->state_id)',
									'filter'=>Product::getStatusOptions()
		),
		array(
								
				'header' => Yii::t('app','feature_site'),
									'value'=>'$data->getFeatureOptions($data->feature_site)',
									'filter'=>Product::getFeatureOptions()
		),
		array(
			
				'header' => Yii::t('app','is_featured'),
			'value'=>'$data->getFeatureOptions($data->is_featured)',
			'filter'=>Product::getFeatureOptions()
		),
		/* 		array(
		 'name'=>'is_sale',
		 'value'=>'$data->getSale($data->is_sale)',
		 'filter'=>Product::getSale()
			), */

		array(
			
				'header' => Yii::t('app','update_time'),
			'value'=>'(strtotime($data->update_time)) ? date("j F", strtotime($data->update_time)) : date("j F", strtotime($data->create_time))',

		),
		/*
		'small_description',
		'large_description',
		'tags',
		/*
		'related_items',
		'thumbnail_file',
		'image_file',
		'category_id',
		'product_size',
		'product_color',
		'quantity',
		'discount_price',
		'price',
		'discount',
		'tax',
		'tax_amount',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Product::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Product::getStatusOptions(),
				),
		'update_time',
		*/
			array(
			'class'=>'booster.widgets.TbButtonColumn',
		//	'htmlOptions' => array('nowrap'=>'nowrap'),
					'header' => Yii::t('app','operation'),
			'template'=>'{update}{delete}'
			),
	),
)); ?>