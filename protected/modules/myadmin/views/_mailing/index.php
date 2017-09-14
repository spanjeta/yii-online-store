<?php
$this->breadcrumbs = array (
		'Mailings' 
);
?>

<a href="/myadmin/mailing/create" class="btn green">Create New Email</a>

<?php

$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => 'mailing-grid',
		'dataProvider' => $model->search (),
		'filter' => $model,
		'columns' => array (
				'subject',
				/* array (
						'name' => 'status',
						'value' => '$data->status0->name' 
				), */
			//	'startedOn',
				'finishedOn',
				array (
						'class' => 'booster.widgets.TbButtonColumn' 
				) 
		) 
) );
?>
