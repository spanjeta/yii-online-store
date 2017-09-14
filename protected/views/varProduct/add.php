<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Add'),
);
?>
<section class="content-header">
	<h1><?php echo Yii::t('app', 'Add') . ' ' . Html::encode($model->label()); ?> </h1>
</section>
<section class="content">
   <div class="vd_content-section clearfix">
            <div class="row" id="form-basic">
              <div class="col-md-12">
              <?php if(Yii::app()->user->hasFlash('error')){?>
		<div class="alert alert-danger">
		<?=Yii::app()->user->getFlash('error')?>
		</div>
	<?php }?>
                <div class="panel widget box box-primary">
                 <div class="panel-heading vd_bg-yellow">
                 	<div class="col-sm-12">
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
                  </div>
 <div class="panel-body">

<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'Add'));
?></div></div></div></div></div>
</section>