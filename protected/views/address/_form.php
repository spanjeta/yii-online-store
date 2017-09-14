

<!--  form code start here -->
<div class="">


<?php
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
		'id' => '
	address	-form',
		'type' => 'horizontal',
		'enableAjaxValidation' => true,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>
	<p class="help-block" align="right">
	<?php echo Yii::t('app','fields with');?><span class="required">*</span><?php echo Yii::t('app','are required');?> .
	</p>

	<?php //echo $form->errorSummary($model); ?>
<h3><?php echo Yii::t('app','billing address');?></h3>

	<hr>
				
	<?php echo $form->textFieldGroup($model,'bulding_name',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'street_add',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'suburb',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($model,'ph_no',array('class'=>'span5','maxlength'=>16)); ?>
			
	<?php echo $form->textFieldGroup($model,'postcode',array('class'=>'span5')); ?>

	<?php echo $form->textFieldGroup($model,'_state',array('class'=>'span5')); ?>	

			
	<?php echo $form->textFieldGroup($model,'country',array('class'=>'span5','maxlength'=>256)); ?>
	
<?php 	echo $form->checkBoxGroup($model,'is_same',array('maxlength'=>256)); ?>
	<h3><?php echo Yii::t('app','shipping address');?></h3>

	<hr>
			
	<?php echo $form->textFieldGroup($model,'bulding_name1',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'street_add1',array('class'=>'span5','maxlength'=>256)); ?>

			
	<?php echo $form->textFieldGroup($model,'suburb1',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($model,'ph_no1',array('class'=>'span5','maxlength'=>16)); ?>
			
	<?php echo $form->textFieldGroup($model,'postcode1',array('class'=>'span5')); ?>

	<?php echo $form->textFieldGroup($model,'_state1',array('class'=>'span5')); ?>	


			
	<?php echo $form->textFieldGroup($model,'country1',array('class'=>'span5','maxlength'=>256)); ?>

			
	

			
	<?php //echo $form->textFieldGroup($model,'content',array('class'=>'span5','maxlength'=>1024)); ?>

	
	
	<div class="form-actions">
	<?php
	
	$this->widget ( 'booster.widgets.TbButton', array (
			'buttonType' => 'submit',
// 			/'type' => 'primary',
			'label' => 'Save' 
	) );
	?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->
<script>
$("#Address_is_same").click(function(){
	var val = $("#Address_is_same").val();
	if(val==1)
		{
			document.getElementById('Address_bulding_name1').value = document.getElementById('Address_bulding_name').value ; 
			document.getElementById('Address_street_add1').value = document.getElementById('Address_street_add').value ; 
			document.getElementById('Address_suburb1').value = document.getElementById('Address_suburb').value ; 
			document.getElementById('Address_ph_no1').value = document.getElementById('Address_ph_no').value ; 
			document.getElementById('Address_postcode1').value = document.getElementById('Address_postcode').value ; 
			document.getElementById('Address__state1').value = document.getElementById('Address__state').value ; 
			document.getElementById('Address_country1').value = document.getElementById('Address_country').value ; 
		}
});
function handleClick(cb) {
	
} 
</script>