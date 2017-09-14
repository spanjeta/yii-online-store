<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i
				class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Pages</li>
	</ol>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
			<ul id="" class="pull-right btn-group nav navbar-nav rest_manage_btn">
<li>
<a id="export-button" class="" href="#">
<i class="fa fa-cloud-download"></i>
Export 
</a>
</li></ul>  
<?php 
/*
$form = $this->beginWidget ( 'booster.widgets.TbActiveForm', array (
		'id' => 'restaurant-form',
		'type' => 'horizontal',
		'action'=>Yii::app()->createUrl('product/import'),
		'enableAjaxValidation' => true,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
?>
<br/>
<ul class="list-unstyled list-inline pull-right">
<li>
<?php echo $form->fileField($model, 'image_file'); ?>
</li>
<li>
<?php


$this->widget ( 'booster.widgets.TbButton', array (
		'buttonType' => 'submit',
		'label' =>Yii::t('app','Bulk Upload'),
		'type' => 'primary' 
) );
?>
</li>
</ul>
<div class="clearfix"></div>
		<?php $this->endWidget();  */ ?>		
	<?php
	
	$this->widget ( 'booster.widgets.TbMenu', array (
			'items' => $this->actions,
			'type' => 'success',
			'htmlOptions' => array (
					'class' => 'pull-right' 
			) 
	) );
	?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">	


<?php

$this->renderExportGridButton( $this->widget ( 'booster.widgets.TbExtendedGridView', array (
		'id' => 'product-price-grid',
		'type' => 'striped bordered condensed',
		'dataProvider' => $model->search (),
		'pager'=>true,
		'filter' => $model,
		'columns' => array (
				//'id',
				'min_price',
				'max_price',
				'min_quantity',
				'max_quantity',
				'discount',
			
		/*
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>ProductPrice::getStatusOptions(),
				),
		*/
		array (
						'class' => 'booster.widgets.TbButtonColumn',
						'htmlOptions' => array (
								'nowrap' => 'nowrap' 
						) 
				) 
		) 
) ),'');

?>
<?php //$this->renderExportGridButton($gridWidget,'Export Grid Results',array('class'=>'btn btn-info pull-right'));?>
</div>
			</div>
		</div>
	</div>
</section>
