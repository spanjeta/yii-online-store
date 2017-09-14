
<?php $this->widget('booster.widgets.TbGridView', array(
	'id' => 'company-grid',
	'type'=>'bordered', // 'condensed','striped',
	'dataProvider' => $dataProvider,
	'columns' => array(
		'id',
		'user_name',
		'shop_name',
		array(
				'name' => 'shop_type',
				'value'=>'$data->getTypeOptions($data->shop_type)',
				'filter'=>Company::getTypeOptions(),
				),
		'shop_slogan',
		'about_shop:html',
		/*
		'admin_first_name',
		'last_name',
		'admin_company_position',
		'email_contact',
		'web_address',
		'facebook',
		'twitter',
		'instagram',
		'image_file',
		'terms:html',
		'delivery_info:html',
		'fax',
		'abn',
		'acn',
		'contact_no',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Company::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Company::getStatusOptions(),
				),
		'update_time',
		*/
		array(
			'class' => 'CxButtonColumn',
		),
	),
)); ?>