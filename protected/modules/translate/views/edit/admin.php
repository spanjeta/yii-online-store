<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">



<h1><?php echo TranslateModule::t('manage messages')?></h1>

<?php
/* $source=MessageSource::model()->findAll();
	$this->widget('booster.widgets.TbGridView', array(
	'id' => 'feed-grid',
	'type'=>'bordered condensed striped',
	'dataProvider' => $model->search(),
	'filter' => isset($model) ? $model : null,
	'htmlOptions' => array(
        'style' => 'cursor: pointer;',
	    'class'=>'table table-hover'
    ),
	'columns' => array(
			'id',
			'message',
			
			array(
					'name' => 'category',
					'type' =>'raw',
					'value'=>'$data->category',
					'filter'=>CHtml::listData($source,'category','category'),
			),
			array(
					'name' => 'language',
					'type' =>'raw',
					'value'=>'$data->language',
					'filter'=>CHtml::listData($model->findAll(new CDbCriteria(array('group'=>'language'))),'language','language')
			),
			'translation', */
	/* 	array(
				'class' => 'LabelColumn',
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'labels' => Feed::getLabelOptions(),
				'filter'=>Feed::getStatusOptions(),
			
                
				
				), 

	/* 	array(
				'name' => 'model_type',
				'type' =>'raw',
				'value'=>'$data->getModelObject()',
				), */
	
		/* array(
		    'header'=>'<a>Actions</a>',
			'class' => 'CButtonColumn',
				'template'=>'{update}{delete}',
				'updateButtonUrl'=>'Yii::app()->getController()->createUrl("update",array("id"=>$data->id,"language"=>$data->language))',
				'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("delete",array("id"=>$data->id,"language"=>$data->language))',
				
		),
	),
));  */?>
<?php 
$source=MessageSource::model()->findAll();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'filter'=>CHtml::listData($source,'id','id'),
        ),
        array(
            'name'=>'message',
            'filter'=>CHtml::listData($source,'message','message'),
        ),
        array(
            'name'=>'category',
            'filter'=>CHtml::listData($source,'category','category'),
        ),
        array(
            'name'=>'language',
            'filter'=>CHtml::listData($model->findAll(new CDbCriteria(array('group'=>'language'))),'language','language')
        ),
        'translation',
        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'updateButtonUrl'=>'Yii::app()->getController()->createUrl("update",array("id"=>$data->id,"language"=>$data->language))',
            'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("delete",array("id"=>$data->id,"language"=>$data->language))',
        )
	),
));  ?>
</div>
</div>
</div>
</div>
</section>
