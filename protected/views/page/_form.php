<!--  form code start here -->
<div class="form col-md-12">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'page-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php //echo $form->errorSummary($model); ?>
<?php echo $form->dropDownListGroup($model,'lang_type', array('widgetOptions'=>array('data'=>$model->getLangOptions (), 
		'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>

<?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control','maxlength'=>128)); ?>



<?php
		
echo '';
		$code = $this->richTextEditor ();
		
		if ($code == 1)
			echo $form->html5EditorGroup ( $model, 'content', array (
					'class' => 'form-control',
					'rows' => 5,
					'height' => '200',
					'options' => array (
							'color' => true 
					) 
			) );
		
		else if ($code == 2)
			echo $form->redactorGroup ( $model, 'content', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		
		else if ($code == 3)
			echo $form->ckEditorGroup ( $model, 'content', array (
					'options' => array (
							'fullpage' => 'js:true',
							'width' => '640',
							'resize_maxWidth' => '640',
							'resize_minWidth' => '320' 
					) 
			) );
		
		else
			echo $form->textAreaGroup ( $model, 'content', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		;
		?>	

<?php echo $form->dropDownListGroup($model,'type_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions (), 
		'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>




<?php //echo $form->dropDownListGroup($model, 'type_id',
			//$model->getTypeOptions(),array('class'=>'form-control')); ?>




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