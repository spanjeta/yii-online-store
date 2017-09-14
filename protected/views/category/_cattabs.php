<?php include_once '_top.php'; ?>

<div class="clearfix mar_top2"></div>


<h3>Manage Category</h3>

<hr>
<?php
echo CHtml::link('Shop',array('category/index','type'=>Category::CATEGORY_SHOP),
array('class'=> $type == Category::CATEGORY_SHOP ?'btn btn-primary span1': 'btn span1'));
echo CHtml::link('Blog',array('category/index','type'=>Category::CATEGORY_BLOG),
array('class'=> $type == Category::CATEGORY_BLOG ?'btn btn-primary span1': 'btn span1'));
echo CHtml::link('Product',array('category/index','type'=>Category::CATEGORY_PRODUCT),
array('class'=> $type == Category::CATEGORY_PRODUCT ?'btn btn-primary span1': 'btn span1'));

?>

