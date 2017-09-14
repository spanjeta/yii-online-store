<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('product_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->product)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('shop_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->shop)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('quantity')); ?>:
	<?php echo Html::encode($data->quantity); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('device_id')); ?>:
	<?php echo Html::encode($data->device_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('ip_address')); ?>:
	<?php echo Html::encode($data->ip_address); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('session_id')); ?>:
	<?php echo Html::encode($data->session_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_user_id')); ?>:
	<?php echo Html::encode($data->create_user_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo Html::encode($data->update_time); ?>
	<br />
	*/ ?>  

</div>