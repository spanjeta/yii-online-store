<?php include(dirname(__FILE__).'/../user/tabs.php')?>
<hr>

<h3>
	<?php echo 'Edit'; ?>

	<div class="pull-right">

		<?php echo CHtml::link('Back',array('postage/index'), array('class'=>'btn btn-primary'));?>

	</div>
</h3>
<hr>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id' => 'postage-form-create',
		'type'=>'horizontal',
		'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions'=>array('validateOnSubmit'=>true),
		//	'enableAjaxValidation' => true,
		//'action' => $this->createUrl('postage/create'),
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldGroup($model,'title',array('class'=>'span5','maxlength'=>256)); ?>

<?php echo $form->textFieldGroup($model,'first_item_cost',array('class'=>'span5','maxlength'=>5,'prepend'=>'$')); ?>

<?php echo $form->textFieldGroup($model,'additional_item_cost',array('class'=>'span5','maxlength'=>5,'prepend'=>'$')); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
</div>

<?php $this->endWidget(); ?>


<!-- form code ends here -->
