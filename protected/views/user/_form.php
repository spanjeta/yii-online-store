	 
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
                            
                            <?php //echo $form->fileFieldGroup($model,'image_file',array('class'=>'form-control')); ?>
                             
                          </div>
<button type="submit" class="btn btn-sm btn-danger ">Update</button>
<?php $this->endWidget(); ?>
				