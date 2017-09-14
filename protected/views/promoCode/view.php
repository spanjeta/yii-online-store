<?php
$this->breadcrumbs = array (
		$model->label ( 2 ) => array (
				'index' 
		),
		Html::valueEx ( $model ) 
);

?>


<section class="content">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">

				<div class="panel-heading vd_bg-yellow">
					<h3 class="panel-title">
						<span class="menu-icon"> <i class="fa fa-reorder"></i>
						</span> <?php echo Html::encode(Html::valueEx($model)); ?> 

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
					<div class="col-md-2">
					<div class="pos-abs">
					 <div class="coupons-code"> <h3>Coupons code</h3></div>
					  <img class="img-responsive" src="http://cdn.moneycrashers.com/wp-content/uploads/2012/09/coupons-pile-918x516.jpg">
					
					</div>
 
				<?php
				if ($model->hasAttribute ( 'description' ))
					echo $model->description;
				else if ($model->hasAttribute ( 'content' ))
					echo $model->content;
				
				?>
				
			
					</div>

					<div class="col-md-10">

<?php

$this->widget ( 'booster.widgets.TbDetailView', array (
		'data' => $model,
		'attributes' => array (
				'id',
				'code',
				'discount',
				'expiry_date:datetime',
				
				'create_time:datetime',
				array (
						'name' => 'createUser',
						'type' => 'raw',
						'value' => $model->createUser !== null ? Html::link ( Html::encode ( Html::valueEx ( $model->createUser ) ), array (
								'user/view',
								'id' => ActiveRecord::extractPkValue ( $model->createUser, true ) 
						) ) : null 
				) 
		) 
) );
?>	</div>
				</div>
				<div class="pull-right">
					<?php
					
/* $this->widget ( 'UserMenu', array (
							'model' => $model,
							'attribute' => 'state_id',
							'options' => $model->getStatusOptions (),
							//'visible' => Yii::app ()->user->isExec 
					) ); */
					?>
			  </div>
			</div>
		</div>
	</div>
	<div class="tabs related_data">
<?php
$this->startPanel ();
?>
<?php  $this->addPanel($model->getRelationLabel('promoProducts'), $model->getRelatedDataProvider('promoProducts'),	'promoProducts','promoProduct');?>
<?php  $this->endPanel(); ?>
</div>
<?php

/* $this->widget ( 'CommentPortlet', array (
		'model' => $model 
) ); */
?></div>
</section>