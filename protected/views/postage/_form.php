
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'postage-form',
			'type'=>'horizontal',
		//	'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldGroup($model,'title',array('class'=>'span3','maxlength'=>256)); ?>


	<?php echo $form->textFieldGroup($model,'first_item_cost',array('class'=>'span2','maxlength'=>18,'prepend'=>'$')); ?>

	<?php echo $form->textFieldGroup($model,'additional_item_cost',array('class'=>'span2','maxlength'=>18,'prepend'=>'$')); ?>


		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Save',
		)); ?>


	<?php $this->endWidget(); ?>


<!-- form code ends here -->
