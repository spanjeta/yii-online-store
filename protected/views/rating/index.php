<?php

$this->breadcrumbs = array(
	Rating::label(2),
	Yii::t('app', 'Index'),
);
?><div class="container">
              <div class="vd_content-section clearfix">
              <div class="row">
              <div class="col-md-12">
                <div class="panel widget">
 <div class="panel-heading vd_bg-yellow">
<h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-th-large"></i> </span><?php echo Html::encode(Rating::label(2)); ?>
<?php   $this->widget('booster.widgets.TbMenu', array(
		'items'=>$this->actions,
		'type'=>'success',
		'htmlOptions'=>array('class'=> 'pull-right'),
));
?>
</h3>
</div>
  
 <div class="panel-body  table-responsive">


<?php $this->renderPartial('_grid', array(
		'model'=>$model,
));?>
</div> </div></div></div></div></div>

