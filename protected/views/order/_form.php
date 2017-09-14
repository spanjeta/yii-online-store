<!--  form code start here -->
<div class="form well">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'order-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block" align="right">
		<?php echo Yii::t('app', 'fields with') ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required.') ?>
	</p>

	<?php echo $form->errorSummary($model); ?>


<?php echo $form->radioButtonListRow($model, 'ship_address_id', Html::listDataEx(UserAddress::model()->findAllAttributes(null, true))); ?>


<?php echo $form->radioButtonListRow($model, 'bil_address_id', Html::listDataEx(UserAddress::model()->findAllAttributes(null, true))); ?>


<?php echo $form->textFieldGroup($model,'amount',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->textFieldGroup($model,'order_email',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'phone_no',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->textFieldGroup($model,'paid',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'payment_id',array('class'=>'span5')); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->datepickerRow($model, 'ship_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>





<?php if ( count (OrderItem::model()->findAllAttributes(null, true) ) > 0 ): ?>
		<label><?php echo Html::encode($model->getRelationLabel('orderItems')); ?></label>
	
		<?php echo $form->checkBoxListRow($model, 'orderItems', Html::encodeEx(Html::listDataEx(OrderItem::model()->findAllAttributes(null, true)), false, true)); ?>
<?php endif; ?>	



	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->