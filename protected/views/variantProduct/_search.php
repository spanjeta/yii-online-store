<div class="wide form">

<?php 	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'id' => 'variant-product-form',
	'type'=>'horizontal',		
)); ; 
?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'sku'); ?>
		<?php echo $form->textField($model, 'sku', array('maxlength' => 64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'store_id'); ?>
		<?php echo $form->textField($model, 'store_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'product_code'); ?>
		<?php echo $form->textField($model, 'product_code', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'prod_id'); ?>
		<?php echo $form->textField($model, 'prod_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'range'); ?>
		<?php echo $form->textField($model, 'range', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'edition'); ?>
		<?php echo $form->textField($model, 'edition', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'hide_public'); ?>
		<?php echo $form->textField($model, 'hide_public'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'description'); ?>
		<?php $this->richTextEditor($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'large_description'); ?>
		<?php echo $form->textField($model, 'large_description', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tags'); ?>
		<?php echo $form->textField($model, 'tags', array('size'=>80,'maxlength' => 512)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'related_items'); ?>
		<?php echo $form->textField($model, 'related_items', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'thumbnail_file'); ?>
		<?php echo $form->textField($model, 'thumbnail_file', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'image_file'); ?>
		<?php echo $form->textField($model, 'image_file', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'category_id'); ?>
		<?php echo $form->dropDownList($model, 'category_id', Html::listDataEx(Category::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'size_id'); ?>
		<?php echo $form->textField($model, 'size_id', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'color_id'); ?>
		<?php echo $form->textField($model, 'color_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'brand_id'); ?>
		<?php echo $form->textField($model, 'brand_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_sale'); ?>
		<?php echo $form->textField($model, 'is_sale'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'feature_site'); ?>
		<?php echo $form->textField($model, 'feature_site'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_featured'); ?>
		<?php echo $form->textField($model, 'is_featured'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'postage_id'); ?>
		<?php echo $form->textField($model, 'postage_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'view_count'); ?>
		<?php echo $form->textField($model, 'view_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'warranty_id'); ?>
		<?php echo $form->textField($model, 'warranty_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'quantity'); ?>
		<?php echo $form->textField($model, 'quantity', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'discount_price'); ?>
		<?php echo $form->textField($model, 'discount_price', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'price'); ?>
		<?php echo $form->textField($model, 'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'is_discount'); ?>
		<?php echo $form->textField($model, 'is_discount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tax'); ?>
		<?php echo $form->textField($model, 'tax', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'tax_amount'); ?>
		<?php echo $form->textField($model, 'tax_amount', array('maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'type_id'); ?>
		<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'type_id',
			'data'=>$model->getTypeOptions(),
			)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'state_id'); ?>
		<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'state_id',
			'data'=>$model->getStatusOptions(),
			)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_user_id'); ?>
		<?php echo $form->dropDownList($model, 'create_user_id', Html::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'product_id'); ?>
		<?php echo $form->textField($model, 'product_id', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'rss_id'); ?>
		<?php echo $form->textField($model, 'rss_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_time'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'create_time',
			'value' => $model->create_time,
			'options' => array(
			'showButtonPanel' => true,
			'changeYear' => true,
			'dateFormat' => 'yy-mm-dd',
			),
			));
; ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'update_time'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'update_time',
			'value' => $model->update_time,
			'options' => array(
			'showButtonPanel' => true,
			'changeYear' => true,
			'dateFormat' => 'yy-mm-dd',
			),
			));
; ?>
	</div>


	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>
<?php $this->endWidget(); ?>

</div>
<!-- search-form -->
