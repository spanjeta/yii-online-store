<?php 

$simages = array();
if($images)
{


	foreach($images as $image)
	{
		//echo 'images';exit;
		$simages[] = array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>$image->slider_image,'id'=>$image->create_user_id)), 'label'=>'', 'caption'=>'');
	}


}   else {

	$simages[] =	array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>'banner-1.jpg')), 'label'=>'', 'caption'=>'');
	$simages[] =	array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>'banner-2.jpg')), '', 'caption'=>'');
}
?>

<?php $this->widget('booster.widgets.TbCarousel', array(
		'items'=>$simages,
)); ?>