
<?php //echo CHtml::dropDownList('type_id',$model,$model->getPrintOperation(),array('empty' => 'Select Operation')); ?>

<section class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">	<center>
		<h4>
			<span><?php echo Yii::t('app','orders description');?></span>
		</h4>
	</center>
	<?php if(Yii::app()->user->hasFlash('reject')){?>
		<div class="alert alert-danger">
		<?=Yii::app()->user->getFlash('reject')?>
		</div>
	<?php }elseif (Yii::app()->user->hasFlash('Paid')){?>
	<div class="alert alert-success">
		<?=Yii::app()->user->getFlash('Paid')?>
		</div>
	<?php }elseif (Yii::app()->user->hasFlash('Shipped')){?>
	<div class="alert alert-info">
		<?=Yii::app()->user->getFlash('Shipped')?>
		</div>
	<?php }elseif (Yii::app()->user->hasFlash('On')){?>
	<div class="alert alert-warning">
		<?=Yii::app()->user->getFlash('On')?>
		</div>
		<?php }elseif (Yii::app()->user->hasFlash('delivered')){?>
	<div class="alert alert-success">
		<?=Yii::app()->user->getFlash('delivered')?>
		</div>
		<?php }?>

	<div class="clearfix mar_top2"></div>

<div class="progress">
<?php $state = $model->getCurrentState($model->id);?>

<?php if($model->state_id == Order::STATE_REJECT){?>
    <div class="progress-bar progress-bar-danger" role="progressbar" style="width:100%">
    <?php echo Yii::t('app','order rejected');?>
    </div>
    
    <?php }elseif ($state == Order::STATE_ACCEPT){?>
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:10%">
      <?php echo Yii::t('app','order accepted');?> <i class="fa fa-check" aria-hidden="true"></i>
    </div>
   
    <?php }elseif ($state==Order::STATE_ON){?>
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:10%">
   <?php echo Yii::t('app','order accepted');?> <i class="fa fa-check" aria-hidden="true"></i>
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
<?php echo Yii::t('app','order is on the way');?><i class="fa fa-truck" aria-hidden="true"></i>
    </div>
     <?php }elseif ($state==Order::STATE_SHIPPED){?>
    <div class="progress-bar progress-bar-success" role="progressbar" style="width:10%">
      <?php echo Yii::t('app','order accepted');?><i class="fa fa-check" aria-hidden="true"></i>
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
  <?php echo Yii::t('app','order is on the way');?> <i class="fa fa-truck" aria-hidden="true"></i>
    </div>
     <div class="progress-bar progress-bar-info" role="progressbar" style="width:40%">
    <?php echo Yii::t('app','order shipped');?> <i class="fa fa-automobile" aria-hidden="true"></i>
    </div>
    <?php }elseif ($state==Order::STATE_DELIVERED){?>
   <div class="progress-bar progress-bar-success" role="progressbar" style="width:10%">
       <?php echo Yii::t('app','order accepted');?> <i class="fa fa-check" aria-hidden="true"></i>
    </div>
    <div class="progress-bar progress-bar-warning" role="progressbar" style="width:30%">
     <?php echo Yii::t('app','order is on the way');?> <i class="fa fa-truck" aria-hidden="true"></i>
    </div>
     <div class="progress-bar progress-bar-info" role="progressbar" style="width:40%">
   <?php echo Yii::t('app','order shipped');?> <i class="fa fa-automobile" aria-hidden="true"></i>
    </div>
     <div class="progress-bar progress-bar-danger" role="progressbar" style="width:20%">
    <?php echo Yii::t('app','order delivered');?><i class="fa fa-check-circle" aria-hidden="true"></i>
    </div>
    
    <?php }?>
  </div>

	<?php
	
	$this->widget ( 'booster.widgets.TbGridView', array (
			'id' => 'cart-grid',
			'type' => 'bordered', // 'condensed','striped',
			'dataProvider' => $dataProvider,
			'template' => '{items}{pager}',
			// 'htmlOptions'=>array('class'=>'row-fluid cart_grid pull-left'), //cart_grid
			'columns' => array (
					//'id',
					array ('header' => Yii::t('app','product'),
							
							'type' => 'raw',
							
							'value' => 'isset($data->product->thumbnail_file)?CHtml::image($data->product->thumbnail_file):CHtml::image($data->product->getImage())',
							'htmlOptions' => array (
									'class' => 'cart-image'
							) 
					),
					array (
							'header' => Yii::t('app','product'),
							
							'value' => 'Html::valueEx($data->product)' ,
							
					),
					
					array (
							'header' => Yii::t('app','quantity'),
							'type' => 'raw',
							
							// 'value'=>'Html::valueEx($data->product)',
							
							'value' => '$data->quantity'
					), 
					
					array (
							'header' => Yii::t('app','price'),
							
							'value' => '$data->getTotal()' 
					) ,
					
					  array (
					  		'header' => Yii::t('app','color'),
							'type' => 'raw',
							
							// 'value'=>'Html::valueEx($data->product)',
							
							'value' => '$data->color'
					), 
			 array (
			 		'header' => Yii::t('app','size'),
							'type' => 'raw',
							
							// 'value'=>'Html::valueEx($data->product)',
							
							'value' => '$data->size'
		) 
			) 
	) );
	?>
	</div>
	</div>
	</div>
	</div>
<div class="row">
		<div class="col-md-12">
		<div class="col-md-6">
			<div class="box box-primary">
			<div class="box-body">
		<h3><span class="cart_title"><?php echo Yii::t('app','sub total');?></span> <span
			class="cart_description"><?php echo round($model->getTotal(),2).'€'; ?>
		</span></h3>
		
		
	
	<?php 

$this->widget ( 'booster.widgets.TbDetailView', array (
		'data' => $model,
		'attributes' => array (
				//'id',
				
				array (
						'label' => Yii::t('app','name'),
						
						'type' => 'raw',
						//'name' => 'create_user_id',
						'value' => $model->createUser->first_name,
						
				),
				array (
						'label' => Yii::t('app','order email'),
						
						'type' => 'raw',
						//'name' => 'create_user_id',
						'value' => $model->order_email,
						
				),
				
				array (
						'label' => Yii::t('app','phone no'),
						
						'type' => 'raw',
						//'name' => 'create_user_id',
						'value' => $model->phone_no,
						
				),
				
				array (
						'label' => Yii::t('app','amount'),
						
						'type' => 'raw',
						//'name' => 'create_user_id',
						'value' => $model->amount,
						
				),
				
				array (
						'label' => Yii::t('app','order email'),
						
						'type' => 'raw',
						//'name' => 'create_user_id',
						'value' => $model->order_email,
						
				),
			
				//'bill_address_id',
				//'state_id',
				
	 array (
	 		'label' => Yii::t('app','State'),
						'type' => 'raw',
						//'name' => 'state_id',
						'value' =>  $model->getStatusOptions($model->state_id),
						
				),
				array (
						'label' => Yii::t('app','payment type'),
						'type' => 'raw',
						//'name' => 'Payment Type',
						'value' =>  $model->getTypeOptions($model->type_id),
						
				),
				array (
						'label' => Yii::t('app','paid'),
						'type' => 'raw',
						'name' => 'paid',
						'value' =>  $model->getPaidOptions($model->paid),
						
				),
			
			/* 	array (
						'type' => 'raw',
						'name' => 'Address',
						'value' =>  isset($model->shipAddress) ? $model->shipAddress->country  ."<br/>". $model->shipAddress->bulding_name."<br/>". $model->shipAddress->street_add
						."<br/>". $model->shipAddress->postcode: "(Not set)" ,
						
				), */
				
				/* array (
						'type' => 'raw',
						'name' => 'image_file',
						'value' => CHtml::image ($model->getImage()),
						
				),
			 */
				'create_time' 
		) 
)
 );
?>

<div class="button_bottom">
<?php if(Yii::app()->user->isUser){

		//print_r($model->state_id);exit;
	if($model->state_id != Order::STATE_DELIVERED ){
	?>
<a href="<?php echo  yii::app()->createUrl('order/reject',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','reject');?></a>
<?php }} ?>
<?php if(Yii::app()->user->isAdmin){?>
<a href="<?php echo  yii::app()->createUrl('order/accept',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','accept');?></a>
<a href="<?php echo  yii::app()->createUrl('order/on',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','on the way');?></a>
<a href="<?php echo  yii::app()->createUrl('order/shipped',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','shipped');?></a>
<a href="<?php echo  yii::app()->createUrl('order/delivered',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','delivered');?></a>
<?php } ?>
</div>

<div class="button_bottom">

<?php if(Yii::app()->user->isAdmin){
 if($model->paid != Order::PAID){
	?>

<a href="<?php echo  yii::app()->createUrl('order/paid',['id' => $model->id]) ?>" class="btn btn-success"><?php echo Yii::t('app','paid');?></a>

<?php }} ?>
</div>
	
	
	
		
		
<?php 
		/* <li><span class="cart_title"><!-- Coupon Discount --></span> <span
			class="cart_description"><?php //echo '$'.$cart->coupon_amount;  </span>
		</li>


		<li><span class="cart_title"><!-- Gst Amount --></span> <span
			class="cart_description"><?php //echo  $cart->amount/11;  </span></li>

		<li><span class="cart_title">Postage charges </span> <?php echo $cart->postage_charge;
			</li>

		<li class="order_total"><span class="cart_title"><!-- Total Paid --></span> <span
			class="cart_description"><?php //echo $cart->amount.'$'; </span></li>
	</ul> */
?>


</div>
</div>
</div>
<div class="col-md-6">
			<div class="box box-primary">
			<div class="box-body">
		<h3><span class="cart_title"><?php echo Yii::t('app','shipping address ');?> </span></h3> 
		<?php if($model->shipAddress){?>
		<span
			class="cart_description"><?php echo Yii::t('app','building name');?> : <?php echo $model->shipAddress->bulding_name ;?>
		</span></br>
		<span
			class="cart_description"><?php echo Yii::t('app','street address');?>:<?php echo $model->shipAddress->street_add ;?>
		</span></br>
		<span
			class="cart_description"><?php echo Yii::t('app','suburb');?> : <?php echo $model->shipAddress->suburb ;?>
		</span></br>
		<span
			class="cart_description"><?php echo Yii::t('app','postcode');?> : <?php echo $model->shipAddress->postcode ;?>
		</span></br>
		<span
			class="cart_description"><?php echo Yii::t('app','country');?> : <?php echo $model->shipAddress->country ;?>
		</span></br>
		<span
			class="cart_description"><?php echo Yii::t('app','phoneno');?> : <?php echo $model->shipAddress->ph_no ;?>
		</span></br>
		
		<?php }?>
	
	

	
	
	
		
		
<?php 
		/* <li><span class="cart_title"><!-- Coupon Discount --></span> <span
			class="cart_description"><?php //echo '$'.$cart->coupon_amount;  </span>
		</li>


		<li><span class="cart_title"><!-- Gst Amount --></span> <span
			class="cart_description"><?php //echo  $cart->amount/11;  </span></li>

		<li><span class="cart_title">Postage charges </span> <?php echo $cart->postage_charge;
			</li>

		<li class="order_total"><span class="cart_title"><!-- Total Paid --></span> <span
			class="cart_description"><?php //echo $cart->amount.'$'; </span></li>
	</ul> */
?>


</div>
</div>
</div>
</div>
</div>
</section>


