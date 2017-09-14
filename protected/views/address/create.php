<?php
$this->breadcrumbs = array (
		$model->label ( 2 ) => array (
				'index' 
		),
		Yii::t ( 'app', 'Create' ) 
);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">



				<div class="box-body">
	<?php
	$this->renderPartial ( '_form', array (
			'model' => $model,
			'buttons' => 'create' 
	) );
	?>
	</div>
			</div>
		</div>
	</div>
</div>