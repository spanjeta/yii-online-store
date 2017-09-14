<?php

//$this->breadcrumbs = array(
//$model->label(2) => array('index'),
//Html::valueEx($model) => array('view', 'id' => ActiveRecord::extractPkValue($model, true)),
//Yii::t('app', 'Update'),
//);
?>

<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Update') . ' ' . Html::encode($model->label()) . ' : ' . Html::encode(Html::valueEx($model)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i><?php echo Yii::t('app', 'home')?></a></li>
		<li class="active"><?php echo Yii::t('app', 'update pages')?></li>
	</ol>
	</section>

	
<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				
				<!-- /.box-header -->
				<div class="box-body">	
				<div class="col-md-12">





<?php
if(!empty($error)){
	echo $error;
}
$this->renderPartial('_form', array(
		'model' => $model));
?>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</section>