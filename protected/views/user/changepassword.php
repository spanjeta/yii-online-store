
<br />


<section class="container">

		<div class="row margin-0">
			<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title no_margin clearfix">Change Password</h3>
			</div>
			<div class="box-body">
	
	


					<?php 	if(Yii::app()->user->hasFlash('success')) { ?>
			<div class="alert alert-success">
			<?php
						
echo Yii::app ()->user->getFlash ( 'success' );
						
						?>
</div>
			
			<?php } else {?>
				<?php echo Yii::app ()->user->getFlash ( 'error' );?>
              <?php }?>

		

			<?php
			
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
					'id' => 'user-form',
					'type' => 'horizontal',
					// 'enableAjaxValidation' => false,
					'enableClientValidation' => true,
					'clientOptions' => array (
							'validateOnSubmit' => true 
					),
					'htmlOptions' => array (
							'enctype' => 'multipart/form-data' 
					) 
			) );
			?>



			<div class="">
			<?php // echo $form->textFieldGroup($model,'email',array('class'=>'form-control col-md-12','placeholder'=>'Email'));?>
				<div class="clearfix"></div>
				<?php //echo $form->error($model,'email');?>
			</div>

				<div class="">
			<?php echo $form->passwordFieldGroup($model,'password',array('class'=>'form-control col-md-12','placeholder'=> 'New Password','required' => 'required'));?>
			<?php echo $form->error($model,'password');?>
			</div>

				<div class="">
			<?php echo $form->passwordFieldGroup($model,'password_2',array('class'=>'form-control col-md-12','placeholder'=> 'Confirm New Password','required' => 'required'));?>
			<?php echo $form->error($model,'password_2');?>
			</div>
				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-3"></div>
					<div class="col-md-9">
				<?php
				$this->widget ( 'booster.widgets.TbButton', array (
						'buttonType' => 'submit',
						//'type' => 'danger',
						'htmlOptions' => array (
								'class' => '' 
						),
						'label' => ' Save ' 
				
				) );
				?>
				</div>
				<?php $this->endWidget(); ?>
			</div>

			</div>

		</div>
	</div>
</div>
</section>
