
<?php $images  = SliderImage::model()->findAll();
$simages = array();
if($images)
{


	foreach($images as $image)
	{
		//echo 'images';exit;
		$simages[] = array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>$image->slider_image)), 'label'=>'Gupta sells', 'caption'=>'We believe in quality.');
	}


}   else {

	$simages[] =	array('image'=>'http://placehold.it/770x400&text=First+thumbnail', 'label'=>'First Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.');
	$simages[] =	array('image'=>'http://placehold.it/770x400&text=Second+thumbnail', 'label'=>'Second Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.');
	$simages[] =	array('image'=>'http://placehold.it/770x400&text=Third+thumbnail', 'label'=>'Third Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.');
	//	$images[] = array('image'=>Yii::app()->createAbsoluteUrl('station/download',array('file'=>'bream_bay.jpg')), 'label'=>'First Thumbnail label', 'caption'=>'Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.');
}
?>

<?php $this->widget('booster.widgets.TbCarousel', array(
		'items'=>$simages,
)); ?>


<div id="ajaxlist"></div>
<?php
$this->widget('zii.widgets.CListView', array(
 'id' => 'hello',
		'dataProvider'=>new CActiveDataProvider('Product'),
		'itemView'=>'_view',
		'itemsCssClass'=>'yiiMasonry-200', // Optional: Just theme, to use this theme you have to keep rowSelector => '.view', change this line if you have custom theme.
		'template' => '{items}{pager}',
		'pager' => array(
				'class' => 'ext.yiiMasonry.yiiMasonry',
				'rowSelector'=>'.view', // row class
				'listViewId' => 'hello', // Container id
		)
)); 
?>

