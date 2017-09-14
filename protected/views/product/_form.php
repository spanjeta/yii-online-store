<!--  form code start here -->



<div class="clearfix mar_top2"></div>

<?php
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
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
	<?php //echo $form->errorSummary($model); ?>

		<?php echo $form->dropDownListGroup( $model,'type_id',
				array('widgetOptions'=>array(
						'data'=>$model->getTypeOptions(), 
						array('class'=>'form-control','prompt'=>'--- SELECT ---')))); 
		?>
	<?php echo $form->error($model,'type_id');?>

<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','title');?> <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->textField($model,'title',array('class'=>'form-control','maxlength'=>256)); ?>
	<?php echo $form->error($model,'title');?>
	</div>
</div>

<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','sku');?> <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->textField($model,'sku',array('class'=>'form-control','maxlength'=>256)); ?>
	<?php echo $form->error($model,'sku');?>
	</div>
</div>

<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','category');?> <span
		class="required">*</span></label>
	<div class="col-md-9">
	<?php $category = new Category();?>
		<?php
		
		echo $form->dropDownList ( $model, 'category_id', Html::listDataEx ( $category->getCategories () ), array (
				'class' => 'form-control',
				'id' => 'category',
				'empty' => 'Select Category' 
		
		) );
		?>
	<?php echo $form->error($model,'category_id');?>
	</div>
</div>


<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','sub category');?> <span
		class="required">*</span></label>
	<div class="col-md-9">
	<?php
	/*
	 * $category = new Category ();
	 * $mainCategories = $category->getCategories ();
	 * if ($mainCategories != null) {
	 */
	?>
		<?php
		
		echo $form->dropDownList ( $model, 'category_id', array (
				'class' => 'form-control',
				'display' => 'none',
				'empty' => 'Select Sub Category' 
		) );
		?>

	
	<?php echo $form->error($model,'category_id');?>

	<?php //}?>
	</div>
</div>

<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','brand');?> <span class="required">*</span></label>
	<div class="col-md-9">
	<?php $brand = new Brand();?>
		<?php
		
		echo $form->dropDownList ( $model, 'brand_id', Html::listDataEx ( $brand->getBrand () ), array (
				'class' => 'form-control',
				'empty' => 'Select Brand' 
		
		) );
		?>
	<?php echo $form->error($model,'category_id');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','small description');?> <span
		class="required"></span></label>
	<div class="col-md-9">
	<?php echo $form->textArea($model,'description',array('class'=>'form-control')); ?>
	
	<?php echo $form->error($model,'description');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','large description');?><span
		class="required"></span></label>
	<div class="col-md-9">
	<?php echo $form->textArea($model,'large_description',array('class'=>'form-control')); ?>
	
	<?php echo $form->error($model,'large_description');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','price');?> <span class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'price',array('class'=>'form-control','prepend'=>'$')); ?>
	<?php echo $form->error($model,'price');?>
	</div>
</div>

<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','quantity');?><span
		class="required">*</span></label>
	<div class="col-md-9">
	<?php echo $form->textField($model,'quantity',array('class'=>'form-control')); ?>
	<?php echo $form->error($model,'quantity');?>
	</div>
</div>

<?php
/*
 * ?>
 * <?php
 *
 * echo $form->select2Row ( $model, 'size_id', array (
 * 'asDropDownList' => false,
 * 'options' => array (
 * 'tags' => Size::getSize (),
 * 'width' => '100%'
 * )
 * // 'tokenSeparators' => array(',',';'),
 * /*
 * 'ajax' => array(
 * 'url' => CController::createUrl('size/ajaxsize'),
 * 'dataType' => 'json',
 * 'data' => 'js:function(term,page) { return {q: term, page_limit: 10, page: page}; }',
 * 'results' => 'js:function(data,page) { return {results: data}; }',
 * ),
 */

/*
 * ) );
 * ?>
 *
 *
 *
 *
 * <div class="alert alert-success">Here you can type any option and press
 * enter to add it . you can add multiple option like small-25cm ,
 * medium-35cm, large-55cm ...</div>
 */
?>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','color');?> <span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->dropDownList($model, 'color_id', Html::listDataEx(Color::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'Select Color')); ?>
	<?php echo $form->error($model,'color_id');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','discount');?> %<span
		class="required"></span></label>
	<div class="col-md-9">
		<?php echo $form->checkBox($model, 'is_discount'); ?>
		
		<?php //echo $form->checkBox($model,'is_discount',array('value'=>1,'uncheckValue'=>0,'checked'=>($model->id=="")?true:$model->label_name),'style'=>'margin-top:7px;')); ?>
	<?php echo $form->error($model,'is_discount');?>
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"> <span class="required"></span></label>
	<div class="col-md-9">

		<!-- 
	<input type="text" id="discount-box" maxlength="2"> -->
	
		<?php echo $form->hiddenField($model, 'discount_price', Html::listDataEx(Product::model()->findAllAttributes(null, true)),array('class'=>'form-control','placeholder'=>'Placeholder content')); ?>
	<?php echo $form->error($model,'discount_price');?>
	
	
		<?php echo $form->textField($model, 'discount_percentage', Html::listDataEx(Product::model()->findAllAttributes(null, true)),array('class'=>'form-control','placeholder'=>'Placeholder content')); ?>
	<?php echo $form->error($model,'discount_percentage');?>
	
	</div>
</div>
<div class="form-group ">
	<label for="Page_title" class="col-md-3"><?php echo Yii::t('app','size');?><span class="required">*</span></label>
	<div class="col-md-9">
		<?php echo $form->dropDownList($model, 'size_id', Html::listDataEx(Size::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'Select Size')); ?>
	<?php echo $form->error($model,'size_id');?>
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
		<p><?php echo Yii::t('app','you can upload multiple images drag to rearrange order');?>.</p>
		<!-- multiple_upload  -->
		<div class=" multiple_upload ">

			<div class="clearfix mar_top1"></div>

			<div class="clearfix mar_top2"></div>
			<div id="imageview" style="display: none"></div>

			<div id="imgond11" >
				<i class="fa fa-plus"></i><?php echo Yii::t('app','upload photos');?> 
			</div>

			<div id="imgpreestatus"></div>

			<div class="clearfix mar_top2"></div>

			<div id="uploadPreview"></div>

		</div>
		<!-- multiple_upload  -->
	</div>

</div>

<hr>
<div class="row-fluid text-center">
			<?php echo CHtml::submitButton('Preview', array('name' => 'button1','class'=>'btn btn-primary','onclick'=>'check()')); ?>

			<?php echo CHtml::submitButton('Save And List', array('name' => 'button2','class'=>'btn btn-primary','onclick'=>'check()')); ?>

			<?php
			
			$this->widget ( 'booster.widgets.TbButton', array (
					// 'type' => 'primary',
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



<!-- form code ends here -->
<script>

 function check()
{
	<?php
	/*
	 * ?>
	 * var postage = $.ajax({
	 * url : '<?php echo Yii::app()->createUrl('paypalInfo/check') ?>',
	 *
	 * });
	 * postage.done(function(data){
	 * alert(data);
	 * console.log(data);
	 * if(data == 'OK'){
	 * var form = document.getElementById('product-form')
	 * form.submit();
	 * }
	 * else{
	 * alert ('Please first add your postage and payment method before adding the product');
	 * }
	 * });
	 * <?php
	 */
	?>
}
	
$('#brand').click(function(){
$('#brand_tag').slideToggle();
	
});
	
$(document).ready(function()
{
var settings = {
// 	onSelect:function(files)
// 	{
// 	    return false;
// 	},
	
   url: "<?php echo Yii::app()->createUrl('product/addImages'); ?>",
	method: "POST",
	allowedTypes:"jpg,png,gif,jpeg",
	fileName: "image_file",
	multiple: false,
	onSuccess:function(files,data,xhr)
	{
		if( data.error != '' && data.error != 'undefined' ) {
			$(".ajax-file-upload-statusbar:first").remove();
			$("#imgpreestatus").html("<font color='red'>"+data.error+"</font>");
		} else {
			$('#loader_image').show();
			var url = '<?php echo Yii::app()->createUrl('product/pimages')?>'
			$("#imgpreestatus").html("<font color='green'>Successfully Uploaded</font>");
			$('#imageview').load(url,function(data,response) {
				if(response.success == 'success')
				{
				  $("#imageview").show(20, function() {
					$('#loader_image').hide();
				    // Animation complete
				  });
				}
			});
		}
	},
	onError: function(files,status,errMsg)
	{		
		$("#ondpreestatus").html("<font color='red'>Upload is Failed</font>");
	}
}

$("#imgond11").uploadFile(settings);

});

$("#category").change(function() {
	var catid = $("#category").val();
	
	var url = "<?php echo Yii::app()->createAbsoluteUrl("category/getSubCategory")?>"+"?cat_id="+catid;
	
	var data = $('#category').serialize();
	$.ajax({
		url : url,
		type:'POST',
		data:data,
		dataType:'json',
		}).success(function(response){
			//console.log(response);
    		if(response.status == 'OK'){
    			var options = ''

    				$.each(response.data, function(index, value) {
						options += "<option value=" + index + ">" + value + "</option>";
					});

    			$('#Product_category_id').empty();
				$(options).appendTo('#Product_category_id');
            } 
	});
});



$('#apply ').click(function()
{
	
	
	applypromo($('#promo-box').val());
});



$("#Product_discount_percentage").hide();
$('#Product_is_discount').click(function() {
	   if($('#Product_is_discount').is(':checked')) { 


			$("#Product_discount_percentage").show();
			


		    }else
		    {$("#Product_discount_percentage").hide();

			    
			    }
	});

</script>
<script>

$('#Product_discount_percentage').change(function()
{
	
	var percentage = $('#Product_discount_percentage').val();
	var totalPrice = $('#Product_price').val();
	var discountedAmount;
	var discount;
	discount = ( totalPrice *  percentage)/100;
	discountedAmount = totalPrice - discount;

	
	$('#Product_discount_price').val(discountedAmount);
	//$('#Product_discount_percentage').val(percentage);
	
	
});






</script>


