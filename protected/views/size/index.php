<?php

$this->breadcrumbs = array(
	Size::label(2),
	Yii::t('app', 'Index'),
);
?>
<div class="content-header">
	<h2>
		<?php echo 'Size';
		?>

	</h2>
</div>
<section class="content">
	

<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

