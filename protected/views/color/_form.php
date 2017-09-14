


<!--  form code start here -->
<div class="form ">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'color-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
<div class="form-group ">
	<div class="col-md-12">
		<p class="help-block">Fields with <span class="required">*</span> are required.</p>
	</div>
	<?php // echo $form->errorSummary($model); ?>
	
<?php 
echo $form->label($model,'color_code', array('class'=>'col-sm-3'));
?>
<div class="col-sm-3">
<?php 
$this->widget('ext.colorpicker.EColorPicker', array(
		'model' => $model,
		'attribute' => 'color_code',
		'mode' => 'textfield',

'htmlOptions'=>array('class'=>'span5','maxlength'=>256)
));
?>
</div>
</div>
<br>
<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>256)); ?>

<?php 



/* 
<?php echo $form->textFieldGroup($model,'description',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>

*/?>


	<div class="form-actions text-center">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->