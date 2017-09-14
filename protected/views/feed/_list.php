<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
				

	</div>
	<div class="box-body">


<ul class="list-wrapper pd-lr-15">
<?php
$this->widget('booster.widgets.TbListView', array(
    'dataProvider'=> isset($dataProvider) ? $dataProvider: $model->search(),
		'id' => 'color-grid',
		'pager' => true,
		
		//'type'=>'bordered', 
    'itemView'=>'_view',   // refers to the partial view named '_view'
    'sortableAttributes'=>array(
        'id',
        'title',
        'create_time',
    ),
));?>
</div>
				</div>
			</div>
		</div>
	</div>
</section>