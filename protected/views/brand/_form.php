<?php
/* @var $this BrandController */
/* @var $model Brand */
/* @var $form CActiveForm */
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'brand-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data'
		) 
)); ?>

	<p class="help-block" align="right">
		<p class="help-block"><?php echo Yii::t('app','fields with');?> <span class="required">*</span> <?php echo Yii::t('app','are required');?>.</p>
	</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group row">
		
		<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','title');?> <span class="required">*</span></label>
		<div class="col-md-9">
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
</div>
	<div class="form-group row">
		
		<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','description');?> <span class="required">*</span></label>
		<div class="col-md-9">
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
</div>



<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','image file');?><span class="required">*</span></label>
		<div class="col-md-9">
		 <?php echo CHtml::activeFileField($model, 'image_file'); ?> 
    <?php //echo $form->fileField($model,'image_file'); ?>
	</div>
</div>

	

	
	<div class="row-fluid">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


