
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'rss-feed-grid',
	'type'=>'bordered condensed striped',
	'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('rssFeed/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'title',
		'url',
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>RssFeed::getStatusOptions(),
				),
		'update_time',
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>