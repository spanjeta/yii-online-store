<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>

<div class="container"> 
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3 class="box-title no_margin clearfix"><?php echo Html::encode(Html::valueEx($model)); ?></h3>
				<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'danger',
	'htmlOptions'=>array('class'=> 'pull-right custom-list-view'),
	));
?>
				
</div>
<div class="box-body">

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(

'bulding_name',
'street_add',
'suburb',
'postcode',

'create_time',


	),
)); ?>
</div>
</div>
</div>
</div>
</div>

