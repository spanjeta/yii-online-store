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
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Update Pages</li>
	</ol>
	</section>

	
<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title"> Please fill the details here</h3>
							<div class="box-tools pull-right">
						
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">	





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
		'model' => $model));
?>
</div>
<div class="clearfix"></div>
</div>
</div>
</div>
</section>