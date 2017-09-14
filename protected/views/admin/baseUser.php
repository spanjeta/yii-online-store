
<div class="clearfix mar_top1"></div>


<h3>Users</h3>

<?php
$this->widget ( 'booster.widgets.TbGridView', array (
		'id' => 'company-grid',
		'type' => 'striped bordered condensed',
		'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>"function(id){window.location='" . Yii::app()->createAbsoluteUrl('user/view') . "/' + $.fn.yiiGridView.getSelection(id);}",
		'pager'=>true,
		'dataProvider' => $model->searchDiffUser ( User::ROLE_USER ),
		'filter' => $model,
		 'afterAjaxUpdate' => "function(){
  jQuery('#last_visit_time').datepicker({'dateFormat': 'yy-mm-dd'})
  jQuery('#create_time_search').datepicker({'dateFormat': 'yy-mm-dd'})
  }", 
		'columns' => array (
				/* array (
						'name' => 'state_id',
						'value' => '$data->getStatusOptions($data->state_id)',
						'filter' => User::getStatusOptions () 
				), */
				'email',


/* array(

'header'=>'favourites',
'value'=>'$data->getUserFavourite()',


), */

array (
						
						'header' => '<a>Orders</a>',
						'value' => '$data->getUserOrders()' 
				),
/* array(

'header'=>'violations',
'value'=>'',
), */
/* array (
						'name' => 'last_visit_time',
						'type' => 'raw',
						'value' => '(strtotime($data->last_visit_time)) ? date("j F y", strtotime($data->last_visit_time)) : date("j F", strtotime($data->last_visit_time))',
						'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
								'model' => $model,
								'attribute' => 'last_visit_time',
								'htmlOptions' => array (
										'id' => 'last_visit_time_search' 
								),
								'options' => array (
										'dateFormat' => 'yy-mm-dd' 
								) 
						), true ) 
				), */
				
				array (
						'header'=>'<a>Create Date</a>',
						'name' => 'create_time',
						'type' => 'raw',
						'value' => '(strtotime($data->create_time)) ? date("j F y", strtotime($data->create_time)) : date("j F", strtotime($data->create_time))',
						 'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
								'model' => $model,
								'attribute' => 'create_time',
								'htmlOptions' => array (
										'id' => 'create_time_search' 
								),
								'options' => array (
										'dateFormat' => 'yy-mm-dd' 
								) 
						), true ) 
				),
				array (
						'header'=>'<a>Action</a>',
						'class' => 'zii.widgets.grid.CButtonColumn',
						'htmlOptions' => array (
								'style' => 'white-space: nowrap' 
						),
						'afterDelete' => 'function(link,success,data) { if (success && data) alert(data); }',
						 'template' => '{view} {update} {delete}',
						'buttons' => array (
								
								'view' => array (
										
										'label' => '<i class="fa fa-eye"></i>',
										'imageUrl' => false,
										'url' => 'Yii::app()->createUrl("user/view", array("id"=>$data->id))' 
								),
								'update' => array (
										
										'label' => '<i class="fa fa-pencil"></i>',
										'imageUrl' => false,
										'url' => 'Yii::app()->createUrl("user/update", array("id"=>$data->id))' 
								),
								'delete' => array (
										
										'label' => '<i class="fa fa-times"></i>',
										'imageUrl' => false,
										'url' => 'Yii::app()->createUrl("user/delete", array("id"=>$data->id))' 
								) 
						) 
				) 
		)
		 
) );
?>
<script>
$(document).ready(function() {
    $('[title]').removeAttr('title');
});
</script>
