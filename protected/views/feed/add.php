<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Create'),
);
?>
   <div class="vd_content-section clearfix">
            <div class="row" id="form-basic">
              <div class="col-md-12">
                <div class="panel widget">
                 <div class="panel-heading vd_bg-yellow">
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
		'buttons' => 'create'));
?></div></div></div></div></div>