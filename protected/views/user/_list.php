
<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">


<?php
	
$this->widget ( 'booster.widgets.TbMenu', array (
			'items' => $this->actions,
			'type' => 'success',
			'htmlOptions' => array (
					'class' => 'pull-right' 
			) 
	) );
	?>
	</div>
				<!-- /.box-header -->
				<div class="box-body">			
	
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'user-grid',
	'type'=>'bordered', // 'condensed','striped',
	'pager' => true,
		
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
	//	'username',
		
			array (
					'header' => Yii::t('app','first name'),
					'name' =>'first_name',
					'type' => 'raw',
					
					// 'value'=>'Html::valueEx($data->product)',
					
					'value' => '$data->first_name'
			), 
		//'middle_name',
		
			array (
					'header' => Yii::t('app','last name'),
					'name' =>'last_name',
					'type' => 'raw',
					
					// 'value'=>'Html::valueEx($data->product)',
					
					'value' => '$data->last_name'
			), 
		//'date_of_birth',
		/*
		'gender',
		'about_me:html',
		'image_file',
		array(
				'name' => 'tos',
				'value' => '($data->tos === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
				'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
				),
		array(
			'name'=>'role_id',
			'value'=>'Html::valueEx($data->role)',
			'filter'=>Html::listDataEx(UserRole::model()->findAllAttributes(null, true)),
			),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>User::getStatusOptions(),
				),
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>User::getTypeOptions(),
				),
		'last_visit_time',
		'last_action_time',
		'last_password_change',
		'login_error_count',
		*/
			array(
					'header' => Yii::t('app','state'),
               		'name' => 'state_id',
					'value'=>'$data->getStatusOptions($data->state_id)',
					'filter'=>User::getStatusOptions(),
			),
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>
</div>
</div></div></div>
</section>