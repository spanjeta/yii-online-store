<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<?php echo Html::encode($data->getAttributeLabel('id')); ?>:
	<?php echo Html::encode($data->id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('username')); ?>:
	<?php echo Html::encode($data->username); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('first_name')); ?>:
	<?php echo Html::encode($data->first_name); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('middle_name')); ?>:
	<?php echo Html::encode($data->middle_name); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('last_name')); ?>:
	<?php echo Html::encode($data->last_name); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('date_of_birth')); ?>:
	<?php echo Html::encode($data->date_of_birth); ?>
	<br />
	<?php /*
	<?php echo Html::encode($data->getAttributeLabel('password')); ?>:
	<?php echo Html::encode($data->password); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('gender')); ?>:
	<?php echo Html::encode($data->gender); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('about_me')); ?>:
	<?php echo Html::encode($data->about_me); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('image_file')); ?>:
	<?php echo Html::encode($data->image_file); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('tos')); ?>:
	<?php echo Html::encode($data->tos); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('role_id')); ?>:
		<?php echo Html::encode(Html::valueEx($data->role)); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('state_id')); ?>:
	<?php echo Html::encode($data->state_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('type_id')); ?>:
	<?php echo Html::encode($data->type_id); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('last_visit_time')); ?>:
	<?php echo Html::encode($data->last_visit_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('last_action_time')); ?>:
	<?php echo Html::encode($data->last_action_time); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('last_password_change')); ?>:
	<?php echo Html::encode($data->last_password_change); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('activation_key')); ?>:
	<?php echo Html::encode($data->activation_key); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('login_error_count')); ?>:
	<?php echo Html::encode($data->login_error_count); ?>
	<br />
	<?php echo Html::encode($data->getAttributeLabel('create_time')); ?>:
	<?php echo Html::encode($data->create_time); ?>
	<br />
	*/ ?>

</div>