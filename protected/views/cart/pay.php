<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3>
				</h3>
				</div>


<div class="box-body">
<h3 class="text-center">	<?php echo Yii::t('app','select a payment method')?></h3>
</br>
<a href="#"
	onclick="CashOnDelivery(<?php echo Order::CASH_ON_DELIVERY;?>)" class="btn btn-black">	<?php echo Yii::t('app','cash on delivery')?></a>


<a href="#" onclick="CashOnDelivery(<?php echo Order::PAY_NOW;?>)" class="btn btn-black pull-right">	<?php echo Yii::t('app','pay now')?></a>
</div>

</div>
</div>
</div>
</div>


<script>

function CashOnDelivery(method){
	var id = <?php echo $cart->id;?>;
	$.ajax({
    url: "<?php echo Yii::app()->createUrl("cart/payment")?>/cart_id/"+id+"/method/"+method,
    success: function(response){
	        if(response.status == 'OK'){ 
		        if(method != 1){ 
   	       alert("<?=Yii::t('app','order is successfully placed')?>");  
		        }
   	    window.location.href = response.url;
    	}else {
    	
    			alert(response.error);
    	}
    	
    
	}
});
}
</script>