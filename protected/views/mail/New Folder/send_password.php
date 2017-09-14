<?php include 'header.php';?>

<p>
	Dear <b><?php echo $model->first_name;?> </b>
</p>
<br />
<p>Please click on below link to access your username and password.</p>
<p>
	<?php echo CHtml::link(' New Password',Yii::app()->createAbsoluteUrl('user/viewPassword',array('email'=>$model->email)));?>
</p>

<br />
<br />
<?php include 'footer.php';?>
