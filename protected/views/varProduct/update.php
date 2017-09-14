<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
		Html::valueEx($model) => array('view', 'id' => ActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);
?>
  <div class="vd_content-section clearfix">
            <div class="row" id="form-basic">
              <div class="col-md-12">
                <div class="panel widget">
                
    <div class="panel-heading vd_bg-yellow">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-edit"></i> </span> <?php echo Yii::t('app', 'Update') . ' ' . Html::encode($model->label()) . ' : ' . Html::encode(Html::valueEx($model)); ?>
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
                  
            <div class="panel-body">       



<?php
$this->renderPartial('_form', array(
		'model' => $model));
?></div></div></div></div></div>