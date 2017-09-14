<section class="content-header">
	<h1>
			<?php echo Yii::t('app','manage') . ' : ' . Html::encode(Yii::t('app',$model->label(2))); ?>
	
	</h1>

</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">

				<div class="box-header with-border">
<?php

$this->widget ( 'booster.widgets.TbMenu', array (
		'items' => $this->actions,
		'type' => 'success',
		'htmlOptions' => array (
				'class' => 'pull-right' 
		) 
) );
?>
					<div class="pull-right">
						<div class="white-box">




							<div class="clearfix"></div>
						</div>




					</div>
				
	<?php
	
	/*
	 * $this->widget ( 'booster.widgets.TbMenu', array (
	 * 'type' => 'navbar',
	 * 'items' => $this->actions,
	 * 'htmlOptions' => array (
	 * 'class' => 'pull-right btn-group'
	 * )
	 * ) );
	 */
	?>
					
				
				</div>
				<!-- /.box-header -->
				<div class="box-body">

				<?php 	if(Yii::app()->user->hasFlash('delete')) { ?>
		<div class="alert alert-danger">
		<?php
					
					echo Yii::app ()->user->getFlash ( 'delete' );
					
					?>
			<button data-dismiss="alert" class="close" type="button">×</button>
					</div>
		<?php }?>
	
<div id="list_data">

		<?php
		
		$this->widget ( 'booster.widgets.TbGridView', array (
				'id' => 'product-grid',
				'type' => 'striped bordered condensed',
				'htmlOptions' => array (
						'style' => 'cursor: pointer;' 
				),
				'selectionChanged' => "function(id){window.location='" . Yii::app ()->createAbsoluteUrl ( 'product/view' ) . "/' + $.fn.yiiGridView.getSelection(id);}",
				'pager' => true,
				'dataProvider' => $model->search (),
				'filter' => $model,
				'columns' => array (
						// 'id',
						'title',
						
						// 'description',
						'price',
						
						'quantity',
						array (
								'name' => 'category_id',
								'value' => isset($data->category_id) ? $data->getCategoryOptions($data->category_id) :"" ,
								'filter' => Product::getCategoryOptions () 
								//return Product::getCategoryOptions () ,
						), 
						
		
			
		/*
		 'related_items',
		'thumbnail_file',
		'image_file',
		'category_id',
		'product_size',
		'product_color',
		'quantity',
		'discount_price',
		'price',
		'discount',
		'tax',
		'tax_amount',
		array(
				'name' => 'type_id',
				'value'=>'$data->getTypeOptions($data->type_id)',
				'filter'=>Product::getTypeOptions(),
				),
		array(
				'name' => 'state_id',
				'value'=>'$data->getStatusOptions($data->state_id)',
				'filter'=>Product::getStatusOptions(),
				),
		'update_time',
		*/
						array (
								'header' => '<a>Actions</a>',
								'class' => 'booster.widgets.TbButtonColumn',
								'htmlOptions' => array (
										'nowrap' => 'nowrap' 
								) ,
						) 
				) 
		) );
		?>
		</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	
	 $('#product-form').submit(function(e) {
		 e.preventDefault();
		
		 $.ajax({
			 url: "<?php echo Yii::app()->createUrl('product/search/')?>",
			data : $('#product-form').serialize(),
			type : "POST",
			}).success(function(response){
				$('#list_data').empty();
				$('#list_data').append(response);
				
				
			});
		    	
		   
});
	 </script>

