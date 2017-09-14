<?php

//$this->breadcrumbs = array(
	//$model->label(2) => array('index'),
	//GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
	//Yii::t('app', 'Update'),
//);
?>
<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Add') . ' ' . GxHtml::encode($model->label()) . ' : ' . GxHtml::encode(GxHtml::valueEx($model)); ?>
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
						<button data-widget="collapse" class="btn btn-box-tool">
							<i class="fa fa-minus"></i>
						</button>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-box-tool dropdown-toggle">
								<i class="fa fa-wrench"></i>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li><a href="#">Action</a></li>
								<li><a href="#">Another action</a></li>
								<li><a href="#">Something else here</a></li>
								<li class="divider"></li>
								<li><a href="#">Separated link</a></li>
							</ul>
						</div>
						<button data-widget="remove" class="btn btn-box-tool">
							<i class="fa fa-times"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">	
	





<?php
$this->renderPartial('_form', array(
		'model' => $model,
		'buttons' => 'create'));
?>

<div class="clearfix"></div>
</div>
</div>
</div>
</div>
</section>

