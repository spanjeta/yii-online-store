<?php include ('top.php');?>
<div class="clearfix"></div>


<div class="clearfix"></div>


<div class="row-fluid masnory_inner">

	<div id="custom_masnory_com" class="custom_masnory nopadding_masnory"
		style="display: none">

		<?php //include_once(dirname(__FILE__).'/../site/_pview.php');?>
		<?php //$this->renderPartial('/site/_pview',array('products'=>$products));?>

		<div id="masonry-meta-comment-wrapper-380"></div>
	</div>
</div>

<div id="loader_image" class="mar_top10 offset3">
<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/loader.gif');?>
</div>

<script>
$(document).ready(function() { 

		var id = '<?php echo $model->id;?>';
		var url = "<?php echo Yii::app()->createUrl('company/ajaxIndex/id');?>/"+id;	
		$('#custom_masnory_com').load(url,function(data,response) {
				if(response == 'success')
				{
					$('#loader_image').hide();
					  $("#custom_masnory_com").show(20, function() {
						    // Animation complete
						  });
				}
		//	$('#custom_masnory_com').fade(5000);
			});

});
</script>

