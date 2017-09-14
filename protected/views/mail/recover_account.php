<?php include 'header.php';?>

<div class="white_bg">
<?php $link = $model->getRecoverUrl();?>
	<p>
		Dear <span class="user-name"><?php echo $model->first_name; ?> </span>
	</p>
	<p>

		<a class="btn" href="<?php echo $link;?>"><b>Click here </b> </a> to
		recover your password.
	</p>
		<p>
		<?php $emailcontent = EmailTemplate::model()->findByAttributes(array(
				'key' => 'recover_account'
		));
		if(!empty($emailcontent)){
			$data = trim(strip_tags($emailcontent));
			echo "".$data;
		}else{
			echo "Email Content Not Set";
		}
		?><br />
			<?php echo $link;?>
		</p>
</div>

<?php include 'footer.php';?>