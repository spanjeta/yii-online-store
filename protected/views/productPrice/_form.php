<!--  form code start here -->
<div class=" ">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'product-price-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	
<?php echo $form->dropDownListGroup($model, 'category_id',
			$model->getCategoryOptions(),array('class'=>'form-control')); ?>

<?php echo $form->textFieldGroup($model,'min_price',array('class'=>'span5','maxlength'=>255)); ?>


<?php echo $form->textFieldGroup($model,'max_price',array('class'=>'span5','maxlength'=>255)); ?>


<?php echo $form->textFieldGroup($model,'min_quantity',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'max_quantity',array('class'=>'span5')); ?>
<?php echo $form->textFieldGroup($model,'discount',array('class'=>'span5')); ?>






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