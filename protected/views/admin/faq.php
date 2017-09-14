<div class="mar_top3"></div>

<div class="row-fluid">

	<div class="dashboardtopbar span12">

		<div class="container">
			<span class="topbarinfo"> <a
				href="<?php echo Yii::app()->createUrl('admin/acIssue')?>">Account
					Issues: 0 </a> <i class="icon-circle redicon"></i>
			</span> <span class="topbarinfo"> <a
				href="<?php echo Yii::app()->createUrl('admin/report');?>">Reported
					Voilation: 34 </a> <i class="icon-circle greenicon"></i>
			</span> <span class="topbarinfo"> <a
				href="<?php echo Yii::app()->createUrl('admin/bug');?>">Bug Report:
					350 </a> <i class="icon-circle greenicon"></i>
			</span> <span class="topbarinfo"> <a
				href="<?php echo Yii::app()->createUrl('admin/support');?>">Support
					Ticket Open: 0 </a> <i class="icon-circle redicon"></i>
			</span>


		</div>
	</div>


</div>


<div class="container ">

<h3>
<?php echo CHtml::link('Create New',array('faq/create'),array('class'=>'btn btn-gray'))?>
</h3>

	<!-- - admin_inner - -->
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'faq-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'question',
		'answer:html',
		array(
			'name'=>'category_id',
			'value'=>'Html::valueEx($data->category)',
			'filter'=>Html::listDataEx(FaqCategory::model()->findAllAttributes(null, true)),
			),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Faq::getStatusOptions(),
				),
		'is_help',
		/*
		'no_help',
		'update_time',
		*/
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>

</div>
