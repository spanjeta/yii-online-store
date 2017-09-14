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
<div class="vd_content-section clearfix">
	<div class="row" id="form-basic">
		<div class="col-md-12">
			<div class="panel widget box box-primary">
				<div class="panel-body">
<?php
$this->renderPartial('_form', array(
		'model' => $model));
?>
				</div>
			</div>
		</div>
	</div>
</div>
</section>	
