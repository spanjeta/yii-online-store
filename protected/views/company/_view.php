

<div class="view">
	<?php 
	$img =	isset($data->images) && !empty($data->images) ?  $data->images[0]->image_path :'default.png' ;
	echo CHtml::link(CHtml::image(Yii::app()->createUrl('product/download',array('file'=>$img))),
				array('user/product'))?>
	<div class="clearfix"></div>
	<div class="masonry-pin-middle">
		<div class="price pull-left">
			<?php echo '$'.$data->price;?>
		</div>
		<div class="link pull-right">
			<a class="btn btn-mini"
				href="<?php echo Yii::app()->createUrl('user/product');?>">Buy Now</a>
		</div>
	</div>
	<!------  masonry-pin-middle ------>

	<div class="clearfix"></div>

	<!------  brick-footer ------>
	<div class="brick-footer">
		<div class="masonry-meta">

			<div class="masonry-meta-comment">

				<span class="masonry-meta-content"> <a
					href="<?php echo Yii::app()->createUrl('user/product');?>"> <?php echo $data->title ?>
				</a>
				</span> onto <span class=" masonry-meta-author"><strong>&ndash;
						Gupta Sells &ndash; </strong> </span>
			</div>

			<hr class="thum-hr">

			<div class="masonry-actionbar" style="">
				<a href="#" data-post_id="380" class="ipin-repin btn btn-mini"> <i
					class="fa fa-thumb-tack"></i> Repin
				</a>
				<button type="button" data-post_author="35" data-post_id="380"
					class="ipin-like btn btn-mini">
					<i class="fa fa-thumbs-up"></i> Like
				</button>
				<a data-post_id="380" href="#" class="ipin-comment btn btn-mini"> <i
					class="fa fa-comment"></i> Comment
				</a>
			</div>
		</div>
		<div id="masonry-meta-comment-wrapper-380"></div>
	</div>
	<!------  brick-footer ------>


</div>
<div class="clearfix"></div>
