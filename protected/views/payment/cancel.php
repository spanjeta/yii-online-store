
<div class="view well">
	<h3>I am sorry look like your payment . didn't go through . please try
		again or use any alternative method.</h3>

</div>
<hr>
<hr>
<h3>PAYMENT</h3>
<p class="includes">
	Includes: &nbsp; <img
		src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cards.png"
		alt="payment method" />
</p>


<div class="form payment_method">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'payment-setting-form',
			'type'=>'',
			'action'=>Yii::app()->createUrl('cart/payment',array('cart_id'=>$cart_id)),
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php echo $form->radioButtonList($method, 'pay_by',array('Paypal','Credit Card','Bank Deposit', 'Cash Pickup', 'Cash Delivery')); ?>


	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Pay Now',
				'id'=>'payby_'
				)); ?>
				<?php $this->widget('booster.widgets.TbButton', array(
				//'buttonType'=>'submit',
				//'type'=>'primary',
				'url'=>$this->createUrl('cart/index'),
				'label'=>'Cancel',
				)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
