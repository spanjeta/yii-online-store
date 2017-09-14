<!--  form code start here -->
<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
<h3 class="box-title"><?php echo Yii::t('app','please fill the details here')?> </h3>
<div class="box-body">	
				<div class="col-md-8">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'banner-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	//	'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

	<p class="help-block" align="right">
		<?php echo Yii::t('app','fields with')?> <span class="required">*</span><?php echo Yii::t('app','are required')?> 
	</p>

	<?php echo $form->errorSummary($model); ?>

 <?php echo  '';$code = $this->richTextEditor() ;

		if ($code == 1) echo $form->html5EditorGroup($model,'content', array('class'=>'form-control', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

		else if ($code == 2) echo $form->redactorGroup($model,'content', array('class'=>'form-control', 'rows'=>5));

		else if ($code == 3) echo $form->ckEditorGroup($model,'content', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

		else echo $form->textAreaGroup($model,'content',  array('class'=>'form-control', 'rows'=>5));; ?>	 

		<?php echo $form->textFieldGroup($model,'url',array('class'=>'form-control','maxlength'=>255)); ?>
		

	
		
		

	 <?php //echo $form->dropDownList( $model,'type_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		
		

	 <?php //echo $form->dropDownList($model,'state_id', array('widgetOptions'=>array('data'=>$model->getStatusOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>

	 
		 <?php echo $form->fileFieldGroup($model,'image_file',array('class'=>'form-control browser_button' )); ?>

		   <?php //echo $form->error($model,'image_file',array('class'=>'error')); ?>
		 

		

	 <?php /* echo $form->datepickerGroup($model, 'update_time',
					array(		'widgetOptions'=>array(
						'options'=>array('format'=>'yyyy-mm-dd','autoclose'=> true,),	
	 				),'hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
;  */?>
	 
		
		

	 <?php //echo $form->textFieldGroup($model,'createUser',array('class'=>'form-control')); ?>
	 
		

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

</div></div></div></div></section>
<!-- form code ends here -->