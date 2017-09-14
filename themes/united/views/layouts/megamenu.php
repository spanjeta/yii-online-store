
<?php $categories = Category::model()->findAll();
$criteria = new CDbCriteria;
$criteria->addCondition('feature_site = 1');
$featureproducts = Product::model()->findAll($criteria);
?>


<ul class="mega-menu dropdown-menu container ">

	<div class="row">


		<div class="span5">


			<h4 class="menu_tittle">Product Categories</h4>
			
			<li class="menu-adult-clothing"><a
				href="<?php echo Yii::app()->createUrl('site/category');?>"><?php echo 'All';?>
			</a></li>
			
			<?php foreach ($categories as $category) {?>
			
			<li class="menu-adult-clothing"><a
				href="<?php echo Yii::app()->createUrl('site/category',array('id'=>$category->id));?>"><?php echo $category->title;?>
			</a></li>
			<?php }?>
		</div>

		<div class="span6">

			<h4 class="menu_tittle">Featured Product</h4>

			<?php foreach($featureproducts as $feature) {  if($feature->images)  {?>
			<li class="menu-gifts"><a
				href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$feature->id)); ?>"><?php echo $feature->title;?>
			</a></li>
			<?php  }}?>
		</div>



	</div>

</ul>
