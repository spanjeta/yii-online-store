<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('comment')); ?>:
	<?php echo Html::encode($data->comment); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('shop_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->shop)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('star_count')); ?>:
	<?php echo Html::encode($data->star_count); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('image_file')); ?>:
	<?php echo Html::encode($data->image_file); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
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