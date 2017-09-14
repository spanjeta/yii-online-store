<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model) => array('view', 'id' => ActiveRecord::extractPkValue($model, true)),
	Yii::t('app', 'Update'),
);
?>

<div class="content-header">
<h1><?php echo Yii::t('app', 'Update') . ' ' . Html::encode($model->label()) . ' : ' . Html::encode(Html::valueEx($model)); ?></h1>
</div>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="panel-heading vd_bg-yellow">
					
						<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>

				</div>
			</div>
		</div>

</section>