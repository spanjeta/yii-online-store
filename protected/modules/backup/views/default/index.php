<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
);?>
				
<section class="content">				
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
<?php   $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	));
?>



<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="alert alert-success">
<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<h1> Manage database backup files</h1>

<?php $this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));
?>
</div></div></div></div></section>