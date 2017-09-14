<div class="wide form">

<?php 	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'id' => 'cart-form',
	'type'=>'horizontal',		
)); ; 
?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'product_id'); ?>
		<?php echo $form->dropDownList($model, 'product_id', Html::listDataEx(Product::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'shop_id'); ?>
		<?php echo $form->dropDownList($model, 'shop_id', Html::listDataEx(Company::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'quantity'); ?>
		<?php echo $form->textField($model, 'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'device_id'); ?>
		<?php echo $form->textField($model, 'device_id', array('maxlength' => 128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'ip_address'); ?>
		<?php echo $form->textField($model, 'ip_address', array('maxlength' => 64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'session_id'); ?>
		<?php echo $form->textField($model, 'session_id', array('maxlength' => 128)); ?>
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
		<?php echo $form->label($model, 'type_id'); ?>
		<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'type_id',
			'data'=>$model->getTypeOptions(),
			)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_user_id'); ?>
		<?php echo $form->textField($model, 'create_user_id'); ?>
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

</div><!-- search-form -->
