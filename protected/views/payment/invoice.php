<!DOCTYPE html>
<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="en" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" />


<!-- blueprint CSS framework -->
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/screen.css"
	media="screen, projection" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print.css"
	media="print" />
<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />



<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<style type="text/css">
.payer {
	text-align: left;
	font-size: 14 px;
	font-weight: bold;
}

body {
	background-color: white;
}

#page-wrap1 {
	width: 650px;
	margin: 0 auto;
	border: 1px solid;
	padding: 10px;
	background: white;
}

div.header {
	background-color: black;
	color: white;
	text-transform: uppercase;
	text-align: center;
	font-size: 24px;
}

table td,table th {
	vertical-align: top;
	border: 1px solid black;
	padding: 5px;
}

}
#logo1 {
	text-align: center;
	float: right;
}

.receiver {
	font-size: 14px;
	font-weight: bold;
	text-align: left;
}

#meta {
	margin-top: 1px;
	width: 250px;
	float: right;
}

#meta td.meta-head {
	text-align: left;
	background: #eee;
	font-weight: bold;
}

#items {
	clear: both;
	width: 100%;
	margin: 30px 0 0 0;
	border: 1px solid black;
}

#items th {
	background: #eee;
}

#terms {
	text-align: center;
	margin: 20px 0 0 0;
}

#terms h5 {
	text-transform: uppercase;
	font: 13px Helvetica, Sans-Serif;
	letter-spacing: 10px;
	border-bottom: 1px solid black;
	padding: 0 0 8px 0;
	margin: 0 0 8px 0;
}

.seller {
	padding-top: 30px;
	size: auto;
}

@media print {
	input#printButton {
		display: none;
	}
}
</style>

</head>

<body>
<div class="pull-right">
	<input type="button" class="btn btn-danger" id="printButton"
		onclick="window.print();" value="Print" />
</div>
	<?php $model = json_decode($model->data); ?>
	<?php if($model) :?>

	<div id="page-wrap1">
	<?php echo Yii::t('thescout','RECEIPT') ?>
		<div class="span4 seller">
			<?php echo "<b>Business :</b>".$model->business;?>
			<br />
			<?php echo "<b>Email :</b>". $model->receiver_email?>
			<br />
			<?php echo "<b> Id :</b>".$model->receiver_id?>
		</div>
		<div class="span4">
			
			<img src="<?php  echo Yii::app()->theme->baseUrl;?>/css/thescout.png"
				alt="logo" width="50%" class="pull-right"/>
				<b><br/>Skynet Italia Srl</b><br/><i>Fiorano Modenese (MO)<br/>VAT  IT01260860117<br/>CCIAA.  113968</i>


				
		</div>
		<div class="row"></div>
		<div class="row"></div>
		<div id="customer" class="span5">
			<div class="payer ">
				To<br>
				<?php echo $model->first_name.' '.$model->last_name.'<br>' .$model->payer_email?>
			</div>
		</div>
		<table id="meta">
			<tr>
				<td class="meta-head">Txn ID</td>
				<td><?php echo $model->txn_id; ?></td>
			</tr>
			<tr>

				<td class="meta-head">Date</td>
				<td><?php echo $model->payment_date; ?></td>
			</tr>

		</table>


		<div class="row"></div>
		<table id="items">

			<tr>
				<th width="374">Item</th>


				<th width="108">Quantity</th>
				<th width="79">Price</th>
			</tr>

			<tr class="item-row">
				<td class="item-name"><div class="delete-wpr">
						<?php echo $model->item_name; ?>
					</div></td>

				<td class="total-value"><?php echo $model->quantity; ?> </td>
				<td class="total-value"><?php echo $model->payment_gross; ?> 
				</td>
			</tr>



			<tr>
				<td colspan="2" class="total-line">Subtotal</td>
				<td width="74" class="total-value"><?php echo $model->payment_gross; ?>
				</td>
			</tr>

			<tr>
				<th colspan="2">Total</th>
				<th class="total-value"><?php echo $model->payment_gross; ?></th>
			</tr>

		</table>

		<div id="terms">

			<h5>Terms</h5>
			Copyright (c) 2013 by Skynet Italia Srl .<br> All Rights Reserved.
		</div>

	</div>

	<?php endif;?>

</body>