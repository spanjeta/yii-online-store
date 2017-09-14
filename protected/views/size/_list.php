<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
				<?php
	echo CHtml::link('Create New',array('size/create'),array('class'=>'btn btn-primary pull-right'));
	?>


	</div>
	<div class="box-body">
		<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'size-grid',
		'pager' => true,
		
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
			'id',
				'title',
				array(
						'class'=>'booster.widgets.TbButtonColumn',
						'htmlOptions' => array('nowrap'=>'nowrap'),
						'header'=>'Update',
						'template'=>'{update}'
				),

				array(
						'class'=>'booster.widgets.TbButtonColumn',
						'htmlOptions' => array('nowrap'=>'nowrap'),
						'header'=>'Delete',
						'template'=>'{delete}'
				),
	),
)); ?>
	</div>
				</div>
			</div>
		</div>
	</div>
</section>