<?php include 'header.php';?>
<?php $link = $model->getActivationUrl();?>
<p>
	Dear <b><?php echo $model->first_name;?> </b>
</p>

<p>
	Congratulations! You have just registered yourself on a on line shopping Site. In order to begin using our services, please activate your account by clicking on the link below: <br /> <a class="btn"
		href="<?php echo $link;?>">Activate</a>
</p>

<p>
	If above link isn't working, please copy and paste it directly in you browser's URL field to get started.<br />
	<?php echo $link;?>
</p>


<?php include 'footer.php';?>
