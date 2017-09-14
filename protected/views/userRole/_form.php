<!--  form code start here -->
<div class="form well">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'user-role-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>255)); ?>


<?php echo $form->textFieldGroup($model,'description',array('class'=>'span5','maxlength'=>255)); ?>


<?php if ( count (User::model()->findAllAttributes(null, true) ) > 0 ): ?>
		<label><?php echo Html::encode($model->getRelationLabel('users')); ?></label>
	
		<?php echo $form->checkBoxListGroup($model, 'users', Html::encodeEx(Html::listDataEx(User::model()->findAllAttributes(null, true)), false, true)); ?>
<?php endif; ?>	



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