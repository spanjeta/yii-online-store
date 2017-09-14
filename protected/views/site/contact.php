<!--  form code start here -->
<section class="container">
<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">


<h3><?php echo Yii::t('app', 'contact us')?></h3>
<hr>




<?php if(Yii::app()->user->hasFlash('contact')): ?>
<div class="alert alert-success ">
<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
<?php else : ?>


<div class="row-fluid">

<div class="span6">

	<div class="contact_map">


			<p><i class="fa fa-map-marker"></i><?php echo Yii::t('app', 'address 1 ')?> </p>
			
			<p><i class="fa fa-phone f_left color_dark"></i> 0900 - 800 00 00	</p>
			
			<p><i class="fa fa-envelope f_left color_dark"></i>
			 <a href="#">admin@flatastic.com</a></p>
			 
			 
			 <hr>
			 
			 
			 
<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en-US&amp;geocode=&amp;saddr=&amp;daddr=&amp;sll=40.661108,
-73.965111&amp;sspn=0.188816,0.41851&amp;gl=US&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=50.02446,107.138672&amp;t=m&amp;z=4&amp;
output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en-US&amp;geocode=&amp;saddr=&amp;daddr=&amp;sll=40.661108,-73.965111&amp;sspn=0.188816,0.41851&amp;gl=US&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=50.02446,107.138672&amp;t=m&amp;z=4" 
style="color:#0000FF;text-align:left"><?php echo Yii::t('app', 'view larger map ')?> </a></small>
					 
			 
			 
			 
			 
			 
			 
			 



	</div>
	<!-- Contact Map -->
</div>
<!--  span6   -->



<div class="form  span5">

<h4>Contact Form</h4>
<hr>


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
			'id' => 'color-form',
			//'type'=>'',
			'enableAjaxValidation' => true,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<?php //echo $form->errorSummary($model); ?>


<?php echo $form->textFieldGroup($model,'subject',array('class'=>'row-fluid','maxlength'=>256)); ?>

<?php echo $form->textFieldGroup($model,'email',array('class'=>'row-fluid','maxlength'=>256)); ?>


</br>

<?php //secho $form->textAreaRow($model,'body',array('class'=>'row-fluid','maxlength'=>256,'rows'=>5,'cols'=>6)); ?>


	<hr>


	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Send',
	//'htmlOptions'=>array('class'=>'row-fluid'),

	)); ?>


	<?php $this->widget('booster.widgets.TbButton', array(
	//'buttonType'=>'submit',
			//'type'=>'primary',
			'url'=>$this->createUrl('site/index'),
			'label'=>'Cancel',
	//'htmlOptions'=>array('class'=>'row-fluid'),

	)); ?>

	<?php $this->endWidget(); ?>

	<?php endif;?>
</div>
<!-- form code ends here -->






</div> <!-- ROW-FLUID -->

</div>
</div>
</div>
</div>
</section>


