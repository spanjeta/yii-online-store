<?php include_once '_topuser.php'; ?>
<div class="clearfix mar_top1"></div>
<hr>

<?php echo CHtml::link('Add New',Yii::app()->createUrl('user/create'),array('class'=>'btn'))?>
<h3>Adminstrator Users</h3>
<?php   $this->widget('booster.widgets.TbMenu', array(
'items'=>$this->actions,
'type'=>'success',
'htmlOptions'=>array('class'=> 'pull-right'),
));
?>
<?php
$this->widget('booster.widgets.TbGridView', array(
'id' => 'company-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->searchDiffUser(User::ROLE_ADMIN),
'filter' => $model,
'afterAjaxUpdate'=>"function(){
  jQuery('#last_visit_time').datepicker({'dateFormat': 'yy-mm-dd'})
  jQuery('#create_time_search').datepicker({'dateFormat': 'yy-mm-dd'})
  }",
'columns' => array(
array(
						'name' => 'state_id',
						'value'=>'$data->getStatusOptions($data->state_id)',
						'filter'=>User::getStatusOptions(),
),
'email',



array(

'header'=>'access_pages',
'value'=>'',
),
array('name' => 'last_visit_time', 'type' => 'raw',
		'value'=>'(strtotime($data->last_visit_time)) ? date("j F y", strtotime($data->last_visit_time)) : date("j F", strtotime($data->last_visit_time))',
  'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', 
array('model'=>$model, 'attribute'=>'last_visit_time',
 	'htmlOptions' => array('id' => 'last_visit_time_search'), 
 	 'options' => array('dateFormat' => 'yy-mm-dd')), true)),



array('name' => 'create_time', 'type' => 'raw',
		'value'=>'(strtotime($data->create_time)) ? date("j F y", strtotime($data->create_time)) : date("j F", strtotime($data->create_time))',
  'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', 
array('model'=>$model, 'attribute'=>'create_time',
 	'htmlOptions' => array('id' => 'create_time_search'), 
 	 'options' => array('dateFormat' => 'yy-mm-dd')), true))





),
));