<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'install-grid',
		'dataProvider' => $dataProvider,
		'columns' => array(
				'name',
				'size',
				'create_time',
				//'modified_time',
				array(
						'class' => 'CButtonColumn',
						'template' => '{Restore}',
						'buttons'=>array
						(
								/* 'create' => array
								(
										'url'=>'Yii::app()->createUrl("backup/default/create", array("file"=>$data["name"]))',
								), */
								'Restore' => array
								(
										'url'=>'Yii::app()->createUrl("backup/default/restore", array("file"=>$data["name"]))',
								),

						),
				),
				array(
						'class' => 'CButtonColumn',
						'template' => '{delete}',
						'buttons'=>array
						(

								'delete' => array
								(
										'url'=>'Yii::app()->createUrl("backup/default/delete", array("file"=>$data["name"]))',
								),
						),
				),
		),
)); ?>