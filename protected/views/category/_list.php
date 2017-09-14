
<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'category-grid',
		'type'=>'bordered', // 'condensed','striped',
		'dataProvider' => $dataProvider,
		'pager' =>true,
		'columns' => array(
				//'id',
				'title',
				array(
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