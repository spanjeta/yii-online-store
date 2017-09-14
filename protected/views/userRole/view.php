<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>

<div class="page-header">
<h1><?php echo Html::encode(Html::valueEx($model)); ?></h1>
</div>

<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'title',
'description',
	),
)); ?>

<?php
 $this->StartPanel(); ?>
<?php  $this->AddPanel($model->getRelationLabel('users'), $model->getRelatedDataProvider('users'),	'users','user');?>
<?php  $this->EndPanel(); ?>

<?php   $this->widget('CommentPortlet', array(
	'model' => $model,
));
?>