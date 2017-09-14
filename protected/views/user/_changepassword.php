<!--  form code start here -->
<hr>
<h3> Change Password </h3>


<div id ="sucs_user" style = "display:none"> 

<h2>
Your password changed successfully
</h2>
</div>

<div id ="ch_pass_error"></div>
<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'user-form_changepass',
	'type'=>'horizontal',
	//'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php echo $form->textFieldGroup($model,'email',array('class'=>'span5','readOnly'=>true)); ?>

<?php 
$model->password = null;
echo $form->passwordFieldGroup($model,'password',array('class'=>'span5')); ?>



<?php echo $form->passwordFieldGroup($model,'password_2',array('class'=>'span5','maxlength'=>512)); ?>



	<div class="form-actions">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>


<!-- form code ends here -->


<script type="text/javascript">

	 $("#user-form_changepass").submit(function(event) {
	 event.preventDefault();
	    var values = $(this).serialize(); 
	    var id = '<?php echo $model->id;?>';
	      $.ajax({
		       url: "<?php echo Yii::app()->createUrl('user/changepassword/id')?>/"+id,
		        type: "POST",
		        data: values,
		        success: function(response){
			  				  	 if(response=='success'){ 
			          		$('#sucs_user').show();
             	          	 return false;
				        	 } 

			  				  	 else{
			  				  		$('#ch_pass_error').html(response);
		             	          	 return false;
			  				  	 }
		        },
		        error:function(){
		
			        return false;
		            		        }
		    });
	     
    });
   </script>