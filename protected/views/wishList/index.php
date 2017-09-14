<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="container">

	<h3 class="page_tittle">Wish list here</h3>


	<div class="clearfix"></div>


	<div class="custom_masnory nopadding_masnory">

		<?php if($wishlists) {

foreach($wishlists as $wishlist) { ?>


		<?php if($wishlist->type_id == WishList::TYPE_PRODUCT) { 


	$product = $wishlist->product; 	$image = $product->getImage(); ?>
		<div class="custom_masnory_post" id="<?php echo $wishlist->id?>">
			<div class="brick-header">
				<a class="cursor" onclick="togglewish(<?php echo $wishlist->id?>)"><span
					class="rating pull-right"><span class="star_fill"></span>
				
				</a>

				<div class="thumb-holder">
					<a class="featured-thumb-link"
						href="<?php echo Yii::app()->createUrl('product/info',array('id'=>$product->id));?>">
						<img class="featured-thumb" src="<?php echo $image; ?>"
						alt="Come Fly With Me Contoured Table Clock with Blackbird" />
					</a>
				</div>

			</div>
			<div class="masonry-pin-middle">
				<div class='es_affiliate_masonry_bar button'>
					<div class='link right'>
						<a target='_blank'
							href='<?php echo Yii::app()->createUrl('product/info',array('id'=>$product->id));?>'
							class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_PRODUCT)?>
						</a>
					</div>
					<div class='price left'>
						<?php echo '$'.$product->price;?>
					</div>
				</div>
			</div>

			<div class="row-fluid">
				<div class="blog_content">
					<span class="masonry-meta-content"> <?php echo $product->title;?>
					</span> onto <span class=" masonry-meta-author"><strong> <?php echo $product->company->shop_name;?>
					</strong> </span>

				</div>
			</div>

		</div>



		<?php } else if($wishlist->type_id == WishList::TYPE_BLOG) { 

			$blog = $wishlist->blog; if($blog){

if($blog->image_file)
{
	$img = Yii::app()->createUrl('blog/thumb',array('file'=>$blog->image_file,'id'=>$blog->create_user_id));
}
else $img = Yii::app()->createUrl('blog/download',array('file'=>'blog.jpg'));
?>
		<div class="custom_masnory_post" id="<?php echo $wishlist->id?>">
			<div class="thumb">

				<div class="brick-header">

					<div class="blog_category">
						<span class="blog_title"><?php echo $blog->type;?> </span> <a
							class="cursor" onclick="togglewish(<?php echo $wishlist->id?>)"><span
							class="rating pull-right"><span class="star_fill"></span>
						
						</a>
						<h4 class="blog_product_title">
							<?php echo $blog->title;?>
						</h4>

						<div class="blog_author">
							<span class="author"><?php echo $blog->createUser;?> </span> <span
								class="blog_date">4 Jan 2014</span>
						</div>
					</div>
					<div class="thumb-holder">
						<a
							href="<?php echo Yii::app()->createUrl('blog/info',array('id'=>$blog->id));?>"
							class="featured-thumb-link"> <img style="" alt="image"
							src="<?php echo $img;?>" class="featured-thumb">
						</a>
					</div>
				</div>

				<div class="brick-footer">

					<div class="masonry-meta">
						<span class="masonry-meta-comment"> <?php echo $blog->truncate($blog->content,150).'...';?>
							<a class="read_more"
							href="<?php echo Yii::app()->createUrl('blog/info',array('id'=>$blog->id)) ?>"><?php echo Button::viewButton(Button::BUTTON_BLOG)?>
						</a>
						</span>

					</div>
				</div>

			</div>
		</div>

		<?php } 
		} else if($wishlist->type_id == WishList::TYPE_EMPORIUM) {


$emporium = $wishlist->emporium; if($emporium) {

if(isset($emporium->image_file) && !empty($emporium->image_file))
	$imgset = Yii::app()->createUrl('emporium/thumb',array('file'=>$emporium->image_file,'id'=>$emporium->create_user_id));
else
	$imgset = Yii::app()->theme->baseUrl.'/uploads/2013/1370997073a3ce2-200x220.jpg' ?>


		<div class="custom_masnory_post" id="<?php echo $wishlist->id;?>">
			<div class="thumb">

				<div class="brick-header">

					<a class="cursor" onclick="togglewish(<?php echo $wishlist->id?>)"><span
						class="rating pull-right"><span class="star_fill"></span>
					
					</a>



					<div class="emporium_list_head"></div>

					<div class="thumb-holder">

						<a class="featured-thumb-link"
							href="<?php echo Yii::app()->createUrl('emporium/info',array('id'=>$emporium->id));?>">
							<img class="featured-thumb" src="<?php echo $imgset ;?>"
							alt="image" style="">
						</a>

					</div>


				</div>

				<div class="brick-footer">

					<div class="blog_content">

						<div class='link pull-right'>
							<a
								href='<?php echo Yii::app()->createUrl('emporium/info',array('id'=>$emporium->id));?>'
								class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_EMPORIUM)?>
							</a>
						</div>


						<strong class="post_name"><?php echo $emporium->title;?> </strong>

						<div class="product_name">
							<?php echo $emporium->productcount. ' tagged products'; ?>
						</div>
						<div class="clearfix mar_top1"></div>
						<p class="Shop_name pull-left">
							<?php echo $emporium->createUser->company->company_name; ?>
						</p>



						<div class="pull-right product_price">

							<p class="old_price">
								<i class="fa fa-star "></i> 
								<?php echo $emporium->starCount(); ?>
							</p>


						</div>

					</div>

				</div>

			</div>

		</div>


		<?php } 
} else if($wishlist->type_id == WishList::TYPE_DEAL) {

		?>

		<?php }  else if($wishlist->type_id == WishList::TYPE_STORE) {


			$store = $wishlist->store; if($store) {


if(isset($store->image_file))
{
	$logo = Yii::app()->createUrl('company/download',array('file'=>$store->image_file,'id'=>$store->create_user_id)) ;
}
else $logo = Yii::app()->theme->baseUrl.'/uploads/2013/brand-logo-50x50.jpg';
?>
		<div class="custom_masnory_post" id="<?php echo $wishlist->id;?>">
			<div class="thumb">

				<div class="brick-header">

					<div class="shop_list_head">

						<div class="brand_logo">
							<img class="featured-thumb" src="<?php echo $logo; ?>"
								alt="image">
						</div>

						<span class="blog_title"><?php echo $store->shop_name;?> </span> <a
							class="cursor" onclick="togglewish(<?php echo $wishlist->id?>)"><span
							class="rating pull-right"><span class="star_fill"></span>
						
						</a>

					</div>

					<div class="mar_top2"></div>

					<div class="thumb-holder">

						<div class="new_tag"></div>

						<a class="featured-thumb-link"
							href="<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id))?>">
							<img class="featured-thumb"
							src="<?php echo Yii::app()->theme->baseUrl;?>/uploads/2013/1370997073a3ce2-200x220.jpg"
							alt="image">
						</a>
					</div>
				</div>

				<div class="brick-footer">
					<span class="blog_content"> <?php echo $store->shop_slogan;?>
					</span>
				</div>

				<div class='link right'>
					<a
						href='<?php echo Yii::app()->createUrl('company/view',array('id'=>$store->id));?>'
						class='btn btn-mini'><?php echo Button::viewButton(Button::BUTTON_STORE)?>
					</a>
				</div>

			</div>
		</div>


		<?php }
}?>



		<?php } 
}?>
	</div>
</div>
<script>
        function togglewish(id){ 


  		  var x = confirm("Are you sure you want to delete?");
		  if (x)
		  {
		$.ajax({

		url: "<?php echo Yii::app()->createUrl('wishList/deleteAjax/id')?>/"+id,
	
		}) .done(function( msg ) {
		if(msg == 'success')
		{
		$('#'+id).remove();		

		}
	
		});
		}
		
	  }
  </script>
