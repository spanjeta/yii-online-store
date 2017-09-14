<!--  form code start here -->
<div class="clearfix"></div>
<?php echo CHtml::link('Manage Warranty',array('home/warranty'), array('class'=>'btn btn-primary')); ?>
<div class="clearfix">
	<h3><?php echo Yii::t('app', 'add warranty') ?> </h3>
</div>
<div class="form row-fluid">

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'home-form-fg',
			'type'=>'',
			//	'enableAjaxValidation' => true,
			'enableClientValidation' => true,
			'clientOptions'=>array('validateOnSubmit'=>true),
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<div id="message"></div>


	<?php  echo $form->textFieldGroup($model,'title',array('class'=>'span12')); ?>


	<?php echo $form->textAreaRow($model,'description',array('class'=>'span12','maxlength'=>256)); ?>

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

<script>

  $('#home-form-fg').submit(function(event){

	  event.preventDefault();
	  $.ajax({
			type : 'Post',
			url : '<?php echo Yii::app()->createUrl('page/addWarranty');?>',
			data : $(this).serialize(),

		success:function(data){
			window.location.reload();
		//	$('#message').html(data);

			}


		  });

  });

</script>

