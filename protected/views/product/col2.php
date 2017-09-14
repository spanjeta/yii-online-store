
<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">
<div class="row-fluid emporium_top">
	<h3 class="pull-left">Emporium</h3>
	<div class="pull-right span5">

		<ul class="nav emporium_top_nav">
			<li class="active"><a
				href="<?php echo Yii::app()->createUrl('emporium/latest')?>">Latest</a>
			</li>
			<li><a href="<?php echo Yii::app()->createUrl('emporium/popular')?>">Most
					Popular</a></li>

			<li><a
				href="<?php echo Yii::app()->createUrl('emporium/col1',array('type_id'=>1))?>"
				id="col1">1 Column</a>
			</li>
			<li><a
				href="<?php echo Yii::app()->createUrl('emporium/col2',array('type_id'=>1))?>"
				id="col2">2 Column</a>
			</li>
		</ul>
	</div>
</div>

<div class="clearfix mar_top2"></div>
<div
	class="row-fluid masnory_emporium_post">

	<?php foreach($models as $model) { ?>
	<?php 
	if(isset($model->image_file) && !empty($model->image_file))
	{
		$image = Yii::app()->createUrl('emporium/download',array('file'=>$model->image_file));
	}
	else $image = Yii::app()->createUrl('emporium/download',array('file'=>'default.png'));

	$tagproducts = $model->empproducts; if($tagproducts) {
	?>




	<!--- emporum post   --->

	<div class="emporium_post">

		<div class="emporium_post_colmn">


			<div class="emporium_post_thumb">
				<a href="#myModal1"
					onclick="getId('<?php echo $model->id?>'); return false;"
					role="button" data-toggle="modal"> <?php 
					$url = Yii::app()->createUrl('emporium/download',array('file'=>$model->image_file,'id'=>$model->create_user_id));
					$already_tagged = $model->getTagged();
					//	$products = Product::getproducts();

					$this->widget('application.extensions.phototag.PhotoTag', array(
						'id'=>'qqqqqq',
						'imageid' => $model->id, // required if you tag more than one images
						'imageurl' => $url, // required (actual image url)
						'height' => '100', // optional (default height of tag box)
						'maxHeight' => '150', // optional (maximum height of tag box)
						'width' => '150',// optional (default width of tag box)
						'maxWidth' => '300', // optional (maximum width of tag box)
						'showTag' => 'hover', //optional ('always','hover')
						'canTag' => 'false', //optional ('true','false')
						'showLabels' => 'false', //optional ('true','false')
						'canDelete' => 'false', //optional ('true','false')
						'item_id'=>$model->id,
					//	'save' => CController::createUrl('emporium/ajaxSaveTag'), //optional (save callback url)
					//	'remove' => CController::createUrl('emporium/ajaxRemoveTag'), //optional (delete callback url)
						//	'autoComplete' => CController::createUrl('emporium/getProducts'), //optional (array contains data for autoComplete list)
				//		'autoComplete' => $products,
						// 'autoComplete' => Html::listDataEx(Product::model()->findAllAttributes(null, true)),
						'defaultTags' => $already_tagged //optional (array contains already tagged users)
				));
				?>

				</a>
			</div>


			<div class="emporium_post_content row-fluid">

				<div class="emporium_post_content_top">
					<h4 class="post_tittle">
						<?php echo $model->title;?>
					</h4>
					<div class="clearfix"></div>
					<div class="geta">
						<a class="pull-left product_tag cursor"
							id="<?php echo 'text_'.$model->id?>"
							onclick="tagview(<?php echo $model->id ?>)"> hide product tags </a>
					</div>
					<span class="post_count pull-right">	<?php echo $model->starCount(); ?> <i
						class="fa fa-star pull-right"></i>
					</span>
					<div class="clearfix"></div>
					<hr>


					<div id=<?php echo 'toggle_id'.$model->id;?>>
						<ul class="post_prod_desc row-fluid">

							<?php if($tagproducts) {  
								$i = 1;
								foreach ($tagproducts as $tagproduct)  {
if($tagproduct->product)  {?>

							<li><a target="_blank"
								href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$tagproduct->product_id));?>">
									<strong class="dropcap pull-left"><?php echo  $i++; ?> </strong>
									<h4 class="post_prod_tittle pull-left">
										<?php echo $tagproduct->product->title; ?>
									</h4>
									<h5 class="post_prod_brand pull-right">
										<?php echo $tagproduct->product->company->shop_name; ?>
									</h5>

							</a></li>
							<?php } 
}
}?>

						</ul>
					</div>

				</div>

			</div>





		</div>
		<!--- emporum post colmn  --->

	</div>
	<!--- emporum post   --->


	<?php } 
}?>
</div>



<!-- Button to trigger modal -->


<script type="text/javascript">
<!--
function getId(id){

	$.ajax({
			url : '<?php echo Yii::app()->createUrl('emporium/getActive')?>/id/'+id,
			type : 'GET',
			dataType : 'html',
			success: function( response){
					$('#emp_active').html(response);					
			}
		});
}
//-->
</script>


<!-- Modal -->
<div id="myModal1" class="emporuim_post_view modal hide fade"
	tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-body ">

		<div id="myCarousel" class="carousel slide">
			<!-- Carousel items -->
			<div class="carousel-inner">


				<div class="item active" id="emp_active"></div>


				<?php foreach($models as $key=>$model) { 

					if($key > 0) {
						if(isset($model->image_file) && !empty($model->image_file))
						{
							$image = Yii::app()->createUrl('emporium/download',array('file'=>$model->image_file,'id'=>$model->create_user_id));
						}
						$tagproducts = $model->empproducts; if($tagproducts) {
	?>
				<div class="item">
					<img border="0" id="2" src="<?php echo $image;?>" class="span5">
					<div class="emporium_post_content span5">

						<a href="#" class="empo_close"
							onClick="window.location.reload();return false;"><i
							class="fa fa-times-circle"></i> </a>

						<div class="emporium_post_content_top">
							<h4 class="post_tittle">
								<?php echo $model->title;?>
							</h4>
							<div class="clearfix"></div>
							<div class="geta">
								<a onclick="tagview1(<?php echo $model->id ?>)"
									id="<?php echo 'text1_'.$model->id?>"
									class="pull-left product_tag cursor"> hide product tags </a>
							</div>
							<span class="post_count pull-right">	<?php echo $model->starCount(); ?> <i
								class="fa fa-star pull-right"></i>
							</span>
							<div class="clearfix"></div>
							<hr>


							<div id=<?php echo 'toggle_id1'.$model->id;?>>
								<ul class="post_prod_desc row-fluid">


									<?php 	$i = 1;
									foreach ($tagproducts as $tagproduct)  { ?>
									<li><a target="_blank"
										href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$tagproduct->product_id));?>">
											<strong class="dropcap pull-left"><?php echo $i++;?> </strong>
											<h4 class="post_prod_tittle pull-left">
												<?php echo $tagproduct->product->title; ?>
											</h4>
											<h5 class="post_prod_brand pull-right">
												<?php echo $tagproduct->product->company->shop_name; ?>
											</h5>
									</a>
									</li>

									<?php }?>

								</ul>
							</div>

						</div>

					</div>


				</div>


				<?php } 
}
} ?>




			</div>

			<!-- Carousel nav -->
			<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#myCarousel"
				data-slide="next">&rsaquo;</a>
		</div>


	</div>

</div>

<!-- Modal -->



<!--row fluid-->
<?php /* 
<script>

$(document).ready(function() {

	$('.geta a #').click(function() {
var a = '<?php echo $mo?>';
			//	$('#tagview').toggle();
			});
		})
</script>
*/?>

<script>

function tagview(id)
{

//	alert(id);
	$('#toggle_id'+id).toggle();

 	if($('#text_'+id).html() == 'show tag product'){

 		$('#text_'+id).html('Hide tag Product')
		}

 	else
 	{
 		$('#text_'+id).html('show tag product')
 	}
}
function tagview1(id)
{

//	alert(id);
	$('#toggle_id1'+id).toggle();

 	if($('#text1_'+id).html() == 'show tag product'){

 		$('#text1_'+id).html('Hide tag Product')
		}

 	else
 	{
 		$('#text1_'+id).html('show tag product')
 	}
}

</script>
