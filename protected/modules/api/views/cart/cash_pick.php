
<div class="mar_top2 clearfix"></div>


<div class="span10 offset1 order_message">

	<h3>Thank You ! for your order You may have to used Cash Pickup payment
		system . your payment is currently pending . Please Make sure you
		promptly deposit this order payment.</h3>

	<p>
		Your order id is
		<?php echo $payment->id ; ?>
		&nbsp; You can track your order status from


		<?php echo CHtml::link('Buying Page',array('order/index'));?>
	
	
	</p>
	
	
<p>
		You can leave a review
		<?php

		echo CHtml::link('here','#',array('onclick'=>'$("#ajaxReview").slideToggle(); return false;'))?>
	</p>

	<div id="success_mess" style="display:none">
	<?php
	Yii::app()->user->setFlash('success', '<strong>Thanks!</strong> Your  feedback have been successfully added.');
	$this->widget('bootstrap.widgets.TbAlert', array(
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

	<p>
		See other item from this seller
		<?php  echo CHtml::link('here',array('company/view','id'=>$payment->id));?>
	</p>
</div>