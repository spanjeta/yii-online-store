<div class="clearfix mar_top2"></div>


<?php

$items = $model->cartItems;
$subtotal = round($model->getTotal(),2);
$gst = round($subtotal/11,2);
$totalorder = round( $subtotal+$gst,2);

$dataProvider = new CActiveDataProvider('Cart',array(
		'data'=>$items,
));
$shop_name = $model->shop;
$this->renderPartial('_summary', array(
		'dataProvider'=>$dataProvider,
		'shop_name'=>$shop_name,
		'subtotal'=>$subtotal,
		'gst' => $gst,
		'total_order'=>$totalorder,
		'model'=>$model
));

?>

<hr>
<hr>
<h3>PAYMENT</h3>
<p class="includes">
	Includes: &nbsp; <img
		src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cards.png"
		alt="payment method" />
</p>

<?php /* $this->renderPartial('_paypalform',array(
'model'=>$model,
'shop_name'=>$shop_name,
'subtotal'=>$subtotal,
'gst' => $gst,
'total_order'=>$totalorder,
'model'=>$model
)) */?>



<div class="form payment_method">


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'payment-setting-form',
			'type'=>'',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
<?php echo $form->errorSummary($model); ?>

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


	<?php /*
	<script>
	$('#payby_').click(function(event) {
	//alert('fdf');
	event.preventDefault();
	var checkedValues = $('input:checkbox:checked').map(function() {
	return this.id;
	}).get();

	//console.log(checkedValues);

	var count = checkedValues.length;
	if(count > 1)
	{
	alert('Please select only one Payment method');
	//	return false;
	}
	else {

	$('#payment-setting-form').submit();
	}
	})

	</script>
	*/?>
