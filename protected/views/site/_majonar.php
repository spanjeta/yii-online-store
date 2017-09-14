<?php
$dataProvider = new CActiveDataProvider('Product');
$this->widget('zii.widgets.CListView', array(
		'id' => 'postsIndex',
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'itemsCssClass'=>'yiiMasonry-200', // Optional: Just theme, to use this theme you have to keep rowSelector => '.view', change this line if you have custom theme.
		'template' => '{items} {pager}',
		'pager' => array(
				'class' => 'ext.yiiMasonry.yiiMasonry',
				'rowSelector'=>'.view', // row class
				'listViewId' => 'postsIndex', // Container id
		)
));

?>