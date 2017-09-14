<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_user_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->createUser)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('ship_address_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->shipAddress)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('bil_address_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->bilAddress)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('amount')); ?>:
	<?php echo Html::encode($data->amount); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('order_email')); ?>:
	<?php echo Html::encode($data->order_email); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('phone_no')); ?>:
	<?php echo Html::encode($data->phone_no); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('paid')); ?>:
	<?php echo Html::encode($data->paid); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('payment_id')); ?>:
	<?php echo Html::encode($data->payment_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('ship_time')); ?>:
	<?php echo Html::encode($data->ship_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo Html::encode($data->update_time); ?>
	<br />
	*/ ?>

</div>