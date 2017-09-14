<li> 
<?php
/* $class = $data->model_type;
$model = $class::model ()->findByPk ( $data->model_id ); */
?>
<?php

$path = Yii::app ()->basePath . '/../images/feed/';
$img = strtolower ( $data->model_type ) . '.png';
if (! file_exists ( $path . $img ))
	$img = 'event.png';
?>
<div class="menu-item">
		<div class="menu-icon">
			
				<?php echo CHtml::image(Yii::app()->request->baseUrl . '/images/feed/' . $img , 'logo'); ?>

		</div>
		<div class="menu-text"><?php echo $data->content; echo ' ' ;?>
		
				
		</div>
		<div class="menu-text">
			<div class="menu-info">
				by <a><?php echo $data->createUser; ?></a> - <span
					class="menu-date"><?php echo $data->create_time; ?></span>

			</div>
		</div>
	<?php if( Yii::app()->controller->id == 'feed') { ?>
	
		<div class="menu-action">
			<!-- <div data-rel="tooltip-bottom" data-original-title="Approve"
				class="menu-action-icon vd_green">
				<i class="fa fa-check"></i>
			</div> -->
			<a href="<?php echo Yii::app()->createUrl('/feed/delete/id').'/'.$data->id; ?>"><div data-rel="tooltip-bottom" data-original-title="Reject"
				class="menu-action-icon vd_red">
				<i class="fa fa-times"></i>
		</div></a>
	
	<?php } ?>
	</div>
</li>


<?php
/*
 * ?>
 * <li>
 * <div class="menu-icon"><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/avatar/avatar.jpg" alt="example image"></a></div>
 * <div class="menu-text">
 * This product is so good that i manage to buy it 1 for me and 3 for my families. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incidtation ullamco laboris nisi ut aliquip ex tris.
 * </div>
 * <div class="menu-text">
 * <div class="menu-info">
 * in <a href="#">Samsung Galaxy S4</a> -
 *
 * <span class="menu-date">12 Minutes Ago </span> -
 * <span class="menu-rating vd_yellow"><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span>
 *
 * </div>
 * </div>
 * <div class="menu-action">
 * <div data-rel="tooltip-bottom" data-original-title="Approve" class="menu-action-icon vd_green">
 * <i class="fa fa-check"></i>
 * </div>
 * <div data-rel="tooltip-bottom" data-original-title="Reject" class="menu-action-icon vd_red">
 * <i class="fa fa-times"></i>
 * </div>
 * </div>
 * </li>
 *
 * <?php
 */
?>