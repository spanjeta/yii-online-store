    
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<div class="image-p-all">
										<a href="<?php echo $data->getUrl();?>">
										<div class="product-box">
										<img
												src="<?php echo $data->thumbnail_file;?>"
												class="center-block img-responsive">
										</div>
									</a>
									<div class="product-box-bottom">
										<a href="<?php echo $data->getUrl();?>"><h2>
										<?php
	$string = strlen ( $data->title );
	if ($string > 20) {
		echo substr ( $data->title, 0, 20 ) . '...';
	} else {
		echo $data->title;
	}
	?></h2></a>
										<p><?php
	$string = strlen ( $data->description );
	if ($string > 20) {
		echo substr ( $data->description, 0, 20 ) . '...';
	} else {
		echo $data->description;
	}
	?></p>
										<div class="bottom-btn-img">
											<div class="col-lg-12 col-md-12">
												<p>
												 <?php 	//$productprice = $data->getProductMarkUpPrice ();?>
													<b>R <?php echo $data->price ?> </b>
												</p>
											</div>
											<div class="col-lg-12 col-md-12 text-center">
											<?php if(Yii::app()->user->isGuest){?>
												<a href="<?php echo Yii::app()->createUrl('user/login');?>" class="btn btn-default add-cart-btn"><i
													class="fa fa-shopping-cart"></i> <span>Add to cart</span></a>
											<?php }else{?>
												<a href="#" class="btn btn-default add-cart-btn" onclick="addCart(<?php echo $data->id;?>)"><i
													class="fa fa-shopping-cart"></i> <span>Add to cart</span></a>
											<?php }?>
											
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
							