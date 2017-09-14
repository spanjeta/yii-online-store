
<?php
$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => 'banner-grid',
		'type' => 'bordered condensed striped',
		'selectionChanged' => "function(id){window.location='" . Yii::app ()->createAbsoluteUrl ( 'banner/view' ) . "/id/' + $.fn.yiiGridView.getSelection(id);}",
		'dataProvider' => isset ( $model ) ? $model->search () : $dataProvider,
		//'rowCssClassExpression' => '($data->isDelayed())?"especial":"normal"',
		'filter' => isset ( $model ) ? $model : null,
		'htmlOptions' => array (
				'style' => 'cursor: pointer;',
				'class' => 'table table-hover' 
		),
		'columns' => array (


				array (
						'header' => Yii::t('app','id'),
						'name' =>'id',
						'type' => 'raw',
						'value' => '$data->id'
				), 
				array (

						'header' => Yii::t('app','image'),

						'name' =>'image_file',
						'type' => 'raw',
						'value' => '$data->image_file'
				), 
				array (
						'header' => Yii::t('app','url'),
						'name' =>'url',
						'type' => 'raw',
						'value' => '$data->url'
				), 

				/* array (
						'name' => 'type_id',
						'value' => '$data->getTypeOptions($data->type_id)',
						'filter' => Banner::getTypeOptions () 
				), */
				/* array (
						'class' => 'LabelColumn',
						'name' => 'state_id',
						'value' => '$data->getStatusOptions($data->state_id)',
						'labels' => Banner::getLabelOptions (),
						'filter' => Banner::getStatusOptions () 
				
				), */
			//	'update_time:datetime',
		/*
		'createUser',
		*/
		array (
				'header' => Yii::t('app','actions'),
						
						'class' => 'CxButtonColumn' 
				) 
		) 
) );
?>