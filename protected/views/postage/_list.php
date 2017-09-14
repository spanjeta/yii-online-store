
<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'postage-grid',
		'type'=>'bordered', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'columns' => array(
				'id',
				'title',
				/* 		array(
				 'name' => 'type_id',
						'value'=>'$data->getTypeOptions($data->type_id)',
						'filter'=>Postage::getTypeOptions(),
				),
array(
		'name' => 'state_id',
		'value'=>'$data->getStatusOptions($data->state_id)',
		'filter'=>Postage::getStatusOptions(),
), */
				'create_time:date',
				array(
						'class' => 'CxButtonColumn',
						'template'=>'{update}{delete}',
						'header'=>'Operation'
				),
		),
)); ?>