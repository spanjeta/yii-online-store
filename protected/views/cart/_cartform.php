<div class="clearfix mar_top2"></div>
<div class="well span8">
<?php echo CHtml::link('Back',array('cart/payment','cart_id'=>$cart_id),array('class'=>'btn'));?>
	<h2 class="content-tittle">Pay By Credit Card :</h2>

	<p>Enter your credit card details</p>
	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id' => 'creditcard-form',
	'type'=>'horizontal, row-fluid',
	//'action'=> Yii::app()->createUrl('creditCard/pay',array('id'=>$id)),
	//'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	));
	?>

	<?php echo $form->errorSummary($model); ?>
	<p class="includes">
		Includes: &nbsp; <img
			src="<?php echo Yii::app()->theme->baseUrl; ?>/img/cards.png"
			alt="payment method" />
	</p>
	<div class="clr"></div>

	<hr>

	<?php echo $form->labelEx($model,'credit_card_no'); ?>
	<?php echo $form->textField($model,'credit_card_no',array('class'=>'span5')); ?>
	<?php //echo $form->error($model,'credit_card_no'); ?>


	<div class="clr"></div>
	<?php echo $form->labelEx($model,'exp_date'); ?>
	<?php echo $form->textField($model,'exp_date',array('class'=>'span5','id'=>'datepicker')); ?>

	<div class="clr"></div>
	<?php echo $form->labelEx($model,'credit_card_type'); ?>

	<?php echo $form->dropDownList($model,'credit_card_type',CreditCard::getCards(), array('class'=>'span5')); ?>


	<?php //echo $form->error($model,'credit_card_type'); ?>
	<div class="clr"></div>
	<div class="clr"></div>
	<?php echo $form->labelEx($model,'cvv'); ?>
	<?php echo $form->textField($model,'cvv',array('class'=>'span5')); ?>

	<?php //echo $form->error($model,'cvv'); ?>
	<div class="clr"></div>
	<div class="clr"></div>
	<div class="help">
		<p>
			Your Card Verification Value (CVV) consists of the last three digits
			of the <br /> number on the back of your credit card near your
			signature, 4 digits on front of AMEX
		</p>
		<div class="clr"></div>

		<hr>

		<div class="clr"></div>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Pay' : 'Pay',array('class'=>'btn btn-primary')); ?>

		<?php $this->endWidget(); ?>

	</div>


	<link rel="stylesheet"
		href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
	<script type="text/javascript">
$(function() {
$('#datepicker').datepicker({
changeMonth: true,
changeYear: true,
yearRange :'2013:2040',
dateFormat: 'mmyy',
onClose: function(dateText, inst) {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
$(this).datepicker('setDate', new Date(year, month, 1));

},
beforeShow: function(input, inst) {
if ((datestr = $(this).val()).length > 0) {
year = datestr.substring(datestr.length - 4, datestr.length);
month = jQuery.inArray(datestr.substring(0, datestr.length - 5), $(this).datepicker('option', 'monthNames'));
$(this).datepicker('option', 'defaultDate', new Date(year, month, 1));
$(this).datepicker('setDate', new Date(year, month, 1));

}
}
});
});
</script>
	<style>
.ui-datepicker-calendar {
	display: none;
}
</style>

</div>
