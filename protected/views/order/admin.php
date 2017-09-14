<section class="content-header">
	<h1>
		<?php echo Yii::t('app','manage') . ' : ' .Html::encode(Yii::t('app',$model->label(2))); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> <?php echo Yii::t('app','home');?></a></li>
		<li class="active">Manage Orders</li>
	</ol>
	</section>


<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					
								<?php   /* $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	)); */
?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">			

	<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'order-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
			'pager' => true,
	'filter' => $model,
	'columns' => array(
		'id',
			array (
					'header' => Yii::t('app','amount'),
					'name' =>'amount',
					'type' => 'raw',
					'value' => '$data->amount'
			), 
			array (
					'header' => Yii::t('app','order email'),
					'name' =>'order_email',
					'type' => 'raw',
					'value' => '$data->order_email'
			), 
			array (
					'header' => Yii::t('app','phone no'),
					'name' =>'phone_no',
					'type' => 'raw',
					'value' => '$data->phone_no'
			), 
	
			array(
					'header' => Yii::t('app','state'),
					'name' => 'state_id',
					'value'=>'$data->getStatusOptions($data->state_id)',
					'filter'=>Order::getStatusOptions(),
			),
		/*
		'paid',
		'payment_id',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Order::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Order::getStatusOptions(),
				),
		'ship_time',
		'update_time',
		*/
			array (
					'header' => Yii::t('app','actions'),
					'class' => 'CxButtonColumn',
					'template' => '{view}{update}{add}',
					'buttons' => array (
							'view' => array (
									'url' => 'Yii::app()->createUrl("/order/view",  array("id"=>$data->id) )'
							),
							'update' => array (
									'url' => 'Yii::app()->createUrl("/order/update",  array("id"=>$data->id) )'
							),
							 'add' => array (
									'url' => 'Yii::app()->createUrl("/order/reject", array( "id" => $data->id ))',
									'label' => "<i class='fa fa-minus'></i>",
									'options' => array (
											'title' => 'Reject',
											
									)
							)
					)
			) 
		/* array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		), */
	),
)); ?>
</div>
</div>
</div>
</div>
</section>

