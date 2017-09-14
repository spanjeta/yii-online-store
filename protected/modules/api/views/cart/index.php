<div class="row-fluid">
	<div class="clearfix mar_top2"></div>
</div>
<div class="total_items">

	<h3>
	<?php echo $totalItems.'Items total from '.$totalShops.'shop';?>
	<?php //echo CHtml::link('Check Out All Items &nbsp;'.' <i class="fa fa-angle-right"></i>','#',array('class'=>'btn btn-gray pull-right'));?>
	</h3>
</div>

<hr>

	<?php
	if($models)
	{
		foreach($models as $model)
		{
			$items = $model->cartItems;
			$subtotal = round($model->getTotal(),2);

			$gst = round($subtotal/11,2);

			$totalorder = round( ($subtotal+$model->postage_charge - $model->coupon_amount),2);

			$model->amount = $totalorder;
			$model->saveAttributes(array('amount'));

			$dataProvider = new CActiveDataProvider('Cart',array(
				'data'=>$items,
			));
			$shop_name = $model->shop;
			$this->renderPartial('_list', array(
				'dataProvider'=>$dataProvider,
				'shop_name'=>$shop_name,
				'subtotal'=>$subtotal,
				'gst' => $gst,
				'total_order'=>$totalorder,
				'model'=>$model
			));
		}
	}
	else
	{
		echo 'No item found in carts';
	}
