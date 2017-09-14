<!--  form code start here -->
<div class="form col-md-12">


<?php

$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
		'id' => 'var-product-form',
		'type' => 'horizontal',
		'enableClientValidation' => true,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>
	<p class="help-block" align="right">
		<?php echo Yii::t('app','fields with');?><span class="required">*</span> <?php echo Yii::t('app','are required');?>.
	</p>

	<?php //echo $form->errorSummary($model); ?>


<div class="row">
		<div class="col-md-6">
	
			

	 <?php echo $form->textFieldGroup($model,'sku',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		
	<?php //echo $form->dropDownListGroup($model, 'product_id', Html::listDataEx(Product::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>
	
	<?php echo $form->dropDownListGroup($model,'product_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Product::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		

	 <?php //echo $form->dropDownListGroup($model,'product_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Product::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
	<?php //echo $form->dropDownListGroup($model, 'color_id', Html::listDataEx(Color::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>	
		
<?php echo $form->dropDownListGroup($model,'color_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Color::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
	 <?php //echo $form->dropDownListGroup($model,'color_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Color::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		
<?php //echo $form->dropDownListGroup($model, 'size_id', Html::listDataEx(Size::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>		

	 <?php //echo $form->dropDownListGroup($model,'size_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Size::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
<?php echo $form->dropDownListGroup($model,'size_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Size::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>	 
		
	<?php //echo $form->dropDownListGroup($model, 'brand_id', Html::listDataEx(Brand::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>	

<?php echo $form->dropDownListGroup($model,'brand_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Brand::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>

	 <?php //echo $form->dropDownListGroup($model,'brand_id', array('widgetOptions'=>array('data'=>Html::listDataEx(Brand::model()->findAllAttributes(null, true)), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	 
		
	</div>
		<div class="col-md-6">

				

	 <?php echo $form->textFieldGroup($model,'quantity',array('class'=>'form-control')); ?>
	 
		
		

	 <?php echo $form->textFieldGroup($model,'price',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		
		

	 <?php //echo $form->textFieldGroup($model,'discount_price',array('class'=>'form-control','maxlength'=>255)); ?>
	 
		
	<?php //echo $form->dropDownListGroup($model, 'type_id', Html::listDataEx(Color::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>	

	 <?php //echo $form->dropDownListGroup($model,'type_id', $model->getTypeOptions(), array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>
	 
		
		
<?php //echo $form->dropDownListGroup($model, 'state_id', Html::listDataEx(Color::model()->findAllAttributes(null, true)),array('class'=>'form-control','empty'=>'--- SELECT ---')); ?>
	 <?php //echo $form->dropDownListGroup($model,'state_id', array('widgetOptions'=>array('data'=>$model->getStatusOptions(), 'htmlOptions'=>array('class'=>'input-large','prompt'=>'--- SELECT ---')))); ?>
	<?php //echo $form->dropDownListGroup($model,'state_id', $model->getStatusOptions(), array('class'=>'form-control','empty'=>'--- SELECT ---')); ?> 
			</div>
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

			<div id="imgond11">
				<i class="fa fa-plus"></i> <?php echo Yii::t('app','upload photos');?>
			</div>

			<div id="imgpreestatus"></div>

			<div class="clearfix mar_top2"></div>

			<div id="uploadPreview"></div>

		</div>
		<!-- multiple_upload  -->
	</div>

</div>


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
	
   url: "<?php echo Yii::app()->createUrl('varProduct/addVarientImages'); ?>",
	method: "POST",
	allowedTypes:"jpg,png,gif,jpeg",
	fileName: "image_file",
	multiple: false,
	onSuccess:function(files,data,xhr)
	{
		if( data.error != '' && data.error != 'undefined' ) {
			/* $(".ajax-file-upload-statusbar:first").remove();
			$("#imgpreestatus").html("<font color='red'>"+data.error+"</font>"); */
		} else {
			$('#loader_image').show();
			var url = '<?php echo Yii::app()->createUrl('varProduct/pimages')?>'
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

	

<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->