<div class="row-fluid">
	<div class="linkbar_admin span12">


		<span class="topbarinfo"><a
			href="<?php echo Yii::app()->createUrl('admin/bus')?>">Accounts</a> </span>
		<span class="topbarinfo"><a
			href="<?php echo Yii::app()->createUrl('fees/index')?>">Fees</a> </span>
	</div>
</div>

<h3>Account :</h3>

<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'company-grid',
		'type'=>'striped bordered condensed',
		'dataProvider' => $model->search(),
'pager'=>array(
      'class'=>'CLinkPager',
//'header'=>'Idi na->',
'htmlOptions' => array(
            'class' => 'pager',
),

),
		'filter' => $model,
   'afterAjaxUpdate'=>"function(){
 jQuery('#create_time_search').datepicker({'dateFormat': 'yy-mm-dd'})
  }",
		'columns' => array(
//		'id',
array(
						'name'=>'account_no',
						'value'=>'$data->createUser->id',
						'type'=>'raw'
						),
						array(
						'name'=>'user_name',
						'value'=>'$data->createUser->email',
							
						),
						array(
						'name'=>'total_fee',
						///	'value'=>'500',
						'type'=>'raw'
						),
						array(
						'name'=>'current_week',
						//	'value'=>'2',
						'type'=>'raw'
						),
						array(
						'name'=>'state_id',
						'value'=>'',
						'filter'=>User::getUserState()
						),

						array('name' => 'date_join', 'type' => 'raw',
		'value'=>'(strtotime($data->create_time)) ? date("j F y", strtotime($data->create_time)) : date("j F", strtotime($data->create_time))',
  'filter'=>$this->widget('zii.widgets.jui.CJuiDatePicker', 
						array('model'=>$model, 'attribute'=>'create_time',
 	'htmlOptions' => array('id' => 'create_time_search'), 
 	 'options' => array('dateFormat' => 'yy-mm-dd')), true))
						/* 				array(
						 'class'=>'booster.widgets.TbButtonColumn',
						 'htmlOptions' => array('nowrap'=>'nowrap'),
						 'template'=>'{update}',
						 'header'=>'Edit'
						 ), */
						),
						)); ?>
