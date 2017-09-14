<!--  form code start here -->
<div class="form well">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'company-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model,'user_name',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'shop_name',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'shop_type',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'shop_slogan',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorRow($model,'about_shop', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorRow($model,'about_shop', array('class'=>'span4', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorRow($model,'about_shop', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaRow($model,'about_shop',  array('class'=>'span4', 'rows'=>5));; ?>


<?php echo $form->textFieldGroup($model,'admin_first_name',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'last_name',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'admin_company_position',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'email_contact',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'web_address',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'facebook',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->textFieldGroup($model,'twitter',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->textFieldGroup($model,'instagram',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->fileFieldGroup($model, 'image_file'); ?>


<?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorRow($model,'terms', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorRow($model,'terms', array('class'=>'span4', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorRow($model,'terms', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaRow($model,'terms',  array('class'=>'span4', 'rows'=>5));; ?>


<?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorRow($model,'delivery_info', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorRow($model,'delivery_info', array('class'=>'span4', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorRow($model,'delivery_info', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaRow($model,'delivery_info',  array('class'=>'span4', 'rows'=>5));; ?>


<?php echo $form->textFieldGroup($model,'fax',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'abn',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'acn',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'contact_no',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>




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