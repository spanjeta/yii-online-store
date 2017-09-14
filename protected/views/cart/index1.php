
<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3>

	<?php echo $totalItems.' Items ';?>
	<?php //echo CHtml::link('Check Out All Items &nbsp;'.' <i class="fa fa-angle-right"></i>','#',array('class'=>'btn btn-gray pull-right'));?>
		</h3>
</div>


<div class="box-body">
	<?php if(Yii::app()->user->hasFlash('warning')) {

		$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		),
		));

	}?>

	<?php
	if($cart)
	{
		
			$items = $cart->cartItems;
			$subtotal = round($cart->getTotal(),2);

			
			//$model->saveAttributes(array('amount'));

			$dataProvider = new CActiveDataProvider('Cart',array(
				'data'=>$items,
			));
			
			$this->renderPartial('_list', array(
				'dataProvider'=>$dataProvider,
				
				'subtotal'=>$subtotal,
				
				
				'model'=>$cart
			));
		
	}
	else
	{
		echo 'No item found in carts';
	}
?>
</div>
</div>
</div>
</div>