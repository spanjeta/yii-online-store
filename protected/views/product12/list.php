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
									<ul class="list-unstyled  no-border">
									<?php 
							foreach($sizes as $key=>$size){?>
										<li><span><input type="checkbox" class="checkbox" name="Product[size_id][]" value="<?php echo $key;?>"></span> <label>
												<?php echo $size;?>
										</label></li>
										<?php }?>
									
									</ul>
									<?php }?>
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
	$( "#product-search-form" ).change(function() {
		var url = "<?php echo Yii::app()->createAbsoluteUrl("product/productSearch")?>/id/"+<?php echo $id;?>+'/cat_id/'+<?php echo $cat_id;?>;
		var data = $('#product-search-form').serialize();
		$.ajax({
			url : url,
			type:'POST',
			data:data,
			dataType:'json',
			}).success(function(response){
				console.log(response);
	    		if(response.status == 'OK'){
	    			$('#list').empty();
	    			$('#list').html(response.html);
	            } 
			});
			return false;
		
		});
	$("#filter_btn").click(function(){
		
		var url = "<?php echo Yii::app()->createAbsoluteUrl("product/filterSearch")?>/id/"+<?php echo $id;?>+'/cat_id/'+<?php echo $cat_id;?>;
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
	</script>