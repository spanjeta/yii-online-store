
<br/>


<section class="content">
	<div class="row margin-0">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title no_margin clearfix">Update Order</h3>
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
                          <?php echo $form->textFieldGroup($model,'paid',array('class'=>'form-control','placeholder'=>'Email Address')); ?>
                           
                          </div>


<div class="form-group">
                          <?php echo $form->textFieldGroup($model,'amount',array('class'=>'form-control','placeholder'=>'Amount')); ?>
                           
                          </div>
<div class="form-group">
                          <?php echo $form->textFieldGroup($model,'phone_no',array('class'=>'form-control','placeholder'=>'Phone number')); ?>
                           
                          </div>
<div class="form-group">
                          <?php //echo $form->textFieldGroup($model,'state_id',array('class'=>'form-control','placeholder'=>'State')); ?>
                           
                          </div>
                          
                          <div class="form-group">
                          <?php echo $form->textFieldGroup($model,'bil_address_id',array('class'=>'form-control','placeholder'=>'Bil Address ')); ?>
                           
                          </div>
                           
                          <div class="form-group">
                          <?php echo $form->textFieldGroup($model,'ship_address_id',array('class'=>'form-control','placeholder'=>'Ship Address ')); ?>
                           
                          </div>
                          <div class="form-group">
                          <?php echo $form->textFieldGroup($model,'payment_id',array('class'=>'form-control','placeholder'=>'Payment ')); ?>
                           
                          </div>
                          <div class="form-group">
                          <?php echo $form->textFieldGroup($model,'order_email',array('class'=>'form-control','placeholder'=>'Order Email')); ?>
                           
                          </div>
<div class="form-group">
                            
                            <?php //echo $form->textFieldGroup($model,'order_email',array('class'=>'form-control','placeholder'=>'Order Email')); ?>
                             
                          </div>
                          <div class="form-group">
                            
                            <?php //echo $form->textFieldGroup($model,'order_email',array('class'=>'form-control','placeholder'=>'Order Email')); ?>
                             
                      </div>
                      <?php echo $form->dropDownListGroup($model,'state_id', array('widgetOptions'=>array('data'=>$model->getTypeOptions (), 
		'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
                      
                         
                          
<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'label'=>'Save',
			//'context'=>'primary'
		)); ?>
<?php $this->endWidget(); ?>
				
</div>
</div>
</div>
  </div>
</section>


