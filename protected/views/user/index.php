<?php

$this->breadcrumbs = array(
	User::label(2),
	Yii::t('app','index'),
);
?>

	<div class="content-header">
<h1><?php echo Html::encode(Yii::t('app',$model->label(2))) ; ?></h1>
</div>




<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));

