<?php

$this->breadcrumbs = array(
	Color::label(2),
	Yii::t('app', 'Index'),
);
?>
<div class="content-header">
	<h2>
		<?php echo 'Colors';
		?>

	</h2>
</div>
<section class="content">
	

<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

