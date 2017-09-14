<div class="clearfix"></div>
<?php echo CHtml::link('Manage payment method',array('user/billing'), array('class'=>'btn btn-primary')); ?>
<div class="clearfix">
	<h3>Add Payment Method</h3>
</div>
<div class="form row-fluid">
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'payment-setting-form',
			'type'=>'horizontal',
			//'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>
	<?php echo $form->checkBoxRow($paymentSetting, 'paypal'); ?>

	<?php echo $form->checkBoxRow($paymentSetting, 'cart'); ?>

	<?php echo $form->checkBoxRow($paymentSetting, 'bank_deposit'); ?>

	<?php echo $form->checkBoxRow($paymentSetting, 'cash_pickup'); ?>

	<?php echo $form->checkBoxRow($paymentSetting, 'cash_delivery'); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Update',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>

	<script>
$('#payment-setting-form').submit(function(event){
	event.preventDefault();
	var datastring = $("#payment-setting-form").serialize();
	$.ajax({
				url : '<?php echo Yii::app()->createUrl("paymentSetting/ajaxCreate")?>',
				data : datastring,
				type : 'Post',
				success : function(data){
					if(data == 'success')
					{
						window.location.reload();
						//alert('Your payment method updated successfully ! Thanks');
					}
					console.log(data);
				}
		});
	});

	</script>