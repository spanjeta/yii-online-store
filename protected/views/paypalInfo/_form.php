<!--  form code start here -->
<div class="form row-fluid">

	<?php echo CHtml::link('Back',array('user/billing'),array('class'=>'btn btn-primary pull-right'))?>
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'paypal-info-form',
			'type'=>'horizontal',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'email',array('class'=>'span5','maxlength'=>64)); ?>

	<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>

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
