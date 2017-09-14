<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('title')); ?>:
	<?php echo Html::encode($data->title); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('description')); ?>:
	<?php echo Html::encode($data->description); ?>
	<br />

</div>