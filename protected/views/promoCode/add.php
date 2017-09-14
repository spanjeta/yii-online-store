<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Add'),
);
?>
<div class="content-header">
	<h1><?php echo Yii::t('app','manage') . ' : ' . Html::encode(Yii::t('app',$model->label(2))); ?></h1>
</div>
  <section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plus-circle"></i> </span> <?php echo Yii::t('app', 'Add') . ' ' . Html::encode($model->label()); ?> 
                    <?php   $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	));
?>
                    </h3>
                  </div>
 <div class="panel-body">

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'Add'));
?></div></div></div></div></section>