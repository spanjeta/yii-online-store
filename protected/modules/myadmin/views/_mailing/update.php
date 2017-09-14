<?php
$this->breadcrumbs=array(
	'Mailings'=>array('index'),
	'Update',
);

?>

<h1>Update Mailing</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>