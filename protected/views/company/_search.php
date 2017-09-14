<div class="wide form">

<?php 	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'id' => 'company-form',
	'type'=>'horizontal',		
)); ; 
?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'company_name'); ?>
		<?php echo $form->textField($model, 'company_name', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'shop_name'); ?>
		<?php echo $form->textField($model, 'shop_name', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'shop_type'); ?>
		<?php echo $form->textField($model, 'shop_type', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'shop_slogan'); ?>
		<?php echo $form->textField($model, 'shop_slogan', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'about_shop'); ?>
		<?php $this->richTextEditor($model,'about_shop'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'admin_first_name'); ?>
		<?php echo $form->textField($model, 'admin_first_name', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'admin_company_position'); ?>
		<?php echo $form->textField($model, 'admin_company_position', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email_contact'); ?>
		<?php echo $form->textField($model, 'email_contact', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'web_address'); ?>
		<?php echo $form->textField($model, 'web_address', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'facebook'); ?>
		<?php echo $form->textField($model, 'facebook', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'twitter'); ?>
		<?php echo $form->textField($model, 'twitter', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'instagram'); ?>
		<?php echo $form->textField($model, 'instagram', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'image_file'); ?>
		<?php echo $form->textField($model, 'image_file', array('size'=>80,'maxlength' => 1024)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'terms'); ?>
		<?php $this->richTextEditor($model,'terms'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'delivery_info'); ?>
		<?php $this->richTextEditor($model,'delivery_info'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'fax'); ?>
		<?php echo $form->textField($model, 'fax', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'abn'); ?>
		<?php echo $form->textField($model, 'abn', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'acn'); ?>
		<?php echo $form->textField($model, 'acn', array('maxlength' => 256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'contact_no'); ?>
		<?php echo $form->textField($model, 'contact_no', array('maxlength' => 32)); ?>
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

</div><!-- search-form -->
