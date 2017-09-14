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
	<?php echo Html::encode($data->getAttributeLabel('rating')); ?>:
	<?php echo Html::encode($data->rating); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_user_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->createUser)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />

</div>