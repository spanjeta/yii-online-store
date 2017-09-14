<div class="form well">

	<hr>
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'review-form',
	'type'=>'horizontal',
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>


	<div class="offset1">
	<?php //echo $form->radioButtonListRow($model,'rating_id',Feedback::getRating());
	$this->widget('CStarRating',array('name'=>'Review[star_count]','minRating'=>1,
'maxRating'=>5,
'starCount'=>5,

	)

	); ?>
	</div>
	<div class="clearfix mar_top2"></div>
	
	<?php echo $form->textAreaRow($model,'comment',array('class'=>'span5','rows'=>6,'maxlength'=>1024)); ?>

	<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
	)); ?>

	<?php $this->widget('booster.widgets.TbButton', array(
	//	'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Cancel',

	  'htmlOptions'=>array(
       'onclick'=>'$("#ajaxReview").hide()'
       ),
       )); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form code ends here -->
<script>

  $('#review-form').submit(function(event){

	  var id = '<?php echo $id?>';

	  event.preventDefault();
	  $.ajax({
			type : 'Post',
			url : '<?php echo Yii::app()->createUrl('review/create/id');?>/'+id,
			data : $(this).serialize(),

		success:function(data){
			$('#success_mess').show();
			$('#ajaxReview').hide();

			}


		  });

  });

</script>