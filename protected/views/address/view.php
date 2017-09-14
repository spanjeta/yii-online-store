<?php
$this->breadcrumbs = array (
		$model->label ( 2 ) => array (
				'index' 
		),
		Html::valueEx ( $model ) 
);

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title no_margin clearfix"><?php echo Html::encode(Html::valueEx($model)); ?></h3>
				<?php
				
$this->widget ( 'booster.widgets.TbMenu', array (
						'items' => $this->actions,
						'type' => 'danger',
						'htmlOptions' => array (
								'class' => 'pull-right custom-list-view' 
						) 
				) );
				?>
				
</div>
				<div class="box-body">

	
	<?php
	
$this->widget ( 'booster.widgets.TbDetailView', array (
			'data' => $model,
			'attributes' => array (
					
					array (
							'header' => Yii::t('app','id'),
							'type' => 'raw',
							'value' => '$data->id'
					),
					
					array (
							'header' => Yii::t('app','bulding name'),
							'type' => 'raw',
							'value' => '$data->bulding_name'
					),
					array (
							'header' => Yii::t('app','street add'),
							'type' => 'raw',
							'value' => '$data->street_add'
					), 
					array (
							'header' => Yii::t('app','suburb'),
							'type' => 'raw',
							'value' => '$data->suburb'
					), 
					
					array (
							'header' => Yii::t('app','postcode'),
							'type' => 'raw',
							'value' => '$data->postcode'
					), 
					array (
							'name' => '_state',
							'type' => 'raw',
							'value' => $model->getStatusOptions ( $model->_state ) 
					),
					array (
							'header' => Yii::t('app','country'),
							'type' => 'raw',
							'value' => '$data->quantity'
					), 
					array (
							'header' => Yii::t('app','bulding name1'),
							'type' => 'raw',
							'value' => '$data->bulding_name1'
					), 
					array (
							'header' => Yii::t('app','street add1'),
							'type' => 'raw',
							'value' => '$data->street_add1'
					), 
					array (
							'header' => Yii::t('app','suburb1'),
							'type' => 'raw',
							'value' => '$data->suburb1'
					), 
					array (
							'header' => Yii::t('app','postcode1'),
							'type' => 'raw',
							'value' => '$data->postcode1'
					), 
					array (
							'header' => Yii::t('app','state1'),
							'type' => 'raw',
							'value' => $model->getStatusOptions ( $model->_state1 ) 
					),
					array (
							'header' => Yii::t('app','country1'),
							'type' => 'raw',
							'value' => '$data->country1'
					),
					array (
							'header' => Yii::t('app','ph no'),
							'type' => 'raw',
							'value' => '$data->ph_no'
					), 
					array (
							'header' => Yii::t('app','content'),
							'type' => 'raw',
							'value' => '$data->content'
					),
					array (
							'header' => Yii::t('app','cart'),
							'type' => 'raw',
							'value' => '$data->cart_id'
					),
					
					array (
							'header' => Yii::t('app','create time'),
							'type' => 'raw',
							'value' => '$data->create_time'
					),
				
					
					
					array (
							'header' => Yii::t('app','create user'),
							'type' => 'raw',
							'value' => $model->createUser !== null ? Html::link ( Html::encode ( Html::valueEx ( $model->createUser ) ), array (
									'user/view',
									'id' => ActiveRecord::extractPkValue ( $model->createUser, true ) 
							) ) : null 
					) 
			) 
	) );
	?>

					
	</div>
			</div>
		</div>
	</div>
</div>
