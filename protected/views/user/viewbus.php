<div class="clearfix mar_top2"></div>

<div class="row-fluid main_inner tabs_container">
	<h3>Business User DashBoard</h3>

	<?php //$active = Product::getClass();?>

	<div class="tabs">
		<?php
		echo CHtml::ajaxLink('Dashboard',array('user/dash'),array('update'=>'#bususer'),array('class'=>'btn btn-large current'));
		echo CHtml::ajaxLink('Inventory',array('product/inventory'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Emporium',array('product/emporium'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Offers and deals',array('product/offers'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Blogs',array('blog/my'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Orders',array('product/order'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Messages',array('message/my'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		echo CHtml::ajaxLink('Account Details',array('user/account'),array('update'=>'#bususer'),array('class'=>'btn btn-large'));
		?>
	</div>

	<div id="bususer" class="tabs_inner">
	
	<?php $this->renderPartial('dashboard',array(),false,true);?>
	</div>

</div>



<script>

$(document).ready( function() {
$('a').click(function(){
  var id =  ($(this).attr('id'));

for(var i = 0; i < 8;i++)
{
	$('#yt'+i).removeClass('btn btn-large current');
	$('#yt'+i).addClass('btn btn-large');
}
	
  		$('#'+id).addClass('btn btn-large current');
					

				});
});
	</script>
