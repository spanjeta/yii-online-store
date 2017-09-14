<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">
<?php //echo 'include'; exit;?>

<!-- Products come here -->
<?php if($products)  { 
	foreach($products as $product)  {
		$image = $product->getImage();  if($image) {

		?>
<div class="custom_masnory_post">
	<div class="brick-header">
		<?php if(Yii::app()->user->isGuest) { ?>
		<a href="<?php echo Yii::app()->createUrl('wishList/fav');?>"><span
			class="rating pull-right"><span class="star"></span> </span> </a>

		<?php }  else {
			$isfav = $product->myfav(WishList::TYPE_STORE);
			if($isfav) $class= 'star_fill'; else $class= 'star';

			?>
		<a class="cursor"
			onclick="toggleFave(<?php echo $product->id. ','.WishList::TYPE_PRODUCT?>)"><span
			class="rating pull-right"><span class="<?php echo $class;?>"
				id="<?php echo 'fav_'.$product->id;?>"></span>
		
		</a>
		<?php }?>


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
					class='btn btn-mini'>Buy Now</a>
			</div>
			<div class='price left'>
				<?php echo '$'.$product->price;?>
			</div>
		</div>
	</div>
	<div class="brick-footer">
		<div class="masonry-meta">

			<div class="masonry-meta-comment">

				<span class="masonry-meta-content"> <?php echo $product->title;?>
				</span> onto <span class=" masonry-meta-author"><strong> <?php echo $product->company->shop_name;?>
				</strong> </span>
			</div>

			<hr class="thum-hr">

			<div style="" class="masonry-actionbar">
				<a class="ipin-repin btn btn-mini" data-post_id="380" href="#"><i
					class="fa fa-thumb-tack"></i> Repin</a>
				<button class="ipin-like btn btn-mini" data-post_id="380"
					data-post_author="35" type="button">
					<i class="fa fa-thumbs-up"></i> Like
				</button>
				<a class="ipin-comment btn btn-mini" href="#" data-post_id="380"> <i
					class="fa fa-comment"></i> Comment
				</a>
			</div>
		</div>
		<div id="masonry-meta-comment-wrapper-380"></div>
	</div>

</div>

<?php }  
}
}?>

<!-- product div end here -->

<!-- Blog come here -->
<?php 

$blogs = Blog::model()->findAll();

if($blogs)  {
			foreach($blogs as $blog) {
				if($blog->image_file)
				{
					$img = Yii::app()->createUrl('blog/thumb',array('file'=>$blog->image_file,'id'=>$blog->create_user_id));
				}
				else $img = Yii::app()->createUrl('blog/download',array('file'=>'blog.jpg'));
				?>
<div class="custom_masnory_post">
	<div class="thumb">

		<div class="brick-header">

			<div class="blog_category">
				<span class="blog_title"><?php echo $blog->type;?> </span>



				<?php if(Yii::app()->user->isGuest) { ?>
				<a href="<?php echo Yii::app()->createUrl('wishList/fav');?>"><span
					class="rating pull-right"><span class="star"></span> </span> </a>

				<?php }  else {
					$isfav = $blog->myfav(WishList::TYPE_BLOG);
							if($isfav) $class= 'star_fill'; else $class= 'star'; ?>
				<a class="cursor"
					onclick="toggleFave(<?php echo $blog->id. ','.WishList::TYPE_BLOG?>)"><span
					class="rating pull-right"><span class="<?php echo $class;?>"
						id="<?php echo 'fav_'.$blog->id;?>"></span>
				
				</a>
				<?php }?>




				<h4 class="blog_product_title">
					<?php echo $blog->title;?>
				</h4>

				<div class="blog_author">
					<span class="author"><?php echo $blog->createUser;?> </span> <span
						class="blog_date"><?php echo $blog->formatDateTime($blog->create_time); ?>
					</span>
				</div>
			</div>
			<div class="thumb-holder">
				<a
					href="<?php echo Yii::app()->createUrl('blog/info',array('id'=>$blog->id)); ?>"
					class="featured-thumb-link"> <img style="" alt="image"
					src="<?php echo $img;?>" class="featured-thumb">
				</a>
			</div>
		</div>

		<div class="brick-footer">


			<div class="masonry-meta">
				<span class="masonry-meta-comment"> <?php echo strip_tags($blog->truncate($blog->content,150)).'...';?>
					<a class="read_more"
					href="<?php echo Yii::app()->createUrl('blog/info',array('id'=>$blog->id)); ?>">Read
						More</a>
				</span>

			</div>
		</div>

	</div>
</div>


<?php } 
}?>


<!-- Blog End Here -->



<script>

$(document).ready(function(){

	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 600);
			return false;
		});
	});

});
</script>

<p id="back-top" style="display: block;" class="scroll-top">
	<a href="#top"><i class="icon-chevron-up"></i><br />Top</a>
</p>
<!-- scroll top-->

</div>

<div class="clearfix"></div>
