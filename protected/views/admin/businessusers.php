<?php include_once '_topuser.php'; ?>
<div class="columns_container row-fluid">
<?php

echo CHtml::checkBoxList('Coloumns',$columns,array_combine($columns,$columns),array('id'=>'columns','separator'=>'','class' => 'pull-left'));


//echo CHtml::checkBoxList('Columns','#',Product::getGridColumn(),array('onclick'=>'dynamicgrid()'));
?>
</div>
<div class="clearfix mar_top1"></div>
<hr>

<h3>Business Users</h3>


<?php $idset = 0;
//	$this->renderPartial('_plist',array('dataProvider'=>$dataProvider),false);
$this->widget('booster.widgets.TbGridView', array(
'id' => 'company-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->searchDiffUser(User::ROLE_BUSINESS_USER),
'filter' => $model,
'afterAjaxUpdate'=>"function(){
  jQuery('#update_time_search').datepicker({'dateFormat': 'yy-mm-dd'})
  jQuery('#create_time_search').datepicker({'dateFormat': 'yy-mm-dd'})
  }",
//	'enableSorting'=>true,
//	'selectableRows'=>2,
					'columns' =>$inner_list
		));
		?>
<?php
Yii::app()->clientScript->registerScript('Coloumns','
        $("input[name=\"Coloumns[]\"]").change(function()
           {
                var data=$("input[name=\"Coloumns[]\"]:checked").serialize();
                $("#company-grid").yiiGridView("update",{data:data});
           }
       );
');
?>



