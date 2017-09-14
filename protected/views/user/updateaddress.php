	<div class="container"> 
<div class="border-org my_detail_info">
<h3 class="tabs-inner-heading">Add shipping adress</h3>


<?php 	$form=$this->beginWidget('booster.widgets.TbActiveForm',array( 'id'
	=> '
	address	-form', 'type'=>'horizontal', 'enableAjaxValidation' =>
	true	, 'htmlOptions'=>array('enctype'=>'multipart/form-data'), ));
	?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	

				
	<?php echo $form->textFieldGroup($model,'bulding_name',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'street_add',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'suburb',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'postcode',array('class'=>'span5')); ?>

	<?php //echo $form->dropDownListGroup($model, '_state',$model->getStatusOptions()); ?>

			
	<?php echo $form->textFieldGroup($model,'country',array('class'=>'span5','maxlength'=>256)); ?>
	
		
	
	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div></div>
<!-- form code ends here -->
