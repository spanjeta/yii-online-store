<div class="container">
<h1><?php echo TranslateModule::t('Missing Translations')." - ".TranslateModule::translator()->acceptedLanguages[Yii::app()->getLanguage()]?></h1>

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
			), */
			
		
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
	
		/* 	array(
					'class'=>'CButtonColumn',
					'template'=>'{create}{delete}',
					'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("missingdelete",array("id"=>$data->id))',
					'buttons'=>array(
							'create'=>array(
									'label'=>TranslateModule::t('Create'),
									'url'=>'Yii::app()->getController()->createUrl("create",array("id"=>$data->id,"language"=>Yii::app()->getLanguage()))'
							)
					),
					'header'=>TranslateModule::translator()->dropdown(),
			)
	),
)); */ ?>
</div>





<?php 

$source=MessageSource::model()->findAll();
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'message-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
        array(
            'name'=>'message',
            'filter'=>CHtml::listData($source,'message','message'),
        ),
        array(
            'name'=>'category',
           'filter'=>CHtml::listData($source,'category','category'),
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{create}{delete}',
            'deleteButtonUrl'=>'Yii::app()->getController()->createUrl("missingdelete",array("id"=>$data->id))',
            'buttons'=>array(
                'create'=>array(
                    'label'=>TranslateModule::t('Create'),
                    'url'=>'Yii::app()->getController()->createUrl("create",array("id"=>$data->id,"language"=>Yii::app()->getLanguage()))'
                )
            ),
            'header'=>TranslateModule::translator()->dropdown(),
        )
	),
));  ?>