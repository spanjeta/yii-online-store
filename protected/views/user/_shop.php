<!--  form code start here -->
<div class="clearfix mar_top5"></div>




<div class="form well span6 offset3 login_signup">
	<h2>Step 3</h2>

	<h3>SignUp Business User Shop Info</h3>

	<hr>

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'user-form',
			'type'=>'',
	//	'action'=>$this->createUrl('api/user/signupBusiness2'),
	//	'enableAjaxValidation' => true,
			'enableClientValidation'=>true,
			'clientOptions'=>array(
        'validateOnSubmit'=>true,

	),
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<?php echo $form->textFieldGroup($company,'shop_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'shop_code',array('class'=>'span6','maxlength'=>128,'hint'=>'Please Enter
			5 digit code for your shop it will be added before your product code')); ?>

	<?php echo $form->textFieldGroup($company,'shop_slogan',array('class'=>'span6','maxlength'=>128)); ?>

	<div id="uploadPreview1"></div>

	<?php echo $form->fileFieldGroup($company,'image_file',array('class'=>'span6','maxlength'=>128)); ?>
	<div class="clearfix mar_top2"></div>
	<div id="uploadPreview"></div>
	<?php echo $form->fileFieldGroup($company,'logo_file',array('class'=>'span6','maxlength'=>128)); ?>

	<?php //echo $form->textAreaRow($company,'about_shop',array('class'=>'span6','maxlength'=>128)); ?>
	<?php //echo $form->textAreaRow($company,'terms',array('class'=>'span6','maxlength'=>128)); ?>
	<?php //echo $form->textAreaRow($company,'delivery_info',array('class'=>'span6','maxlength'=>128)); ?>
	<?php
	echo  $form->html5EditorRow($company,'about_shop', array('width'=>'90%','height'=>'50%', 'options'=>
	array(
		'color'=>false,
		'image'=>false,
		'emphasis' => true,
		'lists' => false,
		'link' => false,
	)));

	echo  $form->html5EditorRow($company,'terms', array('width'=>'90%','height'=>'50%', 'options'=>
	array(
		'color'=>false,
		'image'=>false,
		'emphasis' => true,
		'lists' => false,
		'link' => false,
	)));

	echo  $form->html5EditorRow($company,'delivery_info', array('width'=>'90%','height'=>'50%', 'options'=>
	array(
		'color'=>false,
		'image'=>false,
		'emphasis' => true,
		'lists' => false,
		'link' => false,
	)));

	?>




	<?php echo $form->textFieldGroup($company,'email_contact',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'contact_no',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'web_address',array('class'=>'span6','maxlength'=>128)); ?>

	<div class="alert alert-success">Please Add valid address in facebook,
		twitter and instagram Like https://www.facebook.com/bemployable and
		click below link to check its accessibility.</div>

		<?php echo $form->textFieldGroup($company,'facebook',array('class'=>'span6','maxlength'=>128)); ?>

		<?php echo CHtml::link('Check Facebook','#',array('onclick'=>'gomedia(1)','class'=>'pull-right'))?>

		<?php echo $form->textFieldGroup($company,'twitter',array('class'=>'span6','maxlength'=>128)); ?>
		<?php echo CHtml::link('Check Twitter','#',array('onclick'=>'gomedia(2)','class'=>'pull-right'))?>

		<?php echo $form->textFieldGroup($company,'instagram',array('class'=>'span6','maxlength'=>128)); ?>
		<?php echo CHtml::link('Check Instragram','#',array('onclick'=>'gomedia()','class'=>'pull-right'))?>

	<script>
	function gomedia(type){

		var type = parseInt(type);
		if(type == 1){
var fbook = $('#Company_facebook').val();

window.open(fbook,'_blank');
			}

		else if(type == 2) {
			var fbook = $('#Company_twitter').val();

			window.open(fbook,'_blank');
		}
		else {
			var instagram = $('#Company_instagram').val();

			window.open(fbook,'_blank')
		}
	}
	
	</script>



	<div class="clearfix mar_top1"></div>

	<div id="loader_image" class="mar_top2 offset2" style="display: none">
	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/loader.gif');?>
	</div>
	<div class="hint slogan">
		<small>Front Page Slide Show.</small>
	</div>
	<div class=" multiple_upload row-fluid pull-left ">

		<div class="clearfix mar_top1"></div>

		<div id="imgond11">
			<i class="fa fa-plus"></i> Upload Slider
		</div>

		<div id="imgpreestatus"></div>

		<div class="clearfix mar_top2"></div>

		<div id="imageview" style="display: none"></div>

	</div>
	<div class="clearfix mar_top2"></div>


	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Save',
				'htmlOptions'=>array('class'=>'row-fluid'),
	)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->

<script>
$(document).ready(function()
{
var settings = {
   url: "<?php echo Yii::app()->createUrl('sliderImage/addImage');?>",
	method: "POST",
	allowedTypes:"jpg,png,gif",
	fileName: "image_file",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$('#loader_image').show();
		var url = '<?php echo Yii::app()->createUrl('sliderImage/slImages')?>'
//		$('.ajax-file-upload-statusbar').css({"visibility":"hidden"});
		$("#imgpreestatus").html("<font color='green'>Successfully Uploaded</font>");
		$('#imageview').load(url,function(data,response){

		//	console.log(response);
	if(response == 'success')
			{
				  $("#imageview").show(20, function() {
						$('#loader_image').hide();
					    // Animation complete
					  });
			}
			});

	},
	onError: function(files,status,errMsg)
	{		
		$("#ondpreestatus").html("<font color='red'>Upload is Failed</font>");
	}
}

$("#imgond11").uploadFile(settings);

});
</script>



<script>

$('document').ready(function(){
		
		$("#Company_logo_file").change(function (e) {
		    if(this.disabled) return alert('File upload not supported!');
		    var F = this.files;
		    if(F && F[0]) {
			    for(var i=0; i<F.length; i++) 
				    {
				    	readImage( F[0] );
				    }
			    }
		});
});

function readImage(file) {

    var reader = new FileReader();
    var image  = new Image();

    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
           // $('#uploadPreview').html('');
        
            $('#uploadPreview').html('<img src="'+ this.src +'"> ');
       
        };
        image.onerror= function() {
            alert('Invalid file type: '+ file.type);
        };      
    };

}


$('document').ready(function(){
	
	$("#Company_image_file").change(function (e) {
	    if(this.disabled) return alert('File upload not supported!');
	    var F = this.files;
	    if(F && F[0]) {
		    for(var i=0; i<F.length; i++) 
			    {
			    	readImage1( F[0] );
			    }
		    }
	});
});

function readImage1(file) {

var reader = new FileReader();
var image  = new Image();

reader.readAsDataURL(file);  
reader.onload = function(_file) {
    image.src    = _file.target.result;              // url.createObjectURL(file);
    image.onload = function() {
        var w = this.width,
            h = this.height,
            t = file.type,                           // ext only: // file.type.split('/')[1],
            n = file.name,
            s = ~~(file.size/1024) +'KB';
       // $('#uploadPreview').html('');
        $('#uploadPreview1').html('<img src="'+ this.src +'"> ');
   
    };
    image.onerror= function() {
        alert('Invalid file type: '+ file.type);
    };      
};

}
</script>
