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
	$.fn.yiiGridView.update('variant-product-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="page-header">
	<h1><?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?></h1>
</div>
<p>You may optionally enter a comparison operator (&lt;, &lt;=, &gt;,
	&gt;=, &lt;&gt; or =) at the beginning of each of your search values to
	specify how the comparison should be done.</p>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'variant-product-grid',
	'type'=>'striped bordered condensed',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'title',
		'sku',
		'store_id',
		'product_code',
		'prod_id',
		/*
		'range',
		'edition',
		'hide_public',
		'large_description',
		'tags',
		'related_items',
		'thumbnail_file',
		'image_file',
		array(
			'name'=>'category_id',
			'value'=>'Html::valueEx($data->category)',
			'filter'=>Html::listDataEx(Category::model()->findAllAttributes(null, true)),
			),
		'size_id',
		'color_id',
		'brand_id',
		'is_sale',
		'feature_site',
		'is_featured',
		'postage_id',
		'view_count',
		'warranty_id',
		'quantity',
		'discount_price',
		'price',
		'is_discount',
		'tax',
		'tax_amount',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>VariantProduct::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>VariantProduct::getStatusOptions(),
				),
		'product_id',
		'rss_id',
		'update_time',
		*/
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array('nowrap'=>'nowrap'),
		),
	),
)); ?>