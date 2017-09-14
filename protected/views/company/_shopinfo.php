


<hr>
<div class="form shop_update_account" id="shop_update_account">

	<h3>Update Shop Info</h3>

	<hr>

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'shop-form-update',
			'type'=>'horizontal',
	//	'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<?php echo $form->textFieldGroup($company,'shop_name',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'shop_code',array('class'=>'span6','maxlength'=>128,'readOnly'=>true
	)); ?>

	<?php echo $form->textFieldGroup($company,'shop_slogan',array('class'=>'span6','maxlength'=>128)); ?>
	<div id="uploadPreview1">
		<label for="" class="control-label required">&nbsp;</label>

		<div class="controls">
		<?php echo isset($company->image_file) && !empty($company->image_file) ? CHtml::image(Yii::app()->createUrl('company/thumb',
		array('file'=>$company->image_file,'id'=>$company->create_user_id))) :
		CHtml::image(Yii::app()->createUrl('company/download',
		array('file'=>'shop.png')))
		;
		?>
		</div>
	</div>
	<div class="clearfix mar_top2"></div>
	<?php echo $form->fileFieldGroup($company,'image_file',array('class'=>'span6','maxlength'=>128)); ?>
	<div class="clearfix mar_top2"></div>
	<div id="uploadPreview">
		<label for="" class="control-label required">&nbsp;</label>
		<div class="controls">
		<?php echo isset($company->logo_file) && !empty($company->logo_file) ? CHtml::image(Yii::app()->createUrl('company/thumb',
		array('file'=>$company->logo_file,'id'=>$company->create_user_id))) :
		CHtml::image(Yii::app()->createUrl('company/download',
		array('file'=>'shop_logo.png')))
		;
		?>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php echo $form->fileFieldGroup($company,'logo_file',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($company,'about_shop',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($company,'terms',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($company,'delivery_info',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'email_contact',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'contact_no',array('class'=>'span6','maxlength'=>128)); ?>

	<?php echo $form->textFieldGroup($company,'web_address',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'facebook',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'twitter',array('class'=>'span6','maxlength'=>128)); ?>
	<?php echo $form->textFieldGroup($company,'instagram',array('class'=>'span6','maxlength'=>128)); ?>

	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Update',
				'htmlOptions'=>array('class'=>'span6'),
	)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<!-- form code ends here -->

<script>

$('document').ready(function(){



	$("#shop-form-update").submit(function(event) {
		event.preventDefault();
		 var values = new FormData($(this)[0]);
		//var values = serialize(this);
		//var values = 's';     
		      $.ajax({
			        url: "<?php echo Yii::app()->createUrl("company/update")?>",
			        type: "POST",
			        data: values,
			        processData: false, 
			        contentType: false,

			        success: function(data,response){
				        if( response == 'success' )
				        {
							$('#shop_update_account').html(data)
			   //     alert('save');
				        	 
				        }
				        else{
				        	 //  alert('Not save');
				        }
							          			          	
			        },
			        
			    });
	   });

	
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
           //  $('#uploadPreview').addClass('span3')
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
