<?php
$this->breadcrumbs = array (
		Address::label ( 2 ),
		Yii::t ( 'app', 'Index' ) 
);
?>



<div class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
				<h3>
	<?php
	
echo Html::encode ( Address::label ( 2 ) );
	?>
	</h3>
				<?php

$this->widget ( 'booster.widgets.TbMenu', array (
		'items' => $this->actions,
		'type' => 'success',
		'htmlOptions' => array (
				'class' => 'pull-right' 
		) 
) );
?>
				
				</div>


<div class="box-body">



<?php 


$this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
)); ?>
</div>
</div>
</div>
</div>

		