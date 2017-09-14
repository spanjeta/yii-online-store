<?php

$this->breadcrumbs = array(
		$model->label(2) => array('index'),
		Yii::t('app', 'Create'),
);
?>
<div class="page-header">
	<h3>
		<?php echo 'Add Paypal Account'; ?>
	</h3>
</div>
<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>