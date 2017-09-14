<div class="wide form">

<?php 	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'action' => Yii::app()->createUrl($this->route),
	'method' => 'get',
	'id' => 'wish-list-form',
	'type'=>'horizontal',		
)); ; 
?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'model_id'); ?>
		<?php echo $form->textField($model, 'model_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'type_id'); ?>
		<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'type_id',
			'data'=>$model->getTypeOptions(),
			)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'state_id'); ?>
		<?php 
			$this->widget('ext.widgets.CJuiRadioButtonList', array(
			'model'=>$model,
			'attribute'=>'state_id',
			'data'=>$model->getStatusOptions(),
			)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_user_id'); ?>
		<?php echo $form->dropDownList($model, 'create_user_id', Html::listDataEx(User::model()->findAllAttributes(null, true)), array('prompt' => Yii::t('app', 'All'))); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'create_time'); ?>
		<?php $form->widget('zii.widgets.jui.CJuiDatePicker', array(
			'model' => $model,
			'attribute' => 'create_time',
			'value' => $model->create_time,
			'options' => array(
			'showButtonPanel' => true,
			'changeYear' => true,
			'dateFormat' => 'yy-mm-dd',
			),
			));
; ?>
	</div>


	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
