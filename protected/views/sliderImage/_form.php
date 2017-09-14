<!--  form code start here -->
<div class="form well">


	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'slider-image-form',
			'type'=>'horizontal',
			'action'=>Yii::app()->createUrl('api/sliderImage/create'),
			//'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>
	<p class="help-block">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>


	<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>128)); ?>


	<?php echo $form->fileFieldGroup($model,'slider_image',array('class'=>'span5','maxlength'=>1024));
/* 	$this->widget('CMultiFileUpload', array(
			'name' => 'images',

			'accept' => 'jpeg|jpg|gif|png', // useful for verifying files
			'duplicate' => 'Duplicate file!', // useful, i think
			'denied' => 'Invalid file type', // useful, i think
'remove' => Yii::t('ui', '<div><img  title="Delete" style="float:left;padding-right:5px;" src=' . Yii::app()->request->baseUrl . '/images/active.png /></div>'),
			


	)); */
	?>


	<?php echo $form->textFieldGroup($model,'store_id',array('class'=>'span5')); ?>


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


<script>



input[type='file'] {
	  color: transparent;
	}

		</script>
