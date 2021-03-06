<?php

//$this->breadcrumbs = array(
	//$model->label(2) => array('index'),
	//GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	//Yii::t('app', 'Update'),
//);
?>
<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label()) . ' : ' . GxHtml::encode(GxHtml::valueEx($model)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Update Pages</li>
	</ol>
	</section>

	
<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> Please fill the details here</h3>
							<div class="box-tools pull-right">
						<button data-widget="collapse" class="btn btn-box-tool">
							<i class="fa fa-minus"></i>
						</button>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-box-tool dropdown-toggle">
								<i class="fa fa-wrench"></i>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
						<button data-widget="remove" class="btn btn-box-tool">
							<i class="fa fa-times"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">	
	



<!--  form code start here -->



<div class="clearfix mar_top2"></div>

<?php

$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
		'id' => 'product-form',
		'type' => 'horizontal',
		// 'action'=>$this->createUrl('api/product/create'),
		'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'clientOptions' => array (
				'validateOnSubmit' => true 
		),
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>
	<?php echo $form->errorSummary($model); ?>
<div class="form-group ">
	<label for="Page_title" class="col-md-3">Title <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->textField($model,'title',array('class'=>'form-control','maxlength'=>256)); ?>
	<?php echo $form->error($model,'title');?>
	</div>
</div>

<div class="form-group ">
	<label for="Page_title" class="col-md-3">Category <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->dropDownList($model, 'category_id', GxHtml::listDataEx(Category::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'Select Category')); ?>
	<?php echo $form->error($model,'category_id');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3">Description <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textArea($model,'description',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'description');?>
	</div>
</div>
	<div class="form-group ">
	<label for="Page_title" class="col-md-3">Price <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'price',array('class'=>'form-control','prepend'=>'$')); ?>
	<?php echo $form->error($model,'price');?>
	</div>
</div>	

		<div class="form-group ">
	<label for="Page_title" class="col-md-3">Quantity <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'quantity',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'quantity');?>
	</div>
</div>		

	<?php /*?>
	<?php
			
echo $form->select2Row ( $model, 'size_id', array (
					'asDropDownList' => false,
					'options' => array (
							'tags' => Size::getSize (),
							'width' => '100%' 
					)
					// 'tokenSeparators' => array(',',';'),
					/*
					 * 'ajax' => array(
					 * 'url' => CController::createUrl('size/ajaxsize'),
					 * 'dataType' => 'json',
					 * 'data' => 'js:function(term,page) { return {q: term, page_limit: 10, page: page}; }',
					 * 'results' => 'js:function(data,page) { return {results: data}; }',
					 * ),
					 */
					 
			/*) );
			?>
	

			

<div class="alert alert-success">Here you can type any option and press
	enter to add it . you can add multiple option like small-25cm ,
	medium-35cm, large-55cm ...</div> */ ?>
<div class="form-group ">
	<label for="Page_title" class="col-md-3">Color <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->dropDownList($model, 'color_id', GxHtml::listDataEx(Color::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'Select Category')); ?>
	<?php echo $form->error($model,'category_id');?>
	</div>
</div>



<div class="clearfix mar_top1"></div>

<div id="loader_image" class="mar_top2 offset2" style="display: none">
			<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/loader.gif');?>
			</div>







<div class="clearfix mar_top1"></div>



<div class="form-group">

<label class="col-sm-3 control-label"></label>
<div class="col-sm-9">
<p>You can upload Multiple images drag to Rearrange order.</p>
<!-- multiple_upload  -->
<div class=" multiple_upload ">

	<div class="clearfix mar_top1"></div>

	<div class="clearfix mar_top2"></div>
	<div id="imageview" style="display: none"></div>

	<div id="imgond11">
		<i class="fa fa-plus"></i> Upload Photos
	</div>

	<div id="imgpreestatus"></div>

	<div class="clearfix mar_top2"></div>

	<div id="uploadPreview"></div>

</div>
<!-- multiple_upload  -->
</div>

</div>









<hr>
<div class="row-fluid">
			<?php //echo CHtml::submitButton('Preview', array('name' => 'button1','class'=>'btn btn-primary','onclick'=>'check()')); ?>

			<?php echo CHtml::submitButton('Save And List', array('name' => 'button2','class'=>'btn btn-primary','onclick'=>'check()')); ?>

			<?php
			
$this->widget ( 'bootstrap.widgets.TbButton', array (
					'type' => 'primary',
					'label' => 'Cancel',
					'url' => Yii::app ()->createUrl ( 'product/admin' ),
					'htmlOptions' => array (
							'class' => '' 
					) 
			) );
			?>
				<hr>
</div>
<?php $this->endWidget(); ?>
			
<?php //$this->renderPartial('varient_product',array('variation' => new VarProduct()));
?>


<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</section>
	<!-- form code ends here -->
	<script>
$(document).ready(function()
{
var settings = {
	
   url: "<?php echo Yii::app()->createUrl('product/addImages');?>",
	method: "POST",
	allowedTypes:"jpg,png,gif,jpeg",
	fileName: "image_file",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		var url = '<?php echo Yii::app()->createUrl('product/pimages')?>'
	//	$("#imgpreestatus").html("<font color='green'>Upload is success</font>");
		$('#imageview').load(url);
		$('.ajax-file-upload-statusbar').css({"visibility":"hidden"});
		
	//	window.location.href = '<?php //echo Yii::app()->createUrl('color/index');?>';
		
	},
	onError: function(files,status,errMsg)
	{		
		$("#ondpreestatus").html("<font color='red'>Upload is Failed</font>");
	}
}

$("#imgond11").uploadFile(settings);

});
</script>