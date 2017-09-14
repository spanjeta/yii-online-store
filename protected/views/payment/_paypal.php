
<?php 

$url  = 'https://www.paypal.com/cgi-bin/webscr';

$seller_id = 'PAYPAL@SKYNETITALIA.NET';
$amount = 1.5;
$item_name = 'TheScout';
$item_number = 1;
$currency_code = 'USD';
$returl = Yii::app()->createAbsoluteUrl('payment/success', array('id'=>$model->id),'https');
$canurl = Yii::app()->createAbsoluteUrl('payment/cancel',array('id'=>$model->id),'https');
$notify_url = Yii::app()->createAbsoluteUrl('payment/success', array('id'=>$model->id),'https');
if ( YII_ENV == 'dev')
{
	$url  = 'https://www.sandbox.paypal.com' ;
	$seller_id = 'seller_1357106533_biz@gmail.com';
}
?>

<form action="<?php echo $url;?>" method="post" target="_blank">
<input type="hidden" name="cmd" value="_xclick">
 <input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="business" value="<?php echo $seller_id; ?>">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
<input type="hidden" name="item_number" value="<?php echo $item_number; ?>">
<input type="hidden" name="amount" value="<?php echo $amount; ?>">
<input type="hidden" name="currency_code" value="<?php echo $currency_code; ?>">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="return" value="<?php echo $returl; ?>">
<input type="hidden" name="cancel_return" value="<?php echo $canurl; ?>">
<input type="hidden" name="notify_url" value="<?php echo $notify_url; ?>" >
<input type="image" src="https://www.paypalobjects.com/en_GB/i/btn/btn_buynow_LG.gif"  border="0" name="submit" alt="PayPal � The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">

<!--<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
-->
</form>

