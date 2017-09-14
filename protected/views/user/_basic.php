<!--  form code start here -->
<div class="clearfix mar_top5"></div>


<?php if(Yii::app()->user->hasFlash('register')){ ?>

<div class="alert span11 alert-success">
	<i class="fa fa-check-circle"></i>
	<?php echo Yii::app()->user->getFlash('register'); ?>
</div>
<?php } else { ?>

<div class="form well span11 login_signup">

	<div class="span6 offset2">

		<h3>Basic User SignUp</h3>

		<hr>

		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
				'id' => 'user-form1',
				'type'=>'form-horizontal',
				//'enableAjaxValidation' => true,
				'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		));
		?>


		<?php echo $form->errorSummary($model); ?>


		<?php echo $form->textFieldGroup($model,'username',array('class'=>'span6','maxlength'=>128)); ?>


		<?php echo $form->textFieldGroup($model,'first_name',array('class'=>'span6','maxlength'=>128)); ?>


		<?php echo $form->textFieldGroup($model,'middle_name',array('class'=>'span6','maxlength'=>128)); ?>


		<?php echo $form->textFieldGroup($model,'last_name',array('class'=>'span6','maxlength'=>128)); ?>


		<?php echo $form->radioButtonListRow($model, 'gender', (User::getGender())); ?>

		<div class="clearfix mar_top2"></div>


		<h3>Billing Address</h3>

		<hr>

		<?php echo $form->textFieldGroup($add,'bulding_name',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($add,'street_add',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($add,'suburb',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($add,'postcode',array('class'=>'span6')); ?>


		<?php echo $form->dropDownListGroup($add, '_state', $model->getStatusOptions(),array('class'=>'span6')); ?>


		<?php echo $form->textFieldGroup($add,'country',array('class'=>'span6','maxlength'=>256)); ?>
		
		<?php echo $form->hiddenField($add,'type_id',array('value'=>0)); ?>

		<div class="clearfix mar_top2"></div>

		<h3>Shipping Address</h3>
		<hr>

     	<?php echo $form->checkBoxRow($add,'is_same',array('class'=>'','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($sadd,'bulding_name',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($sadd,'street_add',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($sadd,'suburb',array('class'=>'span6','maxlength'=>256)); ?>


		<?php echo $form->textFieldGroup($sadd,'postcode',array('class'=>'span6')); ?>


		<?php echo $form->textFieldGroup($sadd, '_state',array('class'=>'span6')); ?>
	 

		<?php echo $form->textFieldGroup($sadd,'country',array('class'=>'span6','maxlength'=>256)); ?>
		
			<?php echo $form->hiddenField($sadd,'type_id',array('value'=>0)); ?>

		<div class="form-actions">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					//'type'=>'primary',
					'label'=>'Save',
					'htmlOptions'=>array('class'=>'row-fluid'),
		)); ?>
		</div>

		<?php $this->endWidget(); ?>
		<?php }?>
	</div>

</div>

<!-- form code ends here -->
