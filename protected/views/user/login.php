<div class="login-section clearfix">
       <div class="container">
          <div class="col-sm-offset-4 col-sm-5">
			 <div class="login-page">
                <h4 class="font-bold mgbt-10"> <?php echo Yii::t('app','login');?> </h4> 
                 
                  <?php
                 
                  
                  $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'login-form',
		//	'type'=>'',
			//'enableAjaxValidation' => true,
			//'action'=>$this->createUrl('api/user/login'),

			'enableClientValidation'=>true,
			'clientOptions'=>array('validateOnSubmit'=>true),
			'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-list'),
	));
                  
	?>
                    <div class="form-group">
					  <?php echo $form->textField($model,'username',array('class'=>'form-control','placeholder'=>Yii::t('app','email'),'value' =>'')); ?>
					   <?php echo $form->error($model,'username',array('class'=>'error')); ?>
					 </div>
					  <div class="form-group">
						  <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>Yii::t('app','password'),'value' =>'')); ?>
					     <?php echo $form->error($model,'password',array('class'=>'error')); ?>
					   </div>
                          <div class="col-xs-6">
							<!--<div class="checkbox remember mgtp-14">
								<label class="font-10"><input type="checkbox"> <!-- Remember me </label>
							</div>-->
						</div> 
						<div class="col-xs-6 text-right font-10">
							<div class="mgtp-14">
								<a href="<?php echo Yii::app()->createUrl('user/recover');?>" class="forget-pswd"><?php echo Yii::t('app','forgot password?');?> </a>
							</div>
						</div>
						<button type="submit" class="btn btn-default form-control"> <?php echo Yii::t('app','login');?> </button>
				<?php $this->endWidget(); ?>
				</div>
				<?php ?>
				<div class="or custom-login-or">
					<span class="inner-or"
						style="padding: 10px; border-radius: 20px;"><?php echo Yii::t('app','or');?></span>
						<div class="graphic">
						<span class="vertical-line"></span>
                            <span class="circle"></span></div>
		               </div>
				

					<div class="form-list-right">




     <?php  $this->widget('ext-prod.hoauth.widgets.HOAuth'); ?> 	<!-- <div class='crugeconnector'>
		<span> --><!-- Use your Facebook or Google account: --><!-- </span>
		<ul> -->
		
		<!-- </ul>
	</div> -->

	<?php // } ?>
					<!-- 	 <a href="#"
							class="btn-danger google-btn"><i class="fa fa-google-plus"></i>
							Log in with Google</a> <a href="#"
							class="btn-primary facebook-btn"><i class="fa fa-facebook"></i>
							Log in with Facebook</a>  -->
					</div>
		      </div>
		</div>
	</div>
