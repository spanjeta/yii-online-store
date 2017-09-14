
<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'product-grid',
		'type'=>'bordered', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'columns' => array(
				'id',
				'title',
				'product_code',
				'sku',
				'price',
				'quantity',
				//	'small_description',
				//	'large_description',
			//	'tags',
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
*/	array(
						'class'=>'booster.widgets.TbButtonColumn',
						'htmlOptions' => array('nowrap'=>'nowrap'),
						'header'=>'Update',
						'template'=>'{update}'
				),

				array(
						'class'=>'booster.widgets.TbButtonColumn',
						'htmlOptions' => array('nowrap'=>'nowrap'),
						'header'=>'Delete',
						'template'=>'{delete}'
				),
		),
)); ?>