<div class="clearfix mar_top3"></div>

<div class="order_summary span7 offset2">

	<center>
		<h4>
			<span><?php echo 'Order Summary';?> </span>
		</h4>
	</center>


	<div class="clearfix mar_top2"></div>
	<?php $this->widget('bootstrap.widgets.TbGridView', array(
			'id' => 'cart-grid',
			'type'=>'bordered', // 'condensed','striped',
			'dataProvider' => $dataProvider,
			'template' => '{items}{pager}',
			'htmlOptions'=>array('class'=>'row-fluid pull-left'), //cart_grid
			'columns' => array(
					//'id',
					array(
							'name'=>'product_id',
							'value'=>'GxHtml::valueEx($data->product)',
					),
					/* 			array(
					 'name' => 'quantity',
							'header' => 'Quantity',
							'class' => 'bootstrap.widgets.TbEditableColumn',
							'headerHtmlOptions' => array('style' => 'width:200px'),
							'editable' => array(
									'type' => 'text',
									'url' => $this->createUrl('editable')
							)
					), */
					'quantity',
					array(
							'name'=>'price',
							'value'=>'$data->getPrice()',
					),
					/*
					 'session_id',
	array(
			'name' => 'state_id',
			'value'=>'$data->getStatusOptions($data->state_id)',
			'filter'=>Cart::getStatusOptions(),
	),
	array(
		'name' => 'type_id',
			'value'=>'$data->getTypeOptions($data->type_id)',
			'filter'=>Cart::getTypeOptions(),
),
	'update_time',
	*/
			),
)); ?>

	<ul class="cart_detail">

		<li><span class="cart_title">Sub Total</span> <span
			class="cart_description"><?php echo $subtotal.'$'; ?> </span>
		</li>


		<li><span class="cart_title">Gst</span> <span class="cart_description"><?php echo  $gst; ?>
		</span>
		</li>

		<li><span class="cart_title">Postage </span> <?php echo $model->postage_charge;?>
			</span>
		</li>

		<li class="order_total"><span class="cart_title">Order Total</span> <span
			class="cart_description"><?php echo $model->amount.'$';?> </span>
		</li>
	</ul>

	<div class="clearfix mar_top4"></div>