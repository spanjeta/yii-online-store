<?php

$this->breadcrumbs = array(
	RssFeed::label(2),
	Yii::t('app', 'Index'),
);
?>

<div class="page-header">
	<h1><?php echo Html::encode(RssFeed::label(2)); ?></h1>
</div>



<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>
<?php $this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

