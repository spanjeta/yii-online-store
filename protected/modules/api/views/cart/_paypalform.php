
<?php

$url  = 'https://www.paypal.com/cgi-bin/webscr';
$url  = 'https://www.sandbox.paypal.com' ;

$seller_id = 'rajesh@toxsl.com';
$amount = $model->amount;
$item_name = $model->shop->shop_name;
$item_number = $model->itemCounts;;
$currency_code = 'USD';
$returl = Yii::app()->createAbsoluteUrl('payment/success', array('id'=>$model->id));
$canurl = Yii::app()->createAbsoluteUrl('payment/cancel',array('id'=>$model->id));
$notify_url = Yii::app()->createAbsoluteUrl('payment/success', array('id'=>$model->id));
if ( YII_ENV == 'dev')
{
	$url  = 'https://www.sandbox.paypal.com' ;
	$seller_id = 'rajesh@toxsl.com';
}
?>
<form action="<?php echo $url;?>" id="paypal" method="Post">
	<input type="hidden" name="cmd" value="_xclick"> <input type="hidden"
		name="no_shipping" value="1"> <input type="hidden" name="business"
		value="<?php echo $seller_id; ?>"> <input type="hidden" name="lc"
		value="US"> <input type="hidden" name="item_name"
		value="<?php echo $item_name; ?>"> <input type="hidden"
		name="item_number" value="<?php echo $item_number; ?>"> <input
		type="hidden" name="amount" value="<?php echo $amount; ?>"> <input
		type="hidden" name="currency_code"
		value="<?php echo $currency_code; ?>"> <input type="hidden"
		name="button_subtype" value="services"> <input type="hidden"
		name="no_note" value="0"> <input type="hidden" name="return"
		value="<?php echo $returl; ?>"> <input type="hidden"
		name="cancel_return" value="<?php echo $canurl; ?>"> <input
		type="hidden" name="notify_url" value="<?php echo $notify_url; ?>">
</form>

<script>

$(document).ready(function(){

	$('#paypal').submit();
});
</script>

