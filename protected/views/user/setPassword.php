<style>
.login-box-content .form-group i {
  color: #999;
  left: 28.5%;
  position: absolute;
  top: 14px;
}
</style>
<div class="header-background">
	<div class="banner-overlay"></div>
	<div class="page-title text-center">
		<h2>Change Password</h2>
	</div>
</div>

<div class="container">
	<div class="main-section sign-up-form" style="min-height: 350px;">

		<div class="col-md-offset-2 col-md-8 padd-0">


			<div class="login-box-content recover-form">
				<br />
				<!-- Form Code Starts here -->
			<?php
			$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
				'id' => 'change-password-form',
				'type' => 'horizontal',
				'enableAjaxValidation' => true,
				'action' => $this->createUrl ( 'user/setPassword', array (
						'id' => $model->id,
						'key' => $key 
				) ),
				'enableClientValidation' => true,
				'htmlOptions' => array (
						'class' => 'recover-form'
				),
			) );
		?>

		<?php if(Yii::app()->user->hasFlash('success')) { ?>
		<div class="alert alert-success">
		<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
		<?php }else{ ?>
        <?php if(Yii::app()->user->hasFlash('changePassword')) { ?>
		<div class="alert alert-danger">
		<?php echo Yii::app()->user->getFlash('changePassword'); ?>
		</div>
		<?php }?>
		
		<div class="form-group">
		<?php echo $form->labelEx($model,"password" ,array('class'=>'col-md-3 control-label'))?>
			<div class="col-md-9">
			<?php echo $form->passwordField($model, 'password', array('class'=>'form-control','placeholder'=>'New Password')); ?>
			<?php echo $form->error($model,'password',array('style'=>'color:red;')); ?>
			</div>
			
		</div>

		<!-- form-group -->
		<div class="form-group">
		<?php echo $form->labelEx($model,"password_2",array('class'=>'col-md-3 control-label'))?>
			<div class="col-md-9">
			<?php echo $form->passwordField($model, 'password_2', array('class'=>'form-control','placeholder'=>'Confirm Password')); ?>
			<?php echo $form->error($model,'password_2',array('style'=>'color:red;')); ?>
			</div>
			
		</div>
		<div class="clearfix"></div>
			<div class="form-group">
				<div class="col-md-3"></div>
				<div class="col-md-9 text-center">
			<?php
			
			$this->widget ( 'booster.widgets.TbButton', array (
					'buttonType' => 'submit',
					
					'label' => 'Change Password',
					'htmlOptions' => array (
							'class' => 'btn btn-success ',
							'id' => 'set-password-btn'
					) 
			) );
			?>
</div></div>
		<?php }?>
	</div>
		<?php $this->endWidget(); ?>

</div>
	</div>
</div>
<script>
$(document).ready(function(){
	  $('label[for="User_password"], label[for="User_password_2"]').append('<span style="color:red;">  </span>');
});
</script>
	