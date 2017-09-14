<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('min_price')); ?>:
	<?php echo Html::encode($data->min_price); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('max_price')); ?>:
	<?php echo Html::encode($data->max_price); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('min_quantity')); ?>:
	<?php echo Html::encode($data->min_quantity); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('max_quantity')); ?>:
	<?php echo Html::encode($data->max_quantity); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('category_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->category)); ?>
	<br />
	<?php /*
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