<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('sku')); ?>:
	<?php echo Html::encode($data->sku); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('product_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->product)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('color_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->color)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('size_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->size)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('brand_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->brand)); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('quantity')); ?>:
	<?php echo Html::encode($data->quantity); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('price')); ?>:
	<?php echo Html::encode($data->price); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('discount_price')); ?>:
	<?php echo Html::encode($data->discount_price); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_user_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->createUser)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	*/ ?>

</div>