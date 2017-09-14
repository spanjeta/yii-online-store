<!--  form code start here -->
<div class="">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'category-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model,'title',array('class'=>'span12')); ?>

<?php /* 
<?php echo $form->textFieldGroup($model,'description',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->fileFieldGroup($model, 'image_file'); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>



<?php if ( count (SubCategory::model()->findAllAttributes(null, true) ) > 0 ): ?>
		<label><?php echo Html::encode($model->getRelationLabel('subCategories')); ?></label>
	
		<?php echo $form->checkBoxListRow($model, 'subCategories', Html::encodeEx(Html::listDataEx(SubCategory::model()->findAllAttributes(null, true)), false, true)); ?>
<?php endif; ?>	


*/?>
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