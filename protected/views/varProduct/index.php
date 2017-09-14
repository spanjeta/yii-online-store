<?php

$this->breadcrumbs = array(
	VarProduct::label(2),
	Yii::t('app', 'Index'),
);
?>
<div class="content-header">
	<h1><?php echo Yii::t('app','manage') . ' : ' . Html::encode(Yii::t('app',$model->label(2))); ?></h1>
</div>
<div class="content">
              <div class="clearfix">
              <div class="row">
              <div class="col-md-12">
                <div class="panel widget box box-primary">
 <div class="panel-heading vd_bg-yellow">
<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-large"></i> </span><?php echo Html::encode(VarProduct::label(2)); ?>
<?php  /* $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	));*/
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
  
 <div class="panel-body   var-products">

<div class="table-responsive">
<?php $this->renderPartial('_grid', array(
		'model'=>$model,
));?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

