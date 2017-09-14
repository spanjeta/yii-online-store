<?php
Yii::app()->clientscript->scriptMap['jquery.js'] = false;
Yii::app()->clientscript->scriptMap['bootstrap.bootbox.min.js'] = false;
Yii::app()->clientscript->scriptMap['bootstrap.notify.js'] = false;
Yii::app()->clientscript->scriptMap['bootstrap.js'] = false;
?>

<div class="row-fluid add_slide">
<?php /*?>
<?php
foreach($images as $image) 	{ ?>

<div class="span3 emp_uploaded_images" id="<?php echo 'img_'.$image->id; ?>">
<a class="cursor" onclick="deleteImage('<?php echo $image->id;?>')"> <i
class="fa fa-times-circle"></i>
</a> <img
src="<?php echo Yii::app()->createUrl('imageFile/thumb',array('file'=>$image->image_path,'id'=>$image->create_user_id))?>">
</div>

<?php } ?>
*/?>

<?php

if($images)
{
	foreach ($images as $sliderimage)
	{
		$sortableItems[$sliderimage->id] =

		'<a class="cursor" onclick="deleteImage('.$sliderimage->id.')"> <i  class="fa fa-times-circle" ></i> </a>'.
		CHtml::image(Yii::app()->createUrl('sliderImage/thumb',array('file'=>$sliderimage->image_path,'id'=>$sliderimage->create_user_id)),'alter',array('class'=>'listimage'));
		//			$delete = '<a class="cursor" onclick="deleteSlider({id})"> <i  class="fa fa-times-circle" ></i> </a>';
	}

	$this->widget('zii.widgets.jui.CJuiSortable',array(
			'id'=>'short',
			'items'=> $sortableItems,
	//	'itemTemplate'=>'<li id="abc_{id}" class="ui-state-default">{content}'.$delete.'</li>',
	// additional javascript options for the JUI Sortable plugin
			'options'=>array(

			'update'=>"js:function(){
					$.ajax({
					type: 'POST',
					url: '{$this->createUrl('product/sortitems')}',
					data: {'items[]':$(this).sortable('toArray')},
			});
		}",

					'delay'=>'300',
	),
	));
}

?>

</div>

</hr>


<script type="text/javascript">

function deleteImage(id)
{
	//alert(id);
var img = id;
	$.ajax({
		url: "<?php echo Yii::app()->createUrl('product/deleteImage/id')?>/"+id,
		
		}).done(function() {
			$('#'+id).css("display", "none");
		});
	}
</script>

