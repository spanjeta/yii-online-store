<!--  form code start here -->
<div class="form col-md-12">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'mailing-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php echo $form->errorSummary($model); ?>


		

	 <?php echo $form->textFieldGroup($model,'subject',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		
		

	 <?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorGroup($model,'content', array('class'=>'form-control', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorGroup($model,'content', array('class'=>'form-control', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorGroup($model,'content', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaGroup($model,'content',  array('class'=>'form-control', 'rows'=>5));; ?>
	 
		
		

	 <?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorGroup($model,'queue', array('class'=>'form-control', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorGroup($model,'queue', array('class'=>'form-control', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorGroup($model,'queue', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaGroup($model,'queue',  array('class'=>'form-control', 'rows'=>5));; ?>
	 
		
		

	 <?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorGroup($model,'sent', array('class'=>'form-control', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorGroup($model,'sent', array('class'=>'form-control', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorGroup($model,'sent', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaGroup($model,'sent',  array('class'=>'form-control', 'rows'=>5));; ?>
	 
		
		

	 <?php echo $form->dropDownListGroup($model,'type_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		
		

	 <?php echo $form->dropDownListGroup($model,'state_id', array('widgetOptions'=>array('data'=>$model->getStatusOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		
		

	 <?php echo $form->datepickerGroup($model, 'finishedOn',
					array(		'widgetOptions'=>array(
						'options'=>array('format'=>'yyyy-mm-dd','autoclose'=> true,),	
	 				),'hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>
	 
		

	<div class="form-group form-actions">
		<div class="col-sm-4"></div>
		<div class="col-sm-7">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'label'=> isset($buttons) ? 'Add': 'Update',
             'htmlOptions'=>array('class'=>'btn btn-success col-sm-4 pull-right'),
		)); ?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->