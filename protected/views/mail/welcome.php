<?php include 'header.php';?>
<table width="650" cellspacing="0" cellpadding="0" bgcolor="#fff">
	<tbody>
		<tr>
			<td class="">
				<table width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<td class="body-padding" width="50%">
								<div>

									<table style="position: relative" width="100%" cellspacing="0"
										cellpadding="0" border="0">
										<tbody>
											<tr>
												<h1>Welcome</h1>
												<b><?php echo $model->username;?> </b>											
		<?php																																																																											
		$emailcontent = EmailTemplate::model ()->findByAttributes ( array (
					'key' => 'welcome' 
			) );
			
			if (! empty ( $emailcontent )) {
				$data = trim ( strip_tags ( $emailcontent ) );
				echo "" . $data;
			} else {
				echo "Template Not Set !!!";
			}
			?>                                                                                            
											</tr>
											<tr>
												<p>Lets the fun begins</p>
											</tr>
											<tr>
												<td class="left body-padding" style="padding: 0 0 20px;">
													<button
														style="background: #000000 none repeat scroll 0 0; border: medium none; color: #fff; padding: 12px 23px; border-radius: 22px;">
    <?php echo CHtml::link('Your Account',Yii::app()->createAbsoluteUrl('user/view'),
    		array(
    		'class'=>
    			"btn btn-primary centred"
    ))?>
    
    </button>
												</td>
											</tr>
										</tbody>
									</table>

								</div>
							</td>
							<td><img
								src="<?php echo Yii::app()->theme->baseUrl?>/images/newImages/Girls-Shopping.jpg"
								valign="bottom" alt="Masthead Image" class="" width="90%"
								height="200px" align="middle"></td>


						</tr>
					</tbody>
				</table>
				<table width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<tr>
							<td style="padding-top: 5px;" class="body-padding">
								<table style="margin-top: 10px" class="" width="100%"
									cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
									<tbody>
										<tr>
											<td align="left">
												<table width="100%" cellspacing="0" cellpadding="0"
													border="0">
													<tbody>
														<tr style="margin: 0; padding: 0">

														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<table width="100%" cellspacing="0" cellpadding="0">
					<tbody>

					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<?php include 'footer.php';?>

                   