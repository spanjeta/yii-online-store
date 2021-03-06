<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('company-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
	<h1><?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?></h1>
</div>
<p>
You may optionally enter a comparison operator (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; or =) at the beginning of each of your search values to specify how the comparison should be done.
</p>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'company-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'user_name',
		'shop_name',
		array(
				'name' => 'shop_type',
				'value'=>'$data->getTypeOptions($data->shop_type)',
				'filter'=>Company::getTypeOptions(),
				),
		'shop_slogan',
		'about_shop:html',
		/*
		'admin_first_name',
		'last_name',
		'admin_company_position',
		'email_contact',
		'web_address',
		'facebook',
		'twitter',
		'instagram',
		'image_file',
		'terms:html',
		'delivery_info:html',
		'fax',
		'abn',
		'acn',
		'contact_no',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Company::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Company::getStatusOptions(),
				),
		'update_time',
		*/
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		),
	),
)); ?>