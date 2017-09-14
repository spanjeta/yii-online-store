<?php include(dirname(__FILE__).'/../user/tabs.php');?>
<div class="tab-pane active tabs_inner">

<div class="row-fluid">
<?php

$this->breadcrumbs = array(
	Product::label(2),
	Yii::t('app', 'Index'),
);
?>

<div class="page-header span12">
<h3><?php echo GxHtml::encode(Product::label(2)); ?></h3>
</div>

<div class="">
<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

?>
</div>
</div><!------ ROW-Fluid ----->
</div>