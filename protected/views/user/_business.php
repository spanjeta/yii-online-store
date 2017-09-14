<!--  form code start here -->
<div class="clearfix mar_top5"></div>

<div class="form well span6 offset3 login_signup">
	<h2>Please Complete Your Profile First</h2>
	<h3>SignUp Business User Step2</h3>

	<hr>

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'user-form-bus',
			'type'=>'',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>
	<?php //echo $form->errorSummary($company);

	echo $form->errorSummary(array($company,$address));
	//echo CHtml::errorSummary(array($company,$badd));
	?>

	<?php echo $form->textFieldGroup($company,'user_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'company_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'shop_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->dropDownListGroup($company,'shop_type', CHtml::listData(ShopCategory::model()->findAll(),'id','title'),array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'admin_first_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'last_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'admin_company_position',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'contact_no',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'fax',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'abn',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'acn',array('class'=>'span6','maxlength'=>128)); ?>

	<div class="clearfix mar_top2"></div>

	<h3>Company Address</h3>

	<hr>

	<?php echo $form->textFieldGroup($address,'bulding_name',array('class'=>'span6','maxlength'=>256)); ?>


	<?php echo $form->textFieldGroup($address,'street_add',array('class'=>'span6','maxlength'=>256)); ?>


	<?php echo $form->textFieldGroup($address,'suburb',array('class'=>'span6','maxlength'=>256)); ?>


	<?php echo $form->textFieldGroup($address,'postcode',array('class'=>'span6')); ?>


	<?php echo $form->textFieldGroup($address, '_state',
	array('class'=>'span6')); ?>


	<?php echo $form->textFieldGroup($address,'country',array('class'=>'span6','maxlength'=>256)); ?>


	<div class="clearfix mar_top5"></div>
	<h3>Shipping Address</h3>





	        <hr>
<h4> Here you can set location of shop on map .</h4>
         <?php $this->renderPartial('//home/_detail',array('address'=>new UserAddress()));?>
  	   
		
			<?php
			Yii::import('ext.LocationPicker.Location');
			$location = new Location();?>
			<?php echo $form->textFieldGroup($location,'location',array('class'=>'span6','maxlength'=>256)); ?>
			<?php echo $form->hiddenField($location,'latitude',array('class'=>'span6','maxlength'=>256)); ?>
			<?php  echo $form->hiddenField($location,'longitude',array('class'=>'span6','maxlength'=>256)); ?>
	
	  <div id="map-canvas"></div>
	   <hr>
	

	<?php

	echo $form->checkBoxRow($address,'is_same',array('maxlength'=>256,'onclick'=>'handleClick(this);')); ?>

	<?php echo $form->textFieldGroup($address,'bulding_name1',array('class'=>'span6','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($address,'street_add1',array('class'=>'span6','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($address,'suburb1',array('class'=>'span6','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($address,'postcode1',array('class'=>'span6')); ?>

	<?php echo $form->textFieldGroup($address, '_state1',
	array('class'=>'span6')); ?>


	<?php echo $form->textFieldGroup($address,'country1',array('class'=>'span6','maxlength'=>256)); ?>

	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Save',
				'htmlOptions'=>array('class'=>'row-fluid'),
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
	document.getElementById('UserAddress_bulding_name1').value = document.getElementById('UserAddress_bulding_name').value ; 
	document.getElementById('UserAddress_street_add1').value = document.getElementById('UserAddress_street_add').value ; 
	document.getElementById('UserAddress_suburb1').value = document.getElementById('UserAddress_suburb').value ; 
	document.getElementById('UserAddress_postcode1').value = document.getElementById('UserAddress_postcode').value ; 
	document.getElementById('UserAddress__state1').value = document.getElementById('UserAddress__state').value ; 
	document.getElementById('UserAddress_country1').value = document.getElementById('UserAddress_country').value ; 
}
}
</script>
