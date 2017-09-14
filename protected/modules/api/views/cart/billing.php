<!--  form code start here -->
<div class="clearfix mar_top2"></div>

<hr>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
		'id' => 'user-form-bus-bill',
		'type'=>'',
	//	'enableAjaxValidation' => true,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<div class="clearfix mar_top2"></div>

<h3>Billing Address</h3>

<hr>

<?php echo $form->textFieldRow($address,'bulding_name',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'street_add',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'suburb',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'postcode',array('class'=>'span6')); ?>

<?php echo $form->textFieldRow($address, '_state',
			 array('class'=>'span6')); ?>

<?php echo $form->textFieldRow($address,'country',array('class'=>'span6','maxlength'=>256)); ?>


<div class="clearfix mar_top5"></div>
<h3>Shipping Address</h3>

<hr>

<?php 	echo $form->checkBoxRow($address,'is_same',array('maxlength'=>256,'onclick'=>'handleClick(this);')); ?>

<?php echo $form->textFieldRow($address,'bulding_name1',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'street_add1',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'suburb1',array('class'=>'span6','maxlength'=>256)); ?>

<?php echo $form->textFieldRow($address,'postcode1',array('class'=>'span6')); ?>

<?php echo $form->textFieldRow($address,'ph_no',array('class'=>'span6')); ?>
<?php echo $form->textAreaRow($address,'content',array('class'=>'span6')); ?>

<?php echo $form->textFieldRow($address, '_state1',
			 array('class'=>'span6')); ?>

<?php echo $form->textFieldRow($address,'country1',array('class'=>'span6','maxlength'=>256)); ?>

<div class="form-actions">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Next',
			'htmlOptions'=>array('class'=>'span3'),
		)); ?>
</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->


<script>
function handleClick(cb) {
var val = cb.checked;
if(val)
{
	document.getElementById('Address_bulding_name1').value = document.getElementById('Address_bulding_name').value ; 
	document.getElementById('Address_street_add1').value = document.getElementById('Address_street_add').value ; 
	document.getElementById('Address_suburb1').value = document.getElementById('Address_suburb').value ; 
	document.getElementById('Address_postcode1').value = document.getElementById('Address_postcode').value ; 
	document.getElementById('Address__state1').value = document.getElementById('Address__state').value ; 
	document.getElementById('Address_country1').value = document.getElementById('Address_country').value ; 
}
}
</script>
