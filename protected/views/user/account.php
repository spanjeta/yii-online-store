<div class="header_background_div"></div>
<div class="white-bg margin-bottom ">
	<section class="content-header">
		<h1><?php //echo Html::encode(Html::valueEx($model)); ?></h1>
		
	</section>

	<section class="content">

		<div class="row margin-0">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h4 class="sub-history box-title">
							<span><i class="fa fa-list"></i> Details </span>

						</h4>
						<div class="clearfix"></div>
						<div class="user_account_btn">
	<?php   $this->widget('booster.widgets.TbMenu', array(
	'items'=>$this->actions,
	'type'=>'success',
	'htmlOptions'=>array('class'=> 'pull-right'),
	));
?></div>
<div class="clearfix"></div>

					</div>


					<div class="box-body">

<?php

$this->widget ( 'booster.widgets.TbDetailView', array (
		'data' => $model,
		'attributes' => array (
				'id',
				
				'first_name',
				'last_name',
				'email',
				'ph_no',
			
				array (
						'type' => 'raw',
						'name' => 'image_file',
						'value' => CHtml::image ($model->getImage()),
						
				),
			
				'create_time' 
		) 
)
 );
?>
</div>
				</div>
			</div>
		</div>
	</section>
<?php
$this->StartPanel ();
?>
</div>

