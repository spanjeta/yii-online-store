<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model) => array('view', 'id' => ActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);
?>

<div class="page-header">
	<h1><?php echo Yii::t('app', 'Update') . ' ' . Html::encode($model->label()) . ' : ' . Html::encode(Html::valueEx($model)); ?></h1>
</div>

<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>