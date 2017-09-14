<?php include 'header.php';?>

<div class="white_bg">
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