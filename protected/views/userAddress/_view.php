<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('bulding_name')); ?>:
	<?php echo Html::encode($data->bulding_name); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('street_add')); ?>:
	<?php echo Html::encode($data->street_add); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('suburb')); ?>:
	<?php echo Html::encode($data->suburb); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('postcode')); ?>:
	<?php echo Html::encode($data->postcode); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('_state')); ?>:
	<?php echo Html::encode($data->_state); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('country')); ?>:
	<?php echo Html::encode($data->country); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('is_same')); ?>:
	<?php echo Html::encode($data->is_same); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('update_time')); ?>:
	<?php echo Html::encode($data->update_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_user_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->createUser)); ?>
	<br />
	*/ ?>

</div>