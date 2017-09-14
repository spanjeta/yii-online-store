<?php include(dirname(__FILE__).'/../user/tabs.php');?>

<div class="clearfix mar_top2"></div>

<?php /*
<div id="home" class="tab-pane active tabs_inner">




<div class="row-fluid">
<div class="span2">
<input type="text" class="span12" placeholder="Keyword">
</div>
<div class="span2">
<select class="span12"><option>Feild</option>
<option>Feild</option>
</select>
</div>

<div class="span3">
<select class="span12"><option>Status</option>
<option>Feild</option>
</select>
</div>


<div class="span3">
<select class="span12"><option>Discount</option>
<option>Feild</option>
</select>
</div>


<div class="span2">
<button class="btn btn-primary" type="button">Search</button>
</div>


</div>

<div class="clearfix"></div>
<hr>

<div class="row-fluid">


<div class="span2">
<button class="btn btn-primary span12" type="button">+ Add Photos</button>
</div>

<div class="span2">
<label class="label"></label><select class="span12"><option>Operation:</option>
<option>Feild</option>
</select>
</div>

<div class="span2">
<button class="btn btn-primary" type="button">Execute</button>
</div>




</div>


<div class="clearfix"></div>

<hr>


<div class="row-fluid emporium">

<?php
foreach($empimages as $image)
{

//echo CHtml::image(Yii::app()->createUrl('imageFile/downloadById',array('file'=>$image->image_path,'id'=>Yii::app()->user->id)));

?>
<div class="span3">
<input type="checkbox" name="checkboxlist_emp" class="checkbox"
value="<?php echo $image->id; ?>"/>
<img src="<?php echo Yii::app()->createUrl('imageFile/download',array('file'=>$image->image_file))?>">
</div>

<?php }?>

</div>

</div>

<script>

$(document).ready(function() {

		$('#imgchk').click(function () {

				var checkedValues = $('input:checkbox:checked').map(function() {
		    return this.value;
						}).get();
				//   alert(checkedValues);
				$.ajax({
						type: "POST",
						data: {checkedValues:checkedValues},
		    url: "<?php echo Yii::app()->createUrl('imageFile/remove')?>",

						success: function(msg){
						//   alert( "Data Saved: " + msg );
						// some suff there
						}
						});

				});

		});

</script>

 */?>
<?php 
$products = Product::getproducts();

//$autocomplete_list = array('Anna'=>'heell','Eric'=>'heell','Kevin'=>'heell','Zenith'=>'heell','James'=>'heell');
/* $already_tagged = array(array('id'=>1,'label'=>'Uncle jack','width'=>50,'height'=>50,'top'=>14,'left'=>115),
array('id'=>2,'label'=>'Baby john','width'=>100,'height'=>140,'top'=>19,'left'=>395)); */

$this->widget('application.extensions.phototag.PhotoTag', array(
 	'imageid' => 'img1', // required if you tag more than one images
	'imageurl' => Yii::app()->baseUrl.'/images/image-tag.jpg', // required (actual image url)
	'height' => '100', // optional (default height of tag box)
	'maxHeight' => '150', // optional (maximum height of tag box)
	'width' => '150',// optional (default width of tag box)
	'maxWidth' => '300', // optional (maximum width of tag box)
	'showTag' => 'hover', //optional ('always','hover')
	'canTag' => 'true', //optional ('true','false')
	'showLabels' => 'false', //optional ('true','false')
	'canDelete' => 'false', //optional ('true','false')
    'item_id'=>'2',
 		'save' => CController::createUrl('emporium/ajaxSaveTag'), //optional (save callback url)
 		'remove' => CController::createUrl('emporium/ajaxRemoveTag'), //optional (delete callback url)
 	//	'autoComplete' => CController::createUrl('emporium/getProducts'), //optional (array contains data for autoComplete list)
 	
		'autoComplete' => Product::getproducts(),
 // 'autoComplete' => Html::listDataEx(Product::model()->findAllAttributes(null, true)),

'defaultTags' => $already_tagged //optional (array contains already tagged users)
 ));?>
