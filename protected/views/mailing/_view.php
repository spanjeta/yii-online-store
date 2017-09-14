<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('subject')); ?>:
	<?php echo Html::encode($data->subject); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('content')); ?>:
	<?php echo Html::encode($data->content); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('queue')); ?>:
	<?php echo Html::encode($data->queue); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('sent')); ?>:
	<?php echo Html::encode($data->sent); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('finishedOn')); ?>:
	<?php echo Html::encode($data->finishedOn); ?>
	<br />
	*/ ?>

</div>