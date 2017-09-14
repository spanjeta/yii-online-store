<script type="text/javascript" src="/online-clothing-website-679/online-clothing/assets/e4d640f7/jquery.js"></script>
<?php
/* @var $this BrandController */
/* @var $model Brand */
$this->breadcrumbs = array (
		'Brands' => array (
				'index' 
		),
		$model->title 
);

$this->menu = array (
		array (
				'label' => 'List Brand',
				'url' => array (
						'index' 
				) 
		),
		array (
				'label' => 'Create Brand',
				'url' => array (
						'create' 
				) 
		),
		array (
				'label' => 'Update Brand',
				'url' => array (
						'update',
						'id' => $model->id 
				) 
		),
		/* array (
				'name' => 'Brand',
				'type' => 'raw',
				
				'value' => 'isset($data->brand->image_file)?CHtml::image($data->brand->image_file):CHtml::image($data->brand->getImage())',
				'htmlOptions' => array (
						'class' => 'brand-image'
				)
		), */
		array (
				'label' => 'Delete Brand',
				'url' => '#',
				'linkOptions' => array (
						'submit' => array (
								'delete',
								'id' => $model->id 
						),
						'confirm' => 'Are you sure you want to delete this item?' 
				) 
		),
		array (
				'label' => 'Manage Brand',
				'url' => array (
						'admin' 
				) 
		) 
);
?>


<div class="content-header">
	<h1>View Brand <?php echo $model->id; ?></h1>
</div>
<section class="content">
	<div class="vd_content-section clearfix">
		<div class="row" id="form-basic">
			<div class="col-md-12">
				<div class="panel widget box box-primary"">
					<div class="panel-heading vd_bg-yellow"></div>
					<div class="panel-body">
						<div class="col-md-12">
						
							<?php   $this->widget('booster.widgets.TbMenu', array(
							'items'=>$this->actions,
							'type'=>'success',
							'htmlOptions'=>array('class'=> 'pull-right'),
							));
						?>
					<?php
					
$this->widget ( 'booster.widgets.TbDetailView', array (
							'data' => $model,
							'attributes' => array (
									'id',
									'title',
									'description',
								//	'type_id',
									//'state_id',
									'image_file',
									'create_user_id',
								//	'create_time',
								//	'update_time' 
							) 
					) );
					?>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

