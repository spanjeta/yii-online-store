
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3>

	<?php echo $totalItems." ".Yii::t('app', 'items');?>
	<?php //echo CHtml::link('Check Out All Items &nbsp;'.' <i class="fa fa-angle-right"></i>','#',array('class'=>'btn btn-gray pull-right'));?>
		</h3>
</div>


<div class="box-body">
<?php if(Yii::app()->user->hasFlash('error')){?>
	<div class="alert alert-danger">
	<?=Yii::app()->user->getFlash('error')?>
	</div>
<?php }?>
	<?php if(Yii::app()->user->hasFlash('warning')) {

		$this->widget('booster.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'warning'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
		),
		));

	}?>

	<?php
	$qty = 0;
	if(!empty($cart)){
	if($cart->cartItems > 0) {
		foreach ($cart->cartItems as $itm){
			$qty += $itm->quantity;
		}
	}
	
	if($qty > 0)
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
					//'discount'=>$discount,
				
				
				'model'=>$cart
			));
		
	}
	}
	else
	{
    echo Yii::t('app','no item found in cart');
	}
?>
</div>
</div>
</div>
</div>




