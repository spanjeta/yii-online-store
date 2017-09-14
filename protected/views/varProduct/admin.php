<?php
/* @var $this VarProductController */
/* @var $model VarProduct */

$this->breadcrumbs=array(
	'Var Products'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List VarProduct', 'url'=>array('index')),
	array('label'=>'Create VarProduct', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#var-product-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Var Products</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'var-product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'sku',
		'product_id',
		'color_id',
		'size_id',
		'brand_id',
		/*
		'quantity',
		'price',
		'discount_price',
		'type_id',
		'state_id',
		'create_user_id',
		'create_time',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
