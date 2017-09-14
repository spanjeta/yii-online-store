
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'wish-list-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'model_id',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>WishList::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>WishList::getStatusOptions(),
				),
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>