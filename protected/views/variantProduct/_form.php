<!--  form code start here -->
<div class="clearfix mar_top2"></div>



<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'variant-product-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
	<p class="help-block" align="right">
		Fields with <span class="required">*</span> are required.
	</p>

	<?php //echo $form->errorSummary($model); ?>


<div class="form-group ">
	<label for="Page_title" class="col-md-3">Title <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->textField($model,'title',array('class'=>'form-control','maxlength'=>256)); ?>
	<?php echo $form->error($model,'title');?>
	</div>
</div>



<?php echo $form->textFieldGroup($model,'sku',array('class'=>'span5','maxlength'=>64)); ?>


<?php echo $form->textFieldGroup($model,'store_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'product_code',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->textFieldGroup($model,'prod_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'range',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'edition',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'hide_public',array('class'=>'span5')); ?>


<?php echo  '';$code = $this->richTextEditor() ;

					if ($code == 1) echo $form->html5EditorRow($model,'description', array('class'=>'span4', 'rows'=>5, 'height'=>'200', 'options'=>array('color'=>true)));

					else if ($code == 2) echo $form->redactorRow($model,'description', array('class'=>'span4', 'rows'=>5));

					else if ($code == 3) echo $form->ckEditorRow($model,'description', array('options'=>array('fullpage'=>'js:true', 'width'=>'640', 'resize_maxWidth'=>'640','resize_minWidth'=>'320')));

					else echo $form->textAreaRow($model,'description',  array('class'=>'span4', 'rows'=>5));; ?>


<?php echo $form->textFieldGroup($model,'large_description',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'tags',array('class'=>'span5','maxlength'=>512)); ?>


<?php echo $form->textFieldGroup($model,'related_items',array('class'=>'span5','maxlength'=>1024)); ?>


<?php echo $form->fileFieldGroup($model, 'thumbnail_file'); ?>


<?php echo $form->fileFieldGroup($model, 'image_file'); ?>



<div class="form-group ">
	<label for="Page_title" class="col-md-3">Category <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->dropDownList($model, 'category_id', Html::listDataEx(Category::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'Select Category')); ?>
	<?php echo $form->error($model,'category_id');?>
	</div>

<?php echo $form->textFieldGroup($model,'size_id',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->textFieldGroup($model,'color_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'brand_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'is_sale',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'feature_site',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'is_featured',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'postage_id',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'view_count',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'warranty_id',array('class'=>'span5')); ?>


<div class="form-group ">
	<label for="Page_title" class="col-md-3">Quantity <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'quantity',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'quantity');?>
	</div>
</div>		


<div class="form-group ">
	<label for="Page_title" class="col-md-3">Price <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'price',array('class'=>'form-control','prepend'=>'$')); ?>
	<?php echo $form->error($model,'price');?>
	</div>
</div>	


<?php echo $form->textFieldGroup($model,'price',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'is_discount',array('class'=>'span5')); ?>


<?php echo $form->textFieldGroup($model,'tax',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->textFieldGroup($model,'tax_amount',array('class'=>'span5','maxlength'=>32)); ?>


<?php echo $form->dropDownListGroup($model, 'type_id',
			$model->getTypeOptions()); ?>


<?php echo $form->dropDownListGroup($model, 'state_id',
			$model->getStatusOptions()); ?>


<?php echo $form->textFieldGroup($model,'product_id',array('class'=>'span5','maxlength'=>256)); ?>


<?php echo $form->textFieldGroup($model,'rss_id',array('class'=>'span5')); ?>


<?php echo $form->datepickerRow($model, 'update_time',
					array('hint'=>'Click inside! to select a date.',
					'prepend'=>'<i class="icon-calendar"></i>'))
; ?>






	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->