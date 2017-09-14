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
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i class="fa fa-dashboard"></i> <?php echo Yii::t('app', 'home') ?></a></li>
		<li class="active"><?php echo Yii::t('app', 'update pages') ?></li>
	</ol>
	</section>

	
<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Por favor preencha os detalhes aqui</h3>
							<div class="box-tools pull-right">
						<button data-widget="collapse" class="btn btn-box-tool">
							<i class="fa fa-minus"></i>
						</button>
						<div class="btn-group">
							<button data-toggle="dropdown" class="btn btn-box-tool dropdown-toggle">
								<i class="fa fa-wrench"></i>
							</button>
							<ul role="menu" class="dropdown-menu">
								<li><a href="#"><?php echo Yii::t('app', 'action') ?></a></li>
								<li><a href="#"><?php echo Yii::t('app', 'another action') ?></a></li>
								<li><a href="#">Outra coisa aqui</a></li>
								<li class="divider"></li>
								<li><a href="#"><?php echo Yii::t('app', 'separated link') ?></a></li>
							</ul>
						</div>
						<button data-widget="remove" class="btn btn-box-tool">
							<i class="fa fa-times"></i>
						</button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">	
				<div class="col-md-12">





<?php
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