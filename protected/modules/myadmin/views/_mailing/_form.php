<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mailing-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
    
<?php if($model->isNewRecord) { ?>

	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>70)); ?>

    <?php 
		$modelT=Status::model()->findAll(array('select'=>'id, name','condition'=>"metaKey='mailingType'"));
		$listT = CHtml::listData($modelT, 'id', 'name'); // print_r($listU); ?>

	<?php echo $form->dropDownListRow($model,'type', $listT, array('empty'=>' - select one - ')); ?>

	<?php echo $form->textAreaRow($model,'queue',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

					<?php Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget'); ?>
                    <?php					
						$this->widget('ImperaviRedactorWidget', array(
							// You can either use it for model attribute
							'model' => $model,
							'attribute' => 'content',					
							// Some options, see http://imperavi.com/redactor/docs/
							'options' => array(
								'lang' => 'en',
								'minHeight' => 400,
								'toolbar' => true,
								'iframe' => true,
								'css' => 'wym.css',
							),
						));
					?>

<?php } ?>
    
    <?php 
		$modelS=Status::model()->findAll(array('select'=>'id, name','condition'=>"metaKey='mailing'"));
		$listS = CHtml::listData($modelS, 'id', 'name'); // print_r($listU); ?>

	<?php echo $form->dropDownListRow($model,'status', $listS); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>