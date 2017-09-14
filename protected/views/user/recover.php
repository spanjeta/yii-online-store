  <div class="login-section clearfix">
         <div class="container">
             <div class="col-sm-offset-3 col-sm-6">
				<div class="login-page">
                    <h4 class="font-bold mgbt-10">Forgot Password</h4>
                     <?php if(Yii::app()->user->hasFlash('recover')){ ?>
<div class = "alert alert-info">
	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('recover'); ?>
	</div>
</div>
	<?php }?>
					 <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'recover-form',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'form-list'),
	));
	?>
                        
                          <div class="form-group">
                          <?php echo $form->textField($model,'email',array('class'=>'form-control','placeholder'=>'Email Address')); ?>
                             <?php echo $form->error($model,'email'); ?>
                          </div>
                         
                          <button type="submit" class="btn btn-default form-control">Recover Password</button>
                       <?php $this->endWidget(); ?>
				</div>
				
			
				

			</div>
		</div>





	</div>

