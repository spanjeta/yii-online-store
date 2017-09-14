<section class="content-header">
	<h1>
		<?php echo Yii::t('app', 'Manage') . ' : ' . Html::encode($model->label(2)); ?>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?php echo Yii::app()->createurl('admin/index')?>"><i
				class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Manage RssFeed</li>
	</ol>
</section>


<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					
	<?php
	
	$this->widget ( 'booster.widgets.TbMenu', array (
			'items' => $this->actions,
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

$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => 'rss-feed-grid',
		'type' => 'striped bordered condensed',
		'pager' => true,
		'dataProvider' => $model->search (),
		'filter' => $model,
		'columns' => array (
				'id',
				'title',
				'url',
				array (
						'class' => 'booster.widgets.TbButtonColumn',
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

