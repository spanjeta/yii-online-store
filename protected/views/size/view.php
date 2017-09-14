<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Html::valueEx($model),
);


?>

<div class="content-header">
<h1><?php echo Html::encode(Html::valueEx($model)); ?></h1>
</div>
<section class="content">
<div class="vd_content-section clearfix">
	<div class="row" id="form-basic">
		<div class="col-md-12">
			<div class="panel widget box box-primary">
				<div class="panel-body">
				<div class="box-header">
				<?php   $this->widget('booster.widgets.TbMenu', array(
					'items'=>$this->actions,
					'type'=>'success',
					'htmlOptions'=>array('class'=> 'pull-right margin-bottom-20'),
					));
				?>
				</div>
				<div class="box-body">
				<?php $this->widget('booster.widgets.TbDetailView', array(
					'data' => $model,
					'type' => 'striped bordered condensed',
					'attributes' => array(
				'id',
				'title',
				'description',

				array(
								'name' => 'state_id',
								'type' => 'raw',
								'value'=>$model->getStatusOptions($model->state_id),
								),

				/* array(
							'name' => 'createUser',
							'type' => 'raw',
							'value' => $model->createUser !== null ? Html::link(Html::encode(Html::valueEx($model->createUser)), array('user/view', 'id' => ActiveRecord::extractPkValue($model->createUser, true))) : null,
							), */

				'create_time',

					),
				)); ?>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>	


