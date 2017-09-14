<link href="<?php echo Yii::app()->theme->baseUrl;?>/css/maj.css"
	rel="stylesheet">

<div class="clearfix"></div>




</div>


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




