<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Manage') . ' : ' . GxHtml::encode($model->label(2)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a
			href="<?php echo Yii::app()->createurl('groupCategory/admin')?>"><i
				class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage Group Category</li>
	</ol>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
	<?php
	
$this->widget ( 'bootstrap.widgets.TbButtonGroup', array (
			'buttons' => $this->actions,
			'type' => 'success',
			'htmlOptions' => array (
					'class' => 'pull-right' 
			) 
	) );
	?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">		

<?php

$this->widget ( 'bootstrap.widgets.TbGridView', array (
		'id' => 'group-category-grid',
		'type' => 'striped bordered condensed',
		'dataProvider' => $model->search (),
		'filter' => $model,
		'columns' => array (
			array(
								'header'=>'<a>Sr. No.</a>',
								'value'=>'$row+1',
								
						),
				'title',
			
				array (
						'class' => 'bootstrap.widgets.TbButtonColumn',
						'htmlOptions' => array (
								'nowrap' => 'nowrap' 
						) 
				) 
		) 
) );
?>
</div>
			</div>
		</div>
	</div>
</section>