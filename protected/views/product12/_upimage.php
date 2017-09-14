
<div class="row-fluid emporium">

	<?php
	foreach($images as $image)
	{
		?>
	<div class="span3 emp_uploaded_images"
		id="<?php echo 'upimg_'.$image->id; ?>">

		<a class="cursor" onclick="deleteUpImage('<?php echo $image->id;?>')">
			<i class="fa fa-times-circle"></i>
		</a> <img
			src="<?php echo Yii::app()->createUrl('imageFile/thumb',array('file'=>$image->image_path,'id'=>$image->create_user_id))?>">
	</div>

	<?php } ?>

</div>

<script type="text/javascript">

function deleteUpImage(id)
{

	$.ajax({
		url: "<?php echo Yii::app()->createUrl('productImage/deleteImage/id')?>/"+id,
		
		}).done(function() {
			$('#upimg_'+id).css("display", "none");
		});
	}
</script>
