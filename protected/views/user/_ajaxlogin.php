<!--  form code start here -->

<div class="modal-header">
	<h3>LOGIN</h3>
</div>





<div class="form  login_form">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'login-form',
			'type'=>'',
			//'enableAjaxValidation' => true,
			'action'=>$this->createUrl('/user/login'),
			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true),
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<div class="clearfix mar_top1"></div>


	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textField($model,'username',array('class'=>'row-fluid','placeholder' => 'Email', 'maxlength'=>128)); ?>

	<br>

	<?php //echo CHtml::link('forgot password',array('user/recover'),array('class'=>'pull-right forgot'))?>

	<?php echo $form->passwordField($model,'password',array('class'=>'row-fluid','placeholder' => 'Password','maxlength'=>128)); ?>
	<div class="clearfix mar_top1"></div>
	<div class="row-fluid">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Login',
				'htmlOptions'=>array('class'=>'span12'),
)); ?>
	</div>
	<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->
