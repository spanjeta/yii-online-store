<!--  form code start here -->
<div class="form col-md-12">


<?php
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
		'id' => 'setting-form',
		'type' => 'horizontal',
		'enableAjaxValidation' => true,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php //echo $form->errorSummary($model); ?>
	 <?php echo $form->textFieldGroup($model,'title',array('class'=>'form-control','maxlength'=>255)); ?>
	<?php if(isset($update)){?>
<?php echo $form->textFieldGroup($model,'key',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'form-control','maxlength'=>128,'placeHolder'=>'key','readOnly'=>true)))); ?>
	 <?php //echo $form->textFieldGroup($model,'key',array('class'=>'form-control','maxlength'=>255, 'readOnly' => true)); ?>
	<?php }else {?>
	 <?php echo $form->textFieldGroup($model,'key',array('class'=>'form-control','maxlength'=>255)); ?>
	 <?php }?>
	 <?php echo $form->dropDownListGroup($model,'type_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions (), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	<div class="col-md-10">
	<div class="txt" id="value_text">
	 <?php
		
echo '';
		$code = $this->richTextEditor ();
		
		if ($code == 1)
			echo $form->html5EditorGroup ( $model, 'value', array (
					'class' => 'form-control',
					'rows' => 5,
					'height' => '200',
					'options' => array (
							'color' => true 
					) 
			) );
		
		else if ($code == 2)
			echo $form->redactorGroup ( $model, 'value', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		
		else if ($code == 3)
			echo $form->ckEditorGroup ( $model, 'value', array (
					'options' => array (
							'fullpage' => 'js:true',
							'width' => '640',
							'resize_maxWidth' => '640',
							'resize_minWidth' => '320' 
					) 
			) );
		
		else
			echo $form->textAreaGroup ( $model, 'value', array (
					'class' => 'form-control',
					'rows' => 5 
			) );
		;
		?>	 
	</div>	
	 
	 </div>
	<label for="value" class="col-md-3" id="value_image1">Image File <span
		class="required">*</span></label>
	<div class="col-md-10">
	<?php
	
echo CHtml::activeFileField ( $model, 'value2', array (
			'class' => 'form-control',
			'id' => 'value_image' 
	) );
	?> 
		</div>

	 <?php //echo $form->dropDownListGroup($model,'type_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>


	<div class="form-group form-actions">
		<div class="col-sm-4"></div>
		<div class="col-sm-7">
		<?php
		
		$this->widget ( 'booster.widgets.TbButton', array (
				'buttonType' => 'submit',
				'label' => isset ( $buttons ) ? 'Add' : 'Update',
				'htmlOptions' => array (
						'class' => 'btn btn-success center-block add_button' 
				) 
		) );
		?>
	</div>
	</div>

<?php $this->endWidget(); ?>

</div>
<style>
#value_text {
	display: none;
}

#value_text1 {
	display: none;
}
.txt{
	display: none;
}
#value_image {
	display: none;
}

#value_image1 {
	display: none;
}
<!--
-->
</style>
<script type="text/javascript">
$("#Setting_type_id").change(function(){
	var a = $("#Setting_type_id").val();
	if(a == 0){
		$("#value_text").show();
		$("#value_text1").show();
		$("#value_image").hide();
		$("#value_image1").hide();
	}else if(a == 1){
		$("#value_text1").hide();
		$("#value_text").hide();
		$("#value_image1").show();
		$("#value_image").show();
	}
});
</script>

<!-- form code ends here -->