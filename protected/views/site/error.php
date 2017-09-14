<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
		'Error',
);
?>
<div class="container text-center error_box">

<div class="content-header">
	<h1 class="error_heading">
		Error
		<?php echo $code; ?>
	</h1>
	<div class="error_para">
		<?php echo CHtml::encode($message); ?>
	</div>
</div>

</div>
