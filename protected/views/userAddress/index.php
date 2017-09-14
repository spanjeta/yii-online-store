<?php

$this->breadcrumbs = array(
	UserAddress::label(2),
	Yii::t('app', 'Index'),
);
?>



<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3 class="box-title no_margin clearfix pull-left">Shipping Addresses</h3>
				<?php echo CHtml::link('Add',array('userAddress/create'),array('class'=>'btn btn-danger custom-add-btn pull-right','id'=>'ch_pass'));?>
				</div>


<div class="box-body">



<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
)); ?>
</div>
</div>
</div>
</div>
