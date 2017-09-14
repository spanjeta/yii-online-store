
<?php

$this->widget('booster.widgets.TbListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',   // refers to the partial view named '_view'
    'sortableAttributes'=>array(
        'id',
        'title',
        'create_time',
    ),
));
