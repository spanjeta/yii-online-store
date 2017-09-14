<!--  form code start here -->
<div class="">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'rss-feed-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control')); ?>


<?php echo $form->textFieldGroup($model,'url',array('class'=>'form-control')); ?>

<?php echo $form->textFieldGroup($model,'image_url',array('class'=>'form-control')); ?>
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