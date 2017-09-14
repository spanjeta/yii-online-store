<?php // include('active_class.php');

if($this->id == 'user' && $this->action->id == 'changeemail')
$prodi = 'btn btn-primary';
else $prodi = 'btn';

if($this->id == 'user' && $this->action->id == 'shipproduct')
$prode = 'btn btn-primary';
else $prode = 'btn';



if($this->id == 'user' && $this->action->id == 'shipping')
$blog = 'btn btn-primary';
else $blog = 'btn';

if($this->id == 'order' && $this->action->id == 'buy')
$porder = 'btn btn-primary ';
else $porder = 'btn';


if($this->id == 'user' && $this->action->id == 'accountb')
$uab = 'btn btn-primary ';
else $uab = 'btn';



?>

<div class="clearfix mar_top2"></div>
<br/>
<div class="row-fluid main_inner basic_user_tabs">

<div class="container">
	<div class="tabs">
	<?php

	
	echo CHtml::link('My orders',array('order/buy'),array('class'=>$porder));
	echo CHtml::link('My account settings',array('user/accountb'),array('class'=>$uab));
	echo CHtml::link('My shipping addresses',array('user/shipping'),array('class'=>$blog));
	/* echo CHtml::link('My e-mail settings',array('user/changeemail'),array('class'=>$prodi)); */
	/* echo CHtml::link('Shipping',array('user/shipproduct'),array('class'=>$prode)); */

	

	?>
	</div>
	</div>