
<div class="loading" id="">
	<center>
		<img 
			src="<?php echo Yii::app()->theme->baseUrl.'/images/loading.gif'?>" />
	</center>
</div>

<?php

$url = 'https://www.paypal.com/';
$seller_id = 'test@gmail.com';
$data = PaymentSetting::model()->findByAttributes(array(
			'state_id' => PaymentSetting::STATE_ACTIVE
));
if(!empty($data)){
	$seller_id = $data->email;
	if($data->type_id == PaymentSetting::TYPE_TEST){
		$url = 'https://www.sandbox.paypal.com';
	}
}

$user = Yii::app ()->user->model;
$amount = $model->amount;

$item_name = $model->id;

// $country_code = 'GB';

$currency_code =  'EUR';

$returl = Yii::app ()->createAbsoluteUrl ( 'order/paypalSuccess', array (
		'id' => $model->id 
) );
$canurl = Yii::app ()->createAbsoluteUrl ( 'order/view', array (
		'id' => $model->id 
) );
$notify_url = Yii::app ()->createAbsoluteUrl ( 'order/view', array (
		'id' => $model->id 
) );

/* if (YII_ENV == 'dev') {
	$url = 'https://www.sandbox.paypal.com';
>>>>>>> Stashed changes
	// $seller_id = 'rajesh@toxsl.com';
} */

?>
<form action="<?php echo $url;?>" id="paypal">
	<input type="hidden" name="cmd" value="_xclick"> <input type="hidden"
		name="no_shipping" value="1"> <input type="hidden" name="business"
		value="<?php echo $seller_id; ?>"> <input type="hidden" name="lc"
		value="US"> <input type="hidden" name="item_name"
		value="<?php echo $item_name; ?>"> <input type="hidden"
		name="item_number" value="<?php //echo $item_number; ?>"> <input
		type="hidden" name="amount" value="<?php echo $amount; ?>"> <input
		type="hidden" name="country_code"
		value="<?php //echo $country_code; ?>"> <input type="hidden"
		name="currency_code" value="<?php echo $currency_code; ?>"> <input
		type="hidden" name="button_subtype" value="services"> <input
		type="hidden" name="no_note" value="0"> <input type="hidden"
		name="return" value="<?php echo $returl; ?>"> <input type="hidden"
		name="cancel_return" value="<?php echo $canurl; ?>"> <input
		type="hidden" name="notify_url" value="<?php echo $notify_url; ?>
		">
		<input type="hidden" name="rm" value="2" />
		
</form>

<script>

$(document).ready(function(){

	$('#paypal').submit();
});
</script>

