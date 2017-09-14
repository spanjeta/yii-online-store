
<ul class="cart_detail">

	<li><span class="cart_title">Sub Total</span> <span
		class="cart_description"><?php echo $subtotal.'$'; ?> </span>
	</li>

	<li><span class="cart_title">Coupan</span> <span
		class="cart_description">
			<div class="pull-left">
				<input type="text" id="c_code" name="coupon_code"
					class="span2 coupon_code" value="" />
					<?php echo CHtml::link('Apply','#',array('class'=>'btn btn-gray','onclick'=>'checkCoupon()')); ?>
			</div> <?php echo '- '.$model->coupon_amount .' $'; ?> </span>
	</li>

	<li><span class="cart_title">Gst</span> <span class="cart_description"><?php echo $gst.'$'; ?>
	</span>
	</li>

	<li><span class="cart_title">Postage </span> <span
		class="cart_description"> <?php echo CHtml::link('<i class="fa fa-plus-square"></i> &nbsp; ADD POSTAGE OPTION','#postage_opt',array('class'=>'btn pull-left',  'onclick'=>"showpostage()"));?>
		<?php echo $model->postage_charge.'$'; ?> </span>

		<div id="postage_opt" style="display: none;">

		<?php
		echo CHtml::radioButtonList('postage_id',$model,$model->addpostage(),array(
					'labelOptions'=>array('class'=>'span6'), // add this code
					'separator'=>'<hr> ',
					'id'=>$model->id,
		//'onclick'=>'checkPostage(this)'
		));
		?>
			<div class="clearfix"></div>

			<div class="form-action">
				<a class="btn btn-primary btn-orange"
					onclick='checkPostage(<?php echo $model->id;?> )'>Confirm</a> <a
					class="btn btn-primary btn-gray"
					onclick="$('#postage_opt').hide();">Cancel</a>
			</div>

		</div>
	</li>

	<li class="order_total"><span class="cart_title">Order Total</span> <span
		class="cart_description"><?php echo $model->amount.'$';?> </span>
	</li>
</ul>
