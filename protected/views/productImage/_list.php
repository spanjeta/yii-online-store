
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'product-image-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'product_id',
		'image_path',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>ProductImage::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>ProductImage::getStatusOptions(),
				),
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>