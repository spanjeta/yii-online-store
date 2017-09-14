<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>


<div class="vd_content-section clearfix">
	<div class="row" id="form-basic">
		<div class="col-md-12">
			<div class="panel widget">
				<div class="panel-heading vd_bg-yellow">
					<h3 class="panel-title">
						<span class="menu-icon"> <i class="fa fa-reorder"></i>
						</span> <?php echo Html::encode(Html::valueEx($model)); ?> 

<?php   $this->widget('booster.widgets.TbMenu', array(
    'type' => 'navbar',
	'items'=>$this->actions,
	'htmlOptions'=>array('class'=> 'pull-right btn-group'),
	));
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
array(
			'name' => 'product',
			'type' => 'raw',
			'value' => $model->product !== null ? Html::link(Html::encode(Html::valueEx($model->product)), array('product/view', 'id' => ActiveRecord::extractPkValue($model->product, true))) : null,
			),
'rating',
array(
			'name' => 'createUser',
			'type' => 'raw',
			'value' => $model->createUser !== null ? Html::link(Html::encode(Html::valueEx($model->createUser)), array('user/view', 'id' => ActiveRecord::extractPkValue($model->createUser, true))) : null,
			),
'create_time:datetime',
	),
)); ?>	</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="tabs related_data">
</div>
<?php  /*  $this->widget('CommentPortlet', array(
	'model' => $model,
)); */
?></div>