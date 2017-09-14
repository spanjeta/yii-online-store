<!--  form code start here -->
<div class="form col-md-12">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'email-template-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php //echo $form->errorSummary($model); ?>


		

	 <?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		
<?php if(isset($update)){?>
<?php echo $form->textFieldGroup($model,'key',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'form-control','maxlength'=>128,'placeHolder'=>'key','readOnly'=>true)))); ?>

<?php }else{ ?>
	
		<?php echo $form->textFieldGroup($model,'key',array('class'=>'form-control','maxlength'=>255)); ?>
	
<?php }?>
	 
	 
	<?php
		
echo '';
		$code = $this->richTextEditor ();
		
		if ($code == 1)
			echo $form->html5EditorGroup ( $model, 'text', array (
					'class' => 'form-control',
					'rows' => 5,
					'height' => '200',
					'options' => array (
							'color' => true 
					) 
			) );
		
		else if ($code == 2)
			echo $form->redactorGroup ( $model, 'text', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		
		else if ($code == 3)
			echo $form->ckEditorGroup ( $model, 'text', array (
					'options' => array (
							'fullpage' => 'js:true',
							'width' => '640',
							'resize_maxWidth' => '640',
							'resize_minWidth' => '320' 
					) 
			) );
		
		else
			echo $form->textAreaGroup ( $model, 'text', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		;
		?>	
		

	 <?php //echo $form->textFieldGroup($model,'text',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		

	<div class="form-group form-actions">
		<div class="col-sm-4"></div>
		<div class="col-sm-7">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'label'=> isset($buttons) ? 'Add': 'Update',
             'htmlOptions'=>array('class'=>'btn btn-success center-block add_button'),
		)); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->