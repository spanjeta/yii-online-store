
<div class="mar_top2 clearfix"></div>


<div class="span10 offset1 order_message">

<h3> Thank You ! for your order  You may have to used bank deposit payment system . your payment is currently pending  . Please
Make sure you promptly deposit this order payment.
</h3>

<p> Your order id is <?php echo $payment->id ; ?>&nbsp;   You can track your order status from 


<?php echo CHtml::link('Buying Page',array('order/buy'));?>

<p>



<p> You can leave a review  <?php  echo CHtml::link('here','#')?> </p>

<p> See other item from this seller 
<?php  echo CHtml::link('here',array('company/view','id'=>$payment->id));?>
</p>


</div>