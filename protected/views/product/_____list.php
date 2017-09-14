<style>
<!--
.slider {
	border-bottom: none !important;
}
-->
</style>
<link rel="stylesheet"
	href="http://seiyria.com/bootstrap-slider/css/bootstrap-slider.css">
<script src="http://seiyria.com/bootstrap-slider/js/bootstrap-slider.js"></script>

<section class="main_wrapper">
	<div class="Men-section"></div>
	<section class="main_wrapper">
		<div class="women-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h2 class="category"><?php echo $category->title;?></h2>
						
					</div>
	
					<div class="col-md-3">
						
						<div class="search-here-box">
							<form action="<?php echo Yii::app()->createUrl('product/list',array('id'=>$id,'cat_id'=>$cat_id));?>">
								<div class="input-group custom-serach-input">
								             <?php $this->widget('bootstrap.widgets.TbTypeahead', array(
                                                'name'=>'q',
                                                'id'=>'products',
                                                
                                                'options'=>array(
                                             
                                                                'source'=>Product::getAllCatProducts($cat_id),
                                                                'items'=>4,
                                                		'class'=>'form-control',
                                                                'matcher'=>"js:function(item) {
                                                                return ~item.toLowerCase().indexOf(this.query.toLowerCase());
}",
                                                ),
)); ?>
								
								<span
										class="input-group-btn">
										<button type="submit" class="search-btn-u">
											<span class="fa fa-search"></span>
										</button>
									</span>
								</div>
							</form>
						</div>
						
						<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id' => 'product-search-form',
	
	'enableAjaxValidation' => true,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
?>

<h1 class="right-cetegories-heading">categories</h1>
						<div class="left-browsebox categoris categori-border right-browsebox">
							<ul class="list-unstyled">
							<?php $subcategories = $category->getSubcategorys();
							if($subcategories){
							foreach($subcategories as $subcategory){
								$class = '';
							if($cat_id != null){
							if($cat_id == $subcategory->id)
							{
								$class = 'checked';
							}
							}?>
								
								<li><span><input type="checkbox" class="checkbox" name="Product[category_id][]" value="<?php echo $subcategory->id;?>" <?php echo $class;?>></span><label><?php echo $subcategory->title;?></label></li>
								<?php }}?>

							</ul>
							</div>
							
								<div class="left-browsebox categoris categori-border">
									<span class="cat-title">Brand</span>
									<?php $brands = $category->getBrandOptions();
							if($brands){?>
									<ul class="list-unstyled brand">
									<?php 
							foreach($brands as $key=>$brand){?>
										<li><span><input type="checkbox" class="checkbox" name="Product[brand_id][]" value="<?php echo $key;?>"></span> <label>
												<?php echo $brand;?>
										</label></li>
										<?php }?>
										
									</ul>
									<?php }?>
								</div>
							
							<div class="left-browsebox categoris categori-border">
									<span class="cat-title">Size</span>
									<?php $sizes = $category->getSizeOptions();
							if($sizes){?>
									<ul class="list-unstyled brand">
									<?php 
							foreach($sizes as $key=>$size){?>
										<li><span><input type="checkbox" class="checkbox" name="Product[size_id][]" value="<?php echo $key;?>"></span> <label>
												<?php echo $size;?>
										</label></li>
										<?php }?>
									
									</ul>
									<?php }?>
								</div>
							<div class="left-browsebox categoris categori-border">
									<span class="cat-title">Colors</span>
									<?php $colors = $category->getColors();
									if($colors){?>
									<ul class="list-unstyled brand">
									<?php 
									foreach($colors as $key=>$color){?>
										<li><span><input type="checkbox" class="checkbox" name="Product[color_id][]" value="<?php echo $key;?>"></span> <label>
												<?php echo $color;?>
										</label></li>
										<?php }?>
									
									</ul>
									<?php }?>
								</div>
			<div class="left-browsebox categoris categori-border">
							<span class="cat-title">Price</span>
							<?php 
/*
       * $prices = Product::getPriceOptions();?>
       * <ul class="list-unstyled no-border">
       * <?php
       *
       * if ($prices != null) {
       * foreach ( $prices as $key => $price ) {
       * ?>
       * <li><span><input type="checkbox" value="<?php echo $key;?>"
       * name="Product[price1][]" class="checkbox"></span> <label> <?php echo $price;?>
       * </label></li>
       *
       *
       *
       * </ul>
       * <?php }}
       */
							?>
							<?php $maxprice = $category->getMaxPrice();?>
							<div class="panel-body">
								<input id="ex1" data-slider-id='ex1Slider' type="text"
									data-slider-min="0" data-slider-max="<?php echo $maxprice?>" data-slider-step="1"
									data-slider-value="[0,<?php echo $maxprice?>]" data-slider-tooltip="hide"
									data-slider-handle="square" /><br>
								<ul class="list-inline center block"
									style="margin: 0; position: relative; left: -5px;">
									<li class="pull-left"><span id="range-slider-lower"
										class="range-span lower">0</span></li>
									<li class="pull-right"><span id="range-slider-higher"
										class="range-span higher"><?php echo $maxprice;?></span></li>
								</ul>

								<input type="hidden" name="Product[price][]" value=""
									id="product_price_range" />

								<div class="clearfix"></div>
								<?php echo Yii::t('app','Min Price');?> <input type="number"
									name="Product[min_price]" value="0" min="0"
									id="product_min_price" class="form-control" /> 
								<?php echo Yii::t('app','Max Price');?> <input type="number"
									name="Product[max_price]" value="<?php echo $maxprice?>" max="<?php $maxprice?>"
									id="product_max_price" class="form-control" />

							</div>

						</div>
			
							
							<?php $this->endWidget(); ?>
					</div>
					<!-- col-md-3 -->
					
					 
						 <div class="col-md-9">
						    <div class="right-side-view">
						   <div class="row">
							<div class="divider-form clearfix">
							<form class="form-horizontal" id="search-form">
				
								<div class="col-md-6">
									
								</div>
								</form>
							</div>
							<!-- divider-form-end -->
							
							
						</div>


						<section class="product-list" id="list">
					 <?php
						$this->widget ( 'zii.widgets.CListView', array (
								'dataProvider' => $dataProvider,
								'pager' => true,
								'emptyText' => '<i class="fa fa-frown-o"></i>  Sorry! No Product Found',
								'itemView' => '_view',
								'ajaxUrl'=>'product/list'
								
								/* 'sortableAttributes' => array (
										//'id',
										//'title',
										//'create_time' 
								)  */
						) );
						?>
					</section>

					</div>
					<!-- col-sm-9 ends -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>

	var start_range = 0;
	var end_range = <?php echo $maxprice?>;

	setPrice( start_range, end_range );
	
	$( "#product-search-form" ).change(function() {
		postForm();
	});

	$("#price_sort_form").change(function() {
		postForm();
	});
	
	$("#filter_btn").click(function(){
		
		var url = "<?php echo Yii::app()->createAbsoluteUrl("product/filterSearch")?>/id/"+<?php echo $id;?>;
		var data = $('#search-form').serialize();
	
		$.ajax({
			url : url,
			type:'POST',
			data:data,
			dataType:'json',
			}).success(function(response){
	    		if(response.status == 'OK'){
	    			$('#list').empty();
	    			$('#list').html(response.html);
	            } 
			});
			return false;
		});
	
	$('#ex1').slider();

	$("#ex1").on("change", function(event) {
		
		//console.log( event.value );
		//console.log( event.value['oldValue'][0] );
		//console.log( event.value['newValue'][0] );

		//console.log( event.value['oldValue'][1] );
		//console.log( event.value['newValue'][1] );

		start_range = event.value['newValue'][0];
		end_range 	= event.value['newValue'][1];

		$("#range-slider-lower").text( start_range );
		$("#range-slider-higher").text( end_range );

		$("#product_min_price").val( start_range );
		$("#product_max_price").val( end_range );

		setPrice( start_range, end_range );
		
		
	});

	function setPrice( start_range, end_range ){

		var product_price = start_range+"-"+end_range;
		$("#product_price_range").val( product_price );
	}

	$("#product_min_price").change(function() {
		var min_price = $(this).val();
		var max_price = $("#product_max_price").val();
		if( Math.floor( min_price ) == min_price && $.isNumeric( min_price ) ){

			setPrice( min_price, max_price );
			
			$('#ex1').slider('setValue',[ parseInt( min_price ), parseInt( max_price ) ]);
			//console.log( $('#ex1').slider('getValue') );
			
			$("#range-slider-lower").text( min_price );
			$("#range-slider-higher").text( max_price );
			
		}else{
			alert("<?php echo Yii::t('app','Only numeric values are accepted'); ?>");
		}
	});

	$("#product_max_price").change(function() {
		var min_price = $("#product_min_price").val();
		var max_price = $(this).val();
		if( $.isNumeric( max_price ) ){

			setPrice( min_price, max_price );
			
			$('#ex1').slider('setValue',[ parseInt( min_price ), parseInt( max_price ) ]);
			
			$("#range-slider-lower").text( min_price );
			$("#range-slider-higher").text( max_price );
			
			
			
		}else{
			alert("<?php echo Yii::t('app','Only numeric values are accepted'); ?>");
		}
	});

	function postForm(){
		
		var url = "<?php echo Yii::app()->createAbsoluteUrl("product/productSearch")?>/id/"+<?php echo $id;?>;
		var data = $('#product-search-form').serialize();
		$.ajax({
			url : url,
			type:'POST',
			data:data,
			dataType:'json',
			}).success(function(response){
				//console.log(response);
	    		if(response.status == 'OK'){
	    			$('#list').empty();
	    			$('#list').html(response.html);
	            } 
		});
		return false;
		
	}
	</script>
	