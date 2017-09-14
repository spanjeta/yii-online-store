
<div class="mar_top2 clearfix"></div>


<div class="span10 offset1 order_message">

	<p>Thank You ! Your payment is successfully</p>

	<p>
		Your order id is
		<?php echo $payment->order_no ; ?>
		&nbsp; You can track your order status from
		<?php echo CHtml::link('Buying Page',array('api/order/buy'));?>
	</p>
	<p>
		You can leave a review
		<?php
		echo CHtml::link('here','#',array('onclick'=>'$("#ajaxReview").slideToggle(); return false;'))?>
	</p>

	<div id="success_mess" style="display:none">
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

	<div id="ajaxReview" style="display: none;">
	<?php $this->renderPartial('../review/create',array('model'=>new Review() , 'id'=>$payment->shop_id))?>
	</div>

</div>
