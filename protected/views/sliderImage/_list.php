
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'slider-image-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'title',
		'slider_image',
		'store_id',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>SliderImage::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>SliderImage::getStatusOptions(),
				),
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>