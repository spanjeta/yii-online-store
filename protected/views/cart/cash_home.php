<div class="mar_top2 clearfix"></div>

<div class="span10 offset1 order_message">
	<h3>Thank You ! for your order You may have to used Home Delivery
		payment system . your payment is currently pending . Please Make sure
		you promptly deposit this order payment.</h3>
	<p>
		Your order id is
		<?php echo $payment->order_no; ?>
		&nbsp; You can track your order status from
		<?php echo CHtml::link('Buying Page',array('order/buy'));?>
	</p>
	

	<div id="success_mess" style="display: none">
	<?php
	Yii::app()->user->setFlash('success', '<strong>Thanks!</strong> Your feedback have been  added successfully .!');
	$this->widget('booster.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
	),
	)); ?>
	</div>
<?php /* ?>
	<div id="ajaxReview" style="display: none;">
	<?php $this->renderPartial('../review/create',array('model'=>new Review() , 'id'=>$payment->shop_id))?>
	</div>
	<?php */ ?>
	<p>
		See other item from this seller
		<?php  echo CHtml::link('here',array('site/index'));?>
	</p>
</div>
<div class="mar_top10 clearfix"></div>


