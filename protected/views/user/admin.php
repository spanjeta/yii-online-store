<div class="mar_top3"></div>

<div class="row-fluid"></div>

<h3>Account :</h3>

<?php
/*
 $criteria = new CDbCriteria;
 $criteria->addCondition('role_id =3');
 $models = User::model()->findAll($criteria);
 /*echo '<pre>';
 CVarDumper::dump($models);

 //print_r($models);
 echo '</pre>';
 exit;
 foreach ($models as $model)
 {
 $this->widget('booster.widgets.TbGridView', array(
 'id' => 'company-grid',
 'type'=>'striped bordered condensed',
 'dataProvider' => $model->search(),
 'filter' => $model,
 'columns' => array(
 'state_id',
 'email',

 ),
 ));
 }
 */

?>
<?php /*
$this->widget('booster.widgets.TbGridView', array(
'id' => 'company-grid',
'type'=>'striped bordered condensed',
'dataProvider' => $model->search(),
'filter' => $model,
'columns' => array(
'state_id',
'email',

),
)); */ ?>

<?php
/*
 $this->widget('booster.widgets.TbTabs', array(
 'type' => 'tabs',
 'tabs' => array(
 array('label' => 'Base Users', 'content'=>$this->renderPartial('/user/baseUser',
 array('dataProvider'=> User::getBaseUsers()), true), 'active' => true),
 array('label' => 'Business Users', 'content'=>$this->renderPartial('/user/businessusers',
 array('dataProvider'=> User::getBusinessUser()), true)),
 array('label' => 'Adminstrator', 'content'=>$this->renderPartial('/user/adminstrator',
 array('dataProvider'=> User::getadminstrator()), true)),

 )
 )
 );*/

echo CHtml::checkBoxList('Columns',$columns,array_combine($columns,$columns),array('id'=>'columns','separator'=>''));
?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'user-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array_merge($columns,array(array('class'=>'CButtonColumn'))),
)); ?>

<?php
Yii::app()->clientScript->registerScript('column','
        $("input[name=\"Columns[]\"]").change(function()
           {
                var data=$("input[name=\"Columns[]\"]:checked").serialize();
                $("#user-grid").yiiGridView("update",{data:data});
           }
       );
');
?>
