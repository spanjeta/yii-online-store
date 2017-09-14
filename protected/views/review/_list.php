
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'review-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'comment',
		array(
			'name'=>'shop_id',
			'value'=>'Html::valueEx($data->shop)',
			'filter'=>Html::listDataEx(Company::model()->findAllAttributes(null, true)),
			),
		'star_count',
		'image_file',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Review::getTypeOptions(),
				),
		/*
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Review::getStatusOptions(),
				),
		*/
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>