<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Add'),
);

?>

   <section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-plus-circle"></i> </span> <?php echo Yii::t('app', 'Add') . ' ' . Html::encode($model->label()); ?> 
                    <?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?>
                    </h3>
                  </div>
 <div class="panel-body">

<?php 
if(!empty($error)){?>
<div class = "alert alert-error">
	<div class="flash-error">
		<?php echo $error;?>
	</div>
</div>
	
<?php }?>
<?php

$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'Add'));
?></div></div></div></div></section>