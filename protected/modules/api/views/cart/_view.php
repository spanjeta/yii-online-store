<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('id')); ?>:
	<?php echo GxHtml::encode($data->id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('product_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->product)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('shop_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->shop)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('quantity')); ?>:
	<?php echo GxHtml::encode($data->quantity); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('device_id')); ?>:
	<?php echo GxHtml::encode($data->device_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('ip_address')); ?>:
	<?php echo GxHtml::encode($data->ip_address); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('session_id')); ?>:
	<?php echo GxHtml::encode($data->session_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo GxHtml::encode($data->state_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo GxHtml::encode($data->type_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_user_id')); ?>:
	<?php echo GxHtml::encode($data->create_user_id); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo GxHtml::encode($data->create_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo GxHtml::encode($data->update_time); ?>
	<br />
	*/ ?>  

</div>