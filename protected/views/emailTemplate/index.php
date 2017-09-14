<?php

$this->breadcrumbs = array(
	EmailTemplate::label(2),
	Yii::t('app', 'index'),
);
?><section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
                 <div class="panel-heading vd_bg-yellow">

<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-large"></i> </span> <?php echo Html::encode(Yii::t('app',$model->label(2))); ?>
<?php   $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	));
?>
</h3>
</div>
  
 <div class="panel-body  table-responsive">


<?php $this->renderPartial('_grid', array(
		'model'=>$model,
));?>
</div></div></div></div></section>

