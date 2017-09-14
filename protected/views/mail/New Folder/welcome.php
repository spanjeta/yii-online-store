<?php include 'header.php';?>

<p>
	Dear <b><?php echo $model->username;?> </b>
</p>
<br />

<p>
<?php $emailcontent = EmailTemplate::model()->findByAttributes(array(
		'key' => 'welcome'
));

if(!empty($emailcontent)){
	$data = trim(strip_tags($emailcontent));
	echo "".$data;
}
else {
	echo "Template Not Set !!!";
}
?>
</p>

<?php echo CHtml::link('Your Account',Yii::app()->createAbsoluteUrl('user/view'),array('class'=>"btn btn-primary centred"))?>

<?php include 'footer.php';?>

