<link href="<?php echo Yii::app()->theme->baseUrl?>/css/uploadfile.css"
	rel="stylesheet">

<script
	src="<?php echo Yii::app()->theme->baseUrl?>/js/jquery.uploadfile.min.js"></script>
<div class="clearfix mar_top2"></div>





<div id="imgsld11">Upload Your Slider Image</div>

<div id="imgsldstatus"></div>

<script>
$(document).ready(function()
{
var settings = {
	
   url: "<?php echo Yii::app()->createUrl('sliderImage/add');?>",
	method: "POST",
	allowedTypes:"jpg,png,gif",
	fileName: "image_path",
	multiple: true,
	onSuccess:function(files,data,xhr)
	{
		$("#imgsldstatus").html("<font color='green'>Upload is success</font>");
		$('#sld_form').hide();
		var url = "<?php echo Yii::app()->createUrl('sliderImage/ajaxIndex');?>";	
		$('#sld_list').load(url,function(data,response) {
			if(response == 'success')
				$('#sld_list').show(1000);
			});

	},
	onError: function(files,status,errMsg)
	{		
		$("#imgsldstatus").html("<font color='red'>Upload is Failed</font>");
	}
}

$("#imgsld11").uploadFile(settings);

});

</script>



