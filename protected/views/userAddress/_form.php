<!--  form code start here -->



<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'user-address-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>




<?php echo $form->textFieldGroup($model,'bulding_name',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'street_add',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'suburb',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'postcode',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'country',array('class'=>'span5','maxlength'=>256)); ?>






	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'danger',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>


<!-- form code ends here -->