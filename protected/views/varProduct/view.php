<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>

<section class="content">
<div class="vd_content-section clearfix">
	<div class="row" id="form-basic">
		<div class="col-md-12">
			<div class="panel widget box box-primary">
				<div class="panel-heading vd_bg-yellow">
					<h3 class="panel-title">
						<span class="menu-icon"> <i class="fa fa-reorder"></i>
						</span> <?php //echo Html::encode(Html::valueEx($model->product->title)); ?> 

<?php   /* $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	)); */
?>
     <?php
	
$this->widget ( 'booster.widgets.TbMenu', array (
			'items' => $this->actions,
			'type' => 'success',
			'htmlOptions' => array (
					'class' => 'pull-right' 
			) 
	) );
	?>               
                    </h3>
				</div>

				<div class="clearfix"></div>
				<div class="panel-body">

					<div class="col-md-12">

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'sku',
/* array(
			'name' => 'product',
			'type' => 'raw',
			'value' => $model->product !== null ? Html::link(Html::encode(Html::valueEx($model->product)), array('product/view', 'id' => ActiveRecord::extractPkValue($model->product, true))) : null,
			),
array(
			'name' => 'color',
			'type' => 'raw',
		'value' => $model->color !== null ? Html::link(Html::encode(Html::valueEx($model->color)), array('color/view', 'id' => ActiveRecord::extractPkValue($model->color, true))) : null,
			),
array(
			'name' => 'size',
			'type' => 'raw',
		'value' => $model->size !== null ? Html::link(Html::encode(Html::valueEx($model->size)), array('size/view', 'id' => ActiveRecord::extractPkValue($model->size, true))) : null,
			),
array(
			'name' => 'brand',
			'type' => 'raw',
		'value' => $model->brand !== null ? Html::link(Html::encode(Html::valueEx($model->brand)), array('brand/view', 'id' => ActiveRecord::extractPkValue($model->brand, true))) : null,
			), */
'quantity',
'price',
/* 'discount_price',
array(
				'name' => 'type_id',
				'type' => 'raw',
				'value'=>$model->getTypeOptions($model->type_id),
				),
array(
				'name' => 'state_id',
				'type' => 'raw',
				'value'=>$model->getStatusOptions($model->state_id),
				), */
/* array(
			'name' => 'createUser',
			'type' => 'raw',
		'value' => $model->createUser !== null ? Html::link(Html::encode(Html::valueEx($model->createUser)), array('user/view', 'id' => ActiveRecord::extractPkValue($model->createUser, true))) : null,
			), */
'create_time:datetime',
	),
)); ?>	</div>
				</div>
				<div class="pull-right">
					<?php						/* $this->widget('UserMenu', array(
						        'model' => $model,
						        'attribute' => 'state_id',
						        'options' => $model->getStatusOptions(),
								//'visible'=>Yii::app()->user->isExec
						    )); */
						?>
			  </div>
			</div>
		</div>
	</div>
	<div class="tabs related_data">
</div>
<?php   /* $this->widget('CommentPortlet', array(
	'model' => $model, 
));*/
?></div>
</section>