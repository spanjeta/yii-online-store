<!--  form code start here -->
<div class="clearfix"></div>
<?php echo CHtml::link('Manage Postage',array('postage/index'), array('class'=>'btn btn-primary')); ?>
<div class="clearfix">
	<h3>Add Postage</h3>
</div>
<div class="form row-fluid">
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'postage-form-create',
			'type'=>'',
//'enableAjaxValidation' => true,
			'enableClientValidation' => true,
			'clientOptions'=>array('validateOnSubmit'=>true),
//	'enableAjaxValidation' => true,
//'action' => $this->createUrl('postage/create'),
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>


	<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->textFieldGroup($model,'first_item_cost',array('class'=>'span5','maxlength'=>5,'prepend'=>'$')); ?>

	<?php echo $form->textFieldGroup($model,'additional_item_cost',array('class'=>'span5','maxlength'=>5,'prepend'=>'$')); ?>

	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Save',
	)); ?>
	</div>

	<?php $this->endWidget(); ?>
	<!-- form code ends here -->

	<script>

  $('#postage-form-create').submit(function(event){

	  event.preventDefault();
	  $.ajax({
			type : 'Post',
			url : '<?php echo Yii::app()->createUrl('page/addPostage');?>',
			data : $(this).serialize(),

		success:function(data){
			if(data.indexOf('success') == 0) {
				window.location.reload();
			}

			else {
				 $('#loadmodal').html(data);
			}

//			window.location.reload();

		//	$('#message').html(data);

			}
		  });

  });

</script>