
<ul class="cart_detail">

	<li><span class="cart_title">Sub Total</span> <span
		class="cart_description"><?php echo $subtotal.'$'; ?> </span>
	</li>


	</span>
	</li>

	<li><span class="cart_title">Postage </span> <span
		class="cart_description"> <?php echo CHtml::link('ADD POSTAGE OPTION',
						'#postage_opt_'.$model->id,array('class'=>'btn pull-left',  
						'onclick'=>"showpostage(' " .$model->id. " ')"));?> <?php echo '$' .$model->postage_charge; ?>
	</span>


		<div class="clearfix"></div>


		<div id="postage_opt_<?php echo $model->id;?>" style="display: none;">

			<div id="postage_opt">

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
						onclick='checkPostage(<?php echo $model->id;?> )'>Confirm</a> 
				</div>

			</div>
		</div>
	</li>

	<li class="order_total"><span class="cart_title">Order Total</span> <span
		class="cart_description"><?php echo $model->amount.'$';?> </span>
	</li>
</ul>
