<?php   $this->widget('booster.widgets.TbMenu', array(
'items'=>$this->actions,
'type'=>'success',
'htmlOptions'=>array('class'=> 'pull-right'),
));
?>

<?php // echo CHtml::link('Create',array('task/create'),array('target'=>'_blank')); ?>
<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'task-grid',
		'type'=>'bordered', // 'condensed','striped',
'dataProvider' => $dataProvider,
		'columns' => array(
				'id',
                'email',

//'input_file',
array(
						'name' => 'state_id',
						'value'=>'$data->getStatusOptions($data->state_id)',
						'filter'=>User::getStatusOptions(),
),
                   'last_action_time',
                    'create_time',


array(
					'class' => 'CxButtonColumn',
),
),
)); ?>

