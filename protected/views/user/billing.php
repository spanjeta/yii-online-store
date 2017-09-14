<?php include(dirname(__FILE__).'/../user/tabs.php');?>
<hr>
<h3>Monthly fee will be deducted from primary account :</h3>

<?php echo CHtml::link('Add Paypal info', '#',array('class'=>'btn btn-primary pull-right','id'=>'pay_pal_link'))?>

<?php $this->widget('booster.widgets.TbGridView', array(
		'id' => 'paypal-info-grid',
		'type'=>'bordered', // 'condensed','striped',
		'template'=>"{pager}\n{items}\n{pager}",
		'dataProvider' => new CActiveDataProvider('PaypalInfo',array('data'=>$paypal)),
		'columns' => array(
				'id',
				'email',
				//'credit_card_no',
				array(
						'name' => 'type_id',
						'value'=>'$data->getTypeOptions($data->type_id)',
						'filter'=>PaypalInfo::getTypeOptions(),
				),
				array(
						'name' => 'state_id',
						'value'=>'$data->getStatusOptions($data->state_id)',
						'filter'=>PaypalInfo::getStatusOptions(),
				),
				array(
			'header'=>'delete',
			'class' => 'CxButtonColumn',
			'template'=>'{delete}',
		),
		),
)); ?>


<div class="clearfix mar_top2"></div>
<hr>
<div class="alert alert-success">
<i class="fa fa-retweet"></i> Here you can update your payment method . This will shown when user purchase your product.
</div>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
		'id' => 'payment-setting-form',
		'type'=>'',
		//'enableAjaxValidation' => true,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>
<?php echo $form->checkBoxRow($paymentMethod, 'paypal'); ?>

<?php echo $form->checkBoxRow($paymentMethod, 'cart'); ?>

<?php echo $form->checkBoxRow($paymentMethod, 'bank_deposit'); ?>

<?php echo $form->checkBoxRow($paymentMethod, 'cash_pickup'); ?>

<?php echo $form->checkBoxRow($paymentMethod, 'cash_delivery'); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			//'type'=>'primary',
			'label'=>'Update',
		)); ?>
</div>

<?php $this->endWidget(); ?>

<script>

$('#payment-setting-form').submit(function(event){

	event.preventDefault();
	var datastring = $("#payment-setting-form").serialize();
	$.ajax({
				url : '<?php echo Yii::app()->createUrl("paymentSetting/ajaxCreate")?>',
				data : datastring,
				type : 'Post',
				success : function(data){
					if(data == 'success')
					{
						alert('Your payment method updated successfully ! Thanks');
					}
					console.log(data);
				}
		});
	});

	</script>

<script>

$('#pay_pal_link').click(function(){

var url = '<?php echo Yii::app()->createUrl('paypalInfo/create')?>';

$('#paypal-info-grid').load(url);
});

</script>
<div id="payment-setting-form1"></div>
<script>
$('#payment-setting-form1').submit(function(){
alert('ddf');
	
});
</script>
