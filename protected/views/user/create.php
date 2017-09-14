  <div class="login-section clearfix">
         <div class="container">
             <div class="col-sm-offset-3 col-sm-6">
				<div class="login-page">
                    <h4 class="font-bold mgbt-10"><?php if(Yii::app()->user->isAdmin){ ?>
                    <?php echo Yii::t('app','create user');?> 
                 
                    <?php } else {?>
                     <?php echo Yii::t('app','sign up');?> 
                    <?php }?></h4>
                     
					 <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'user-form',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-list'),
	));
					
	?>
                         <div class="form-group">
                             <?php echo $form->textField($model,'first_name',array('class'=>'form-control','placeholder'=>Yii::t('app','first name'))); ?>
                             <?php echo $form->error($model,'first_name'); ?>
                          </div>
                           <div class="form-group">
                             <?php echo $form->textField($model,'last_name',array('class'=>'form-control','placeholder'=>Yii::t('app','last name')));?>
                             <?php echo $form->error($model,'last_name'); ?>
                          </div>
                          <div class="form-group">
                          <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>Yii::t('app','email address'))); ?>
                             <?php echo $form->error($model,'email'); ?>
                          </div>
                          <div class="form-group">
                          
                           <?php echo $form->passwordField($model,'password',array('class'=>'form-control','placeholder'=>Yii::t('app','password'))); ?>
                            <?php echo $form->error($model,'password'); ?>
                          </div>
                          
                          <div class="form-group">
                           
                             <?php echo $form->passwordField($model,'password_2',array('class'=>'form-control','placeholder'=>Yii::t('app','confirm password'))); ?>
                            <?php echo $form->error($model,'password_2'); ?>
                          </div>
                          <div class="form-group">
                            
                            <?php echo $form->textField($model,'ph_no',array('class'=>'form-control','placeholder'=>Yii::t('app','mobile number'))); ?>
                             <?php echo $form->error($model,'ph_no'); ?>
                          </div>
                          <button type="submit" class="btn btn-default form-control"> <?php echo Yii::t('app','sign up');?></button>
                         
                       <?php $this->endWidget(); ?>
				</div>
				
				
				<?php /*?><div class="or custom-login-or">
					<span class="inner-or"
						style="padding: 10px; border-radius: 20px;">Or</span>
						<div class="graphic">
						<span class="vertical-line"></span>
                            <span class="circle"></span></div>
				       </div>
				

					<div class="form-list-right">
					  <a href="#" class="btn-primary twitter-btn"><i class="fa fa-twitter"></i> Log in with Twitter</a> 
					  <a href="#" class="btn-danger google-btn"><i class="fa fa-google-plus"></i> Log in with Google</a> 
					  <a href="#" class="btn-primary facebook-btn"><i class="fa fa-facebook"></i> Log in with Facebook</a>
					</div> */?>
				

			</div>
		</div>





	</div>

