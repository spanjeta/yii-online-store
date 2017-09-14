
<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
		
	Yii::t('app', 'Manage'),
);

?>
<div class="content-header">
	<h1><?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?></h1>
</div>
<section class="content">
<div class="vd_content-section clearfix">
              <div class="row">
              <div class="col-md-12">
                <div class="panel widget box box-primary">
 <div class="panel-heading vd_bg-yellow">
<h3 class="panel-title"> <span class="menu-icon"> 
<?php   /* $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	)); */
?>
<?php
	
$this->widget ( 'booster.widgets.TbMenu', array (
			'items' => $this->actions,
			'type' => 'success',
			'htmlOptions' => array (
					'class' => 'pull-right' 
			) 
	) );
	?>
</h3>
</div>
<div class="clearfix"></div>
 <div class="panel-body  table-responsive">


<?php $this->renderPartial('_grid', array(
		'model'=>$model,
		
));?></div></div></div></div></div>
</section>
