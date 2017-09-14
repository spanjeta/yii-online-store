
<h3>My Account</h3>
<div class="row-fluid">
	<div class="span8">

		<?php echo CHtml::link('Change Password','#',array('class'=>'btn btn-gray','id'=>'ch_pass'));?>
		<?php echo CHtml::link('Close My Account','#',array('class'=>'btn btn-danger'));?>

		<div id="ch_pass_form" style="display: none">

			<?php 	$this->renderPartial('_changepassword',array('model'=>$model)); ?>

		</div>
		<div class="clearfix mar_top2"></div>
		<?php $this->widget('booster.widgets.TbEditableDetailView', array(
				'data' => $model,
				'htmlOptions'=>array('class'=>'table table-bordered table-striped table-hover'),

				'url' => $this->createUrl('user/editable'),
				'attributes' => array(
 			
 			     'email',

 				
 		),
 )); ?>
 <div id=" ">





<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'email-form',
	'type'=>'',
     'action'=>$this->CreateUrl('user/emailnotification'),
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>



<?php echo $form->errorSummary($model); ?>





	


	<div class="row-fluid">
	


		<div class=" buttons pull-left span3">
		<?php echo CHtml::submitButton('SUBMIT',array('class'=>'btn btn-primary')); ?>
		</div>


	</div>

	<?php $this->endWidget(); ?>

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

function search(data)
{
	if($("#checkbox").prop('checked') == true){
		$('#Issue_url').val(1);
	}
	else
	{
		$('#Issue_url').val(0);
	}
		
		
		
}



</script>
