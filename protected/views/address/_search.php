<div class="wide form">

<?php 	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route), 'method' => 'get',
	'id' => '
	address	-form', 'type'=>'horizontal', )); ; ?>

			<div class="row">
	<?php echo $form->label($model, 'id'); ?>
	<?php echo $form->textField($model, 'id'); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'bulding_name'); ?>
	<?php echo $form->textField($model, 'bulding_name', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'street_add'); ?>
	<?php echo $form->textField($model, 'street_add', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'suburb'); ?>
	<?php echo $form->textField($model, 'suburb', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'postcode'); ?>
	<?php echo $form->textField($model, 'postcode'); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, '_state'); ?>
	<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'_state',
			'data'=>$model->getStatusOptions(),
			)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'country'); ?>
	<?php echo $form->textField($model, 'country', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'bulding_name1'); ?>
	<?php echo $form->textField($model, 'bulding_name1', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'street_add1'); ?>
	<?php echo $form->textField($model, 'street_add1', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'suburb1'); ?>
	<?php echo $form->textField($model, 'suburb1', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'postcode1'); ?>
	<?php echo $form->textField($model, 'postcode1'); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, '_state1'); ?>
	<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'_state1',
			'data'=>$model->getStatusOptions(),
			)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'country1'); ?>
	<?php echo $form->textField($model, 'country1', array('maxlength' => 256)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'ph_no'); ?>
	<?php echo $form->textField($model, 'ph_no', array('maxlength' => 16)); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'content'); ?>
	<?php echo $form->textField($model, 'content', array('size'=>80,'maxlength' => 1024)); ?>
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
	<?php echo $form->label($model, 'is_same'); ?>
	<?php echo $form->textField($model, 'is_same'); ?>
	</div>

			<div class="row">
	<?php echo $form->label($model, 'cart_id'); ?>
	<?php echo $form->textField($model, 'cart_id'); ?>
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

			<div class="row">
	<?php echo $form->label($model, 'create_user_id'); ?>
	<?php echo $form->dropDownList($model, 'create_user_id', Html::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
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
