 <table width="650" cellspacing="0" cellpadding="0" border="0" bgcolor="#000000">
                        <tbody>
                            <tr>
                                <td style="padding:15px 0; color: #fff;font-weight:500;font-family: sans-serif;font-size: 13px;line-height: 170%;text-align: center;" height="5" align="center">&copy; 
                                <?php echo CHtml::link(' Contact Us ',Yii::app()->createAbsoluteUrl('site/contact'))?>
                                </td>
                                <td>
                                <?php echo CHtml::link('About Us ',Yii::app()->createAbsoluteUrl('site/about'))?>
                                </td>
                                <td>
                                <?php echo CHtml::link(' FAQ ',Yii::app()->createAbsoluteUrl('site/faq'))?>
                                </td>
                                <td>
                                <?php echo CHtml::link(' Privacy Policy ',Yii::app()->createAbsoluteUrl('site/privacy'))?>
                                </td>
                            </tr>
                            <tr>
                            	<td colspan="4">
                            	Copyright &copy;
			<?php echo date('Y'); ?>
			by
			<?php echo CHtml::encode(Yii::app()->params['company'])?>
			. All Rights Reserved.
                            	</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>