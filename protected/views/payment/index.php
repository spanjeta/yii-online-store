<?php
/* @var $this PaymentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
		'Payments',
);

$this->menu=array(
		array('label'=>Yii::t('thescout','Make Payment'), 'url'=>array('create')),
		//array('label'=>'Manage Payment', 'url'=>array('admin')),

);
?>
<h2>
	<?php echo Yii::t('thescout','Payment Records')?>
</h2>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'dataProvider'=>$dataProvider,
		'columns'=>array(
				'id',
				//'user_id',

				array(
						'name'=>'Email',
						'value'=>'$data->getUserName()',
				),
					
				array(
						'name'=>'status_id',
						'value'=>'$data->getStatusOptions($data->status_id)',
				),
				'transaction_id',
				'create_time',
				'validity_time',
				array(
						'header'=> Yii::t('thescout','Payment Status'),
						'class'=>'CButtonColumn',
						'template'=>'{view}',
						'buttons'=>array(

								'view' =>array(

										'imageUrl'=>Yii::app()->request->baseUrl.'/images/pay.png',
										'url'=>'Yii::app()->createUrl("payment/view", array("id"=>$data->id))',
										'visible' =>'$data->inValidity($data->user_id,$data->transaction_id)',
								),

						),
				),
				array(
						'header'=> Yii::t('thescout','Delete'),
						'class'=>'CButtonColumn',
						'template'=>'{delete}',
						'buttons'=>array(

								'delete' =>array(

										'imageUrl'=>Yii::app()->request->baseUrl.'/images/delete.png',
										'visible'=> 'Yii::app()->user->isAdmin()',
								),

						),
				),

		),
)); ?>