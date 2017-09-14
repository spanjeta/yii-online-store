<!--  form code start here -->
<div class="form well">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'cart-form',
	'type'=>'horizontal',
		'action'=>$this->createUrl('api/cart/create'),
	//'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<?php echo $form->radioButtonListRow($model, 'product_id', Html::listDataEx(Product::model()->findAllAttributes(null, true))); ?>


<?php echo $form->radioButtonListRow($model, 'shop_id', Html::listDataEx(Company::model()->findAllAttributes(null, true))); ?>


<?php echo $form->textFieldGroup($model,'quantity',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'device_id',array('class'=>'span5','maxlength'=>128)); ?>


<?php echo $form->textFieldGroup($model,'ip_address',array('class'=>'span5','maxlength'=>64)); ?>


<?php echo $form->textFieldGroup($model,'session_id',array('class'=>'span5','maxlength'=>128)); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>





	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->