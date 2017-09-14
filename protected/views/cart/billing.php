<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3>
				<?php echo Yii::t('app','addresses')?>
				</h3>
				</div>


<div class="box-body">
<div class="row">
<div class="col-sm-12 text-right">
<a href="<?php echo Yii::app()->createUrl('address/addAddress',array('cart_id'=>$id));?>" class="btn btn-black">	<?php echo Yii::t('app','add')?></a>
</div>
</div>			

<?php if($addresses){?>
<div class="row">
	<?php 
	foreach($addresses as $address){?>

	<div class="col-md-3 clearfix">
		<div class="shipping-address-outer">
			<h3><?php echo Yii::t('app','shipping addresses')?></h3>
			<hr/>
			<?php echo $address->bulding_name;?></br>
			<?php echo $address->street_add;?></br>
			<?php echo $address->suburb;?></br>
			<?php echo $address->postcode;?></br>
			<?php echo $address->_state;?></br>
			<?php echo $address->country;?></br>
			<hr/>
			<!-- <a href="--><?php //echo $address->geturl('update')?><!-- " class="btn btn-black">Edit</a> -->
			<a href="<?php echo Yii::app()->createUrl('address/update',array('id'=>$address->id,'cart_id'=>$id));?>" 
			class="btn btn-black">	<?php echo Yii::t('app','edit')?></a>
			<a href="<?php echo Yii::app()->createUrl('cart/billing',array('id'=>$address->id,'cart_id'=>$id));?>" 
			class="btn btn-black">	<?php echo Yii::t('app','select')?></a>
		</div>
	</div>
	<?php }?>
	<?php }?>
</div>

</div>
</div>
</div>
</div>
</div>