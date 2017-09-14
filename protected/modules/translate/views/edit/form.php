<section class="content content-login">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<div class="panel-body">

<?php $action=$model->getIsNewRecord() ? 'Create' : 'Update';?>


<div class="row">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'message-form',
	'enableAjaxValidation'=>false
		
)); ?>

	
	
	<div class="col-md-offset-3 col-md-6">
	<h3><?php echo TranslateModule::t(($action) . ' Message')." # ".$model->id." - ".TranslateModule::translator()->acceptedLanguages[$model->language]; ?></h3>
	
	<p class="help-block" align="right">Fields with <span class="required">*</span> are required.</p>
	<div class="form-group">
  
    <?php echo $form->hiddenField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
    
    <?php echo $form->hiddenField($model,'language',array('size'=>16,'maxlength'=>16)); ?>
    </div>
	
   
    <div class="form-group">
    
        <?php echo $form->label($model->source,'category'); ?>
        <?php echo $form->textField($model->source,'category',array('disabled'=>'disabled','class'=>'form-control')); ?>
   
    </div>
    <div class="form-group">
        <?php echo $form->label($model->source,'message'); ?>
        <?php echo $form->textField($model->source,'message',array('disabled'=>'disabled','class'=>'form-control')); ?>
    </div>
    <div class="form-group">
	
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textArea($model,'translation',array('class'=>'form-control' , 'rows'=>2, 'cols'=>80)); ?>
		<?php echo $form->error($model,'translation'); ?>
	</div>

	<div class="col-md-12 buttons">
		<?php echo CHtml::submitButton(TranslateModule::t($action)); ?>
	</div>
</div>
<?php $this->endWidget(); ?>
</div>


</div><!-- form -->
</div>
</div>
</div>
</div>
</section>