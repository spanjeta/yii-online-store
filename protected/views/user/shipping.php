<style>

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  border-top: 1px solid #dddddd;
  line-height: 2.5;
  padding: 8px;
  vertical-align:middle;
}

</style>

<div class="container">
<div class="border-org my_detail_info">
<h3 class="tabs-inner-heading">Shipping address</h3>

<div class="tab-pane active tabs_inner" id="home">
<a href="<?php echo Yii::app()->createUrl('user/address',array('id'=>Yii::app()->user->id));?>" class="btn btn-success pull-right">Add Address</a>
	<div class="row-fluid">

		<div class="clearfix"></div>

	</div>

	<div class="clearfix"></div>
	
	<?php $this->widget('booster.widgets.TbGridView', array(
			'id' => 'address-grid',
			'type'=>'striped bordered condensed',
			'dataProvider' => $model->search(),
			'filter' => $model,
			'enableSorting'=>true,
			'selectableRows'=>2,
			'columns' => array(
	'id',
	'bulding_name',
		'street_add',
		'suburb',
		'postcode',
		/* array(
				'name' => '_state',
				'value'=>'$data->getStatusOptions($data->_state)',
				'filter'=>Address::getStatusOptions(),
				), */
		
		'country',

/* array( 
		'header'=>'<a>Actions</a>',
		'template'=>'{update}',
		'class' => 'CxButtonColumn',
		
'buttons'=>array(
                 'update' => array(
                    'label'=>'update',   
                   // 'url'=>Yii::app()->createUrl('user/updateAddress',array('id'=>$model->id))    
                     
                            ),
           ),
		
		
		
	), */ ), )); ?>
	</div>
	</div>
	</div>