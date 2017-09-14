<?php include('tabuser.php');?>
<div class="tab-pane active tabs_inner">
	<hr>
	<?php
	echo CHtml::link('My Info', array('user/accountb'),array('class'=>'btn btn-gray') );
	//echo CHtml::link('Billing Method', '#',array('id'=>'billing','class'=>'btn btn-gray') );
	//echo CHtml::link('Setting', '#',array('id'=>'usetting','class'=>'btn btn-gray'));
	?>
	<hr>
	<div id="mydetail">
	<?php $this->renderPartial('_myinfo1',array('model'=>$model));?>
	</div>


</div>

<script>
$(document).ready(function(){

$('#billing').click(function(){
	
	var url = "<?php echo Yii::app()->createUrl('company/billing')?>"
		$('#mydetail').load(url);

});
$('#usetting').click(function(){

	var url = "<?php echo Yii::app()->createUrl('company/setting')?>"
		$('#mydetail').load(url);
});
});

</script>
