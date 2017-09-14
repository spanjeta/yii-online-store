<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">
	
		
	<div class="container">
		
	<div id ="masonry">


		<?php if($blogs)  { 
			foreach($blogs as $blog) {
				if($blog->image_file)
				{
					$img = Yii::app()->createUrl('blog/thumb',array('file'=>$blog->image_file,'id'=>$blog->create_user_id));
				}
				else $img = Yii::app()->createUrl('blog/download',array('file'=>'blog.jpg'));
				?>
	
			<div class="thumb">

				<div class="brick-header">

					<div class="blog_category">
						<span class="blog_title"><?php echo $blog->type;?> </span>



						<?php if(Yii::app()->user->isGuest) { ?>
						<a href="#" onclick="addData()" data-toggle="modal"
						data-target="#myModal"><span
							class="rating pull-right"><span class="star"></span> </span> </a>

						<?php }  else {
							$isfav = $blog->myfav(WishList::TYPE_BLOG);
							if($isfav) $class= 'star_fill'; else $class= 'star'; ?>
						<a class="cursor"
							onclick="toggleFave(<?php echo $blog->id. ','.WishList::TYPE_BLOG?>)"><span
							class="rating pull-right"><span class="<?php echo $class;?>"
								id="<?php echo 'bfav_'.$blog->id;?>"></span>
						
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

				<div class="row-fluid">

					<div class="blog_content">
						<?php echo $blog->truncate($blog->content,150).'...';?>
						<a class="read_more"
							href="<?php echo Yii::app()->createUrl('blog/info',array('id'=>$blog->id)); ?>"><?php echo Button::viewButton(Button::BUTTON_BLOG)?>
						</a>
					</div>


				</div>

			</div>
	


		<?php } 
}?>
	</div>
</div>

<script>
obj_ipin = {},
$(window).load(function(){   
	myrun();

				});


</script>