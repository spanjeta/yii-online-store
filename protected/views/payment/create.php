<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
		Yii::t('thescout','Payments')=>array('index'),
		Yii::t('thescout','Create'),
);

$this->menu=array(
		array('label'=>Yii::t('thescout','List Payment'), 'url'=>array('index')),
		//array('label'=>'Manage Payment', 'url'=>array('admin')),
);
?>
<?php if(Yii::app()->user->hasFlash('expire')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('expire'); ?>
</div>
<?php else :?>
<div class="form well">
	<b>Application :</b>THESCOUT <br /> <strong><i><?php echo Yii::t('thescout','You are most Welcome on our site if you want to purchase this Application than click on below Link:');?>
	</i> </strong>
	<div class="row">
		<div class="span3">
			<?php  echo CHtml::link(Yii::t('thescout','Back'),
					array('payment/index'),
		array('class'=>'btn btn-inverse'));  ?>
		</div>
		<div class="span2 pull-right">
			<?php echo $this->renderPartial('_paypal', array('model'=>$model)); ?>
		</div>
	</div>
</div>
<?php endif;?>