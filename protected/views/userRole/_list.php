
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'user-role-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'title',
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>