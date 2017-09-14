<!-- <p class="modal-body-header">Show</p>-->


<div class="form">

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'my-feed-form',
			'type'=>'horizontal',
			'action'=>$this->createUrl('myFeed/create'),
			/* 				'enableClientValidation'=>true,
			 'clientOptions'=>array(
			 		'validateOnSubmit'=>true,

			 ), */
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>
<?php echo $form->checkBoxRow($model, 'enable_select_all',array('id'=>'selectall')); ?>
<?php echo $form->checkBoxRow($model, 'enable_product',array('class'=>'checkbox1')); ?>

	<?php echo $form->checkBoxRow($model, 'enable_blog',array('class'=>'checkbox1')); ?>

	<?php echo $form->checkBoxRow($model, 'enable_emp',array('class'=>'checkbox1')); ?>

	<?php //echo $form->checkBoxRow($model, 'enable_deal',array('class'=>'checkbox1')); ?>

	<?php echo $form->checkBoxRow($model, 'enable_store',array('class'=>'checkbox1')); ?>

	<?php echo $form->dropDownListGroup($model,'type_id',$model->getTypeOptions()); ?>

	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				//'type'=>'primary',
				'label'=>'Save',
		)); ?>

		<?php $this->widget('booster.widgets.TbButton', array(
				//	'buttonType'=>'submit',
				'url'=>Yii::app()->createUrl('site/index'),
				//'type'=>'primary',
				'label'=>'Cancel',
		)); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->
<script>
$("#my-feed-form").submit(function(event){

	if((doThis()))
	{
		$("#my-feed-form").submit();
	}
	else
	{
		event.preventDefault();
		alert('Missing required fields');
	}

	});
	function doThis()
	{

		var checkedValues = $('input:checkbox:checked').map(function() {
			  return this.value;
							}).get();
		if(checkedValues.length > 0)
			return true;
			return false;
	}

	 $("#my-feed-form").ready(function() {
	     $('#selectall').click(function(event) {  //on click
	         if(this.checked) { // check select status
	             $('.checkbox1').each(function() { //loop through each checkbox
	                 this.checked = true;  //select all checkboxes with class "checkbox1"              
	             });
	         }else{
	             $('.checkbox1').each(function() { //loop through each checkbox
	                 this.checked = false; //deselect all checkboxes with class "checkbox1"                    
	             });        
	         } 
	     });
	    
	 });
	 
</script>
