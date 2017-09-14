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

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="panel-heading vd_bg-yellow">
					<h3 class="panel-title">
						<?php   $this->widget('booster.widgets.TbMenu', array(
							'items'=>$this->actions,
							'type'=>'success',
							'htmlOptions'=>array('class'=> 'pull-right'),
							));
						?>
						<div class="clearfix"></div>
						<br>


						<?php $this->widget('booster.widgets.TbDetailView', array(
						'data' => $model,
						'type' => 'striped bordered condensed',
						'attributes' => array(
						'id',
						'title',
						'color_code',
						/* array(
						'name' => 'type_id',
						'type' => 'raw',
						'value'=>$model->getTypeOptions($model->type_id),
						), */
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

						),
						)); ?>
					</h3>
				</div>

				</div>
			</div>
		</div>
	</div>
</section>