<?php   $this->widget('booster.widgets.TbMenu', array(
'items'=>$this->actions,
'type'=>'success',
'htmlOptions'=>array('class'=> 'pull-right'),
));
?>

<?php // echo CHtml::link('Create',array('task/create'),array('target'=>'_blank')); ?>
<?php /*
$this->widget('booster.widgets.TbGridView', array(
'id' => 'company-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->search(),
'filter' => $model,
'columns' => array(
'state_id',
'email',

),
)); */ ?>
<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'task-grid',
		'type'=>'bordered', // 'condensed','striped',
//'dataProvider' => $model->search(),
//'filter' => $model,
'dataProvider' => $dataProvider,
		'columns' => array(
				'id',
                'email',
/*array(
                 'name'=>'Products',
                  'value'=>'$data->getTotalProducts($data->id)',
                  'filter'=>User::getTotalProducts(),
),*/
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

