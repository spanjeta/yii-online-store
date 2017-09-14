<?php include(dirname(__FILE__).'/../user/tabs.php');?>
<?php

$this->breadcrumbs = array(
	Review::label(2),
	Yii::t('app', 'Index'),
);
?>

<div class="page-header">
<h1><?php echo Html::encode(Review::label(2)); ?></h1>
</div>

<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

