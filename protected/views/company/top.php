<?php
$cs=Yii::app()->clientScript;
$cs->registerCoreScript('yiiactiveform');
$cs->registerCoreScript('multifile');
?>
<?php
if(!empty($model->logo_file))
{
	$logo = Yii::app()->createUrl('sliderImage/thumb',array("file"=>$model->logo_file,'id'=>$model->create_user_id));
}
else
{
	$logo = Yii::app()->createUrl('sliderImage/download',array("file"=>'shop_logo.png'));
}
?>
<div class="row-fluid store_top">
	<a class="brand span5"><img src="<?php echo $logo;?>"> <?php echo $model->shop_name;?>
	</a>
	<div class="store_slogan span7">
		<h3>
		<?php echo $model->shop_slogan;?>
		</h3>
	</div>
</div>
		<?php
		$simages = array();
		if($images)
		{
			foreach($images as $image)
			{
				$simages[] = array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>$image->slider_image,'id'=>$image->create_user_id)), 'label'=>'', 'caption'=>'');
			}
		}
		else {
			$simages[] = array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>'banner-1.jpg')), 'label'=>'', 'caption'=>'');
			$simages[] = array('image'=>Yii::app()->createUrl('sliderImage/download',array("file"=>'banner-2.jpg')), 'label'=>'', 'caption'=>'');

		}
		?>
<div class="store_carousel">
<?php $this->widget('booster.widgets.TbCarousel', array(
			'items'=>$simages,
)); ?>
</div>

<div class="row-fluid store_nav">

	<ul class="navbar navbar-default">
		<li><a href="#"
			onclick="storeinfo(<?php echo Company::STORE_CONTACT .',' . $model->id?>)"
			data-toggle="modal" data-target="#myModal">Contact Us</a>
		</li>
		<li><a
			onclick="storeinfo(<?php echo Company::STORE_ABOUT .',' . $model->id?>)"
			data-toggle="modal" data-target="#myModal">About Us</a></li>
		<li><a href="#"
			onclick="storeinfo(<?php echo Company::STORE_TERMS .',' . $model->id?>)"
			data-toggle="modal" data-target="#myModal">Terms &amp; Conditions</a>
		</li>
		<li><a href="#"
			onclick="storeinfo(<?php echo Company::STORE_DELIVERY .',' . $model->id?>)"
			data-toggle="modal" data-target="#myModal">Deleivery info</a></li>
	</ul>

	<div id="topmenu-social-group" class="span3">
		<a href="#" title="Find us on Facebook" class="topmenu-social"><i
			class="fa fa-facebook"></i> </a> <a href="#"
			title="Subscribe to our RSS Feed" class="topmenu-social"><i
			class="fa fa-pinterest"></i> </a> <a href="#"
			title="Follow us on Twitter" class="topmenu-social"><i
			class="fa fa-camera-retro"></i> </a> <a href="#"
			title="Follow us on Twitter" class="topmenu-social"><i
			class="fa fa-twitter"></i> </a> <a href="#"
			title="Subscribe to our RSS Feed" class="topmenu-social"><i
			class="fa fa-google-plus"></i> </a>
	</div>


	<ul class="nav navbar-nav pull-right">

		<li class="dropdown"><a href="#" class="dropdown-toggle"
			data-toggle="dropdown">Product Category <b class="caret"></b> </a>
			<ul class="dropdown-menu">

			<?php
			$pcategorys = Category::model()->findAll();
			$ptype = Home::TYPE_PRODUCT;
			foreach($pcategorys as $key=>$value) { ?>

				<li><a
					href="<?php 
	echo Yii::app()->createUrl('company/view?id='.$model->id.'&type_id='.$ptype.'&cat_id='.$value->id.'&active=#masonry');
	?>"><?php echo  $value;?> </a></li>
	<?php }?>

			</ul>
		</li>

		<li class="dropdown"><a href="#" class="dropdown-toggle"
			data-toggle="dropdown">Post Category <b class="caret"></b> </a>
			<ul class="dropdown-menu">

			<?php
			foreach($categorys as $key=>$value) { ?>

				<li><a
					href="<?php 
echo Yii::app()->createUrl('company/view?id='.$model->id.'&type_id='.$key.'&active='.'#masonry');

?>"><?php echo  $value;?> </a></li>
<?php }?>

				<li><a
					href="<?php 
echo Yii::app()->createUrl('company/view?id='.$model->id);

?>"><?php echo  'All';?> </a></li>

			</ul>
		</li>
		<li class="dropdown"><a href="#" class="dropdown-toggle"
			data-toggle="dropdown">Sort <b class="caret"></b> </a>
			<ul class="dropdown-menu">
				<li><a
					href="<?php 
echo Yii::app()->createUrl('company/view?id='.$model->id.'&type_id='.$type_id.'&cat_id='.$cat_id.'&sort_id=1'. '&active='.'#masonry');
?>">Most Viewed</a></li>
				<li><a
					href="<?php 
echo Yii::app()->createUrl('company/view?id='.$model->id.'&type_id='.$type_id.'&cat_id='.$cat_id.'&sort_id=2'.'&active='.'#masonry');
?>">Latest</a></li>
				<li><a
					href="<?php 
echo Yii::app()->createUrl('company/view?id='.$model->id.'&type_id='.$type_id.'&cat_id='.$cat_id.'&sort_id=3'.'&active='.'#masonry');
?>">Featured</a></li>
			</ul>
		</li>
	</ul>

</div>

<!---   store_nav ---->


<script>
	
	function storeinfo(type,com_id)
	{
		var url = '<?php echo Yii::app()->createUrl('company/content/type');?>/'+type+'/com_id/'+com_id;
		$('#loadmodal').load(url);
	}
	</script>



