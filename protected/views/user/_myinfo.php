<style>

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
  border-top: 1px solid #dddddd;
  line-height: 2.5;
  padding: 8px;
  vertical-align:middle;
}

</style>
<div class="border-org my_detail_info">
<h3 class="tabs-inner-heading">Profile</h3>
<div class="row-fluid">
	<div class="span8">
<div class="clearfix mar_top2"></div>
		<?php $this->widget('booster.widgets.TbDetailView', array(
				'data' => $model,
				'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover no-margin'),

				//'url' => $this->createUrl('user/editable'),
				'attributes' => array(
 			//	'id',
 				//'username',
 				'first_name',
 			//	'middle_name',
 				'last_name',
 			    // 'email',
 				'ph_no',
 		),
 )); ?>
	</div>
</div>
</div>



<script>

$(document).ready(function() {

	$('#ch_pass').click(  function() {

		$('#yw1').hide();
		$('#ch_pass_form').show();

		});
});


</script>
