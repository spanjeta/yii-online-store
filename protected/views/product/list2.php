<section class="main_wrapper">
	<div class="Men-section"></div>
	<section class="main_wrapper">
		<div class="women-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h2 class="category text-center">WHOLE SALE WOMENS DRESSES</h2>
						<p class="cart-list text-center">A dress (also known as a frock or a gown) is a garment consisting of a skirt with an attached bodice (or a matching bodice giving the effect of a one-piece garment).[1] It consists of a top piece that covers the torso and hangs down over the legs. A dress can be any one-piece garment containing a skirt of any length. Dresses can be formal or informal. In many cultures, dresses are more often worn by women and girls.</p>
						
					</div>
					<div class="col-md-12 pad0">
						<div class="col-md-3">
							
							<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
								'id' => 'product-search-form',
								
								'enableAjaxValidation' => true,
								'htmlOptions'=>array('enctype'=>'multipart/form-data'),
							));
							?>

							<h1 class="product-listing">Brands</h1>
							<div class="left-browsebox categoris categori-border right-browsebox cart-brand">
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
									<div class="cart-border clearfix">
										<div class="col-md-6 pad0">
											<span class="product-color">Color</span>
										</div>
										<div class="col-md-6 text-right pad0">
											<i class="fa fa-plus " aria-hidden="true"></i>
										</div>
									</div>
									<div class="col-md-12 pad0">
										<ul class="list-inline list-select clearfix">
											<li class="color"><a href="#" class="color1"></a></li>
											<li class="color"><a href="#" class="color2"></a></li>
											<li class="color"><a href="#" class="color3"></a></li>
											<li class="color"><a href="#" class="color4"></a></li>
										</ul>
									</div>
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
									<div class="cart-border clearfix">
									<div class="col-md-6 pad0">
										<span class="product-color">Price</span>
										</div>
										<div class="col-md-6 text-right pad0">
											<i class="fa fa-plus " aria-hidden="true"></i>
										</div>
										</div>
										 <div data-role="page" class="price-bar">
	                                    <div data-role="main" class="ui-content">
	                                        <form method="post" action="/action_page_post.php">
	                                            <div data-role="rangeslider">
	                                                <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
	                                            </div>
	                                        </form>
	                                    </div>
	                                </div>
									</div>
								
								<div class="left-browsebox categoris categori-border">
										<div class="cart-border clearfix">
									<div class="col-md-6 pad0">
										<span class="product-color">Size:</span>
										</div>
										<div class="col-md-6 text-right pad0">
											<i class="fa fa-plus " aria-hidden="true"></i>
										</div>
										</div>
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
						<div class="text-right">
							<nav aria-label="Page navigation">
							  <ul class="pagination">
							    <li>
							      <a href="#" aria-label="Previous">
							        <span aria-hidden="true">&laquo;</span>
							      </a>
							    </li>
							    <li><a href="#">1</a></li>
							    <li><a href="#">2</a></li>
							    <li><a href="#">3</a></li>
							    <li><a href="#">4</a></li>
							    <li><a href="#">5</a></li>
							    <li>
							      <a href="#" aria-label="Next">
							        <span aria-hidden="true">&raquo;</span>
							      </a>
							    </li>
							  </ul>
							</nav>
						</div>
					<!--<div class="col-md-4 pull-right search">
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
										<button type="submit" class="search-btn-u cart-search">
											<span class="fa fa-search"></span>
										</button>
									</span>
								</div>
							</form>
						</div>-->
						<div class="row product-listing">
							<div class="cart-row clearfix">
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
								<div class="col-md-3 ">
									<div class="product">
										<img src="<?php echo Yii::app()->theme->baseUrl?>/images/gift3.jpg" class="placeholder placeholder-landscape width-full img-thumbnail" alt="">
						    			<div class="product-inner">
						                    <div class="actions">
						                        <div class="rating">
						                            <ul class="list-inline">
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                                <li><i class="fa fa-star"></i></li>
						                            </ul>
						                        </div>
						                        <div class="add-to-wishlist">
						                            <a href="#"><i class="fa fa-heart-o"></i></a>
						                        </div>
						                    </div>
						    				<p class="product-details text-center">Pellentesque habitant morbi tris...</p>
						    				<p class="product-price text-center">$65867</p>
					    					<div class="middle">
					    						<div class="text">Add To Cart</div>
					  						</div>
						    		    </div>
						    		</div>
								</div>
							</div>
							<div class="text-right">
								<nav aria-label="Page navigation">
								  <ul class="pagination">
								    <li>
								      <a href="#" aria-label="Previous">
								        <span aria-hidden="true">&laquo;</span>
								      </a>
								    </li>
								    <li><a href="#">1</a></li>
								    <li><a href="#">2</a></li>
								    <li><a href="#">3</a></li>
								    <li><a href="#">4</a></li>
								    <li><a href="#">5</a></li>
								    <li>
								      <a href="#" aria-label="Next">
								        <span aria-hidden="true">&raquo;</span>
								      </a>
								    </li>
								  </ul>
								</nav>
							</div>
					</div>













					</div>
					<!-- col-sm-9 ends -->
					</div>
				</div>				
			
				</div>
				</div>
				</div>
				</div>
				</div>
			</div>
		</div>
	</section>
	
	</section>