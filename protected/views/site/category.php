<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="clearfix mar_top2"></div>
<?php $this->renderPartial('search',
array('products'=>$products,'categorys'=>$categorys,'colors'=>$colors,'brands'=>$brands,'stores'=>$stores,'model'=>$model,'id'=>$id)
);?>

<div class="clearfix"></div>

<hr>

<div id="masonry">
	<div id="cat_data">
	<?php   $this->renderPartial('_pview',
	array('products'=>$products)
	);    ?>
	</div>
</div>


<!-- -masonry  -->


<script>
obj_ipin = {},
$(window).load(function(){   
	myrun();

				});


</script>






