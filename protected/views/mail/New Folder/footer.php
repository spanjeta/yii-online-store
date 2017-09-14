<table width="650" cellspacing="0" cellpadding="0" border="0" bgcolor="#000000">
                        <tbody>
                            <tr>
                                <td id="footer">
	
	<?php echo CHtml::link('About Us ',Yii::app()->createAbsoluteUrl('site/about'))?>
		| <?php echo CHtml::link(' Contact Us ',Yii::app()->createAbsoluteUrl('site/contact'))?>
		| <?php echo CHtml::link(' FAQ ',Yii::app()->createAbsoluteUrl('site/faq'))?>
		 <?php echo CHtml::link(' Privacy Policy ',Yii::app()->createAbsoluteUrl('site/privacy'))?>
		<p>
			Copyright &copy;
			<?php echo date('Y'); ?>
			by
			<?php echo CHtml::encode(Yii::app()->params['company'])?>
			. All Rights Reserved.<br />
		</p>
	</td>
                            </tr>
                        </tbody>
                    </table>

<p>
	Sincerely,<br> Admin .
</p>
</td>
</tr>

</table>
</body>
</html>
