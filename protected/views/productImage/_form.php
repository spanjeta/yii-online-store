<!--  form code start here -->
<div class="form well">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'product-image-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model,'product_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'image_path',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>




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