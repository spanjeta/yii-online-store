
<br/>



<section class="container">
	<div class="row margin-0">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title no_margin clearfix">Update user</h3>
				</div>
  				<div class="box-body">
	

	 
					 <?php
						
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
								'id' => 'user-form',
								'enableAjaxValidation' => true,
								'htmlOptions' => array (
										'enctype' => 'multipart/form-data',
										'class' => 'form-list' 
								) 
						) );
						?>
<div class="form-group">

                             <?php echo $form->textFieldGroup($model,'first_name',array('class'=>'form-control','placeholder'=>'First Name')); ?>
                            
                          </div>
<div class="form-group">
                             <?php echo $form->textFieldGroup($model,'last_name',array('class'=>'form-control','placeholder'=>'Last Name')); ?>
                           
                          </div>
<div class="form-group">
                          <?php echo $form->textFieldGroup($model,'email',array('class'=>'form-control','placeholder'=>'Email Address')); ?>
                           
                          </div>

<div class="form-group">
                            
                            <?php echo $form->textFieldGroup($model,'ph_no',array('class'=>'form-control','placeholder'=>'Mobile Number')); ?>
                             
                          </div>
                          <div class="form-group">
                            

                            <?php echo $form->fileFieldGroup($model,'image_file',array('class'=>'form-control')); ?>

                             
                          </div>
<button type="submit" class="btn btn-sm btn-danger ">Update</button>
<?php $this->endWidget(); ?>
				
</div>
</div>
</div>
  </div>

</section>

