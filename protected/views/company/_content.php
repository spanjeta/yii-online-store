<div class="row-fluid">

<?php if($type == Company::STORE_CONTACT) {?>
	<h3>Contact Us</h3>



	<!--  this section is used for initiate chat box  -->
	<?php if(Yii::app()->user->isGuest) { ?>
	<a
		href="<?php echo Yii::app()->createUrl('company/info',array('id'=>$company->id)); ?>"
		class="span3 pull-right btn">Send Message</a>
		<?php } else if($company->showChat()) { ?>
	<a class="span3 pull-right  btn"
		onclick="create_message_spage(<?php echo  $company->id?>);"> Start
		Messaging</a>
		<?php }?>


	<strong>Ph NO :</strong>
	<?php echo $company->contact_no;?>
	<br> <strong>Email :</strong>
	<?php echo $company->email_contact;

	?>

	<?php }  else if($type == Company::STORE_ABOUT) {?>

	<h3>About Us</h3>

	<p>
	<?php echo $company->about_shop;?>
		.
	</p>

	<?php }  else if($type == Company::STORE_TERMS) {?>

	<h3>Terms & Condition</h3>

	<p>
	<?php echo $company->terms;?>
	</p>


	<?php } else if($type == Company::STORE_DELIVERY) {?>

	<h3>Delivery Info</h3>

	<p>
	<?php echo $company->delivery_info;?>
	</p>


	<?php }?>



</div>
