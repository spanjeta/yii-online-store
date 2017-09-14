
		<div class="menu_main">
		<div class="menu_heading">
		<?php
		
		
		echo ($data->comment);
		
		
		?>
		
		</div>
	
	<div class="menu-text">
		<div class="menu-info">
		<h4>
			<?php echo $data->createUser; ?></h4>
			<span
				class="menu-date"><?php echo date('Y-m-d h:i A',strtotime($data->create_time)); ?></span>
					 <!-- </span> - <span class="menu-rating vd_yellow"><i class="icon-star"></i><i
				class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span> -->

		</div>
	</div>
	
	
	<div class="menu-action">
		<!-- <div class="menu-action-icon vd_green" data-original-title="Approve"
			data-rel="tooltip-bottom">
			<i class="fa fa-check"></i>
		</div>-->
		<?php if(Yii::app()->user->isAdmin){?>
		<div class="menu-action-icon vd_red" data-original-title="Reject"
			data-rel="tooltip-bottom" onClick="deleteComment(<?php echo $data->id;?>)">
			<i class="fa fa-times"></i>
		</div>
		<?php }?>
	</div> 
	</div>

<div class='clearfix'></div>
<br>
<br>
<script>
	function deleteComment(id){
		
		$.ajax({
			url : "<?php echo Yii::app()->createUrl("comment/delete/id")?>"+"/"+id,
			type: "POST",
			success : function(response){
				$("#comment-li-"+id).remove();
				//location.reload();
			}
		});
	
	}
	
</script>