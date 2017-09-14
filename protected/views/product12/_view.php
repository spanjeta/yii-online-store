  <div class="col-md-6">
						  <div class="list-item">
						    <div class="img-box-outer">
				              <a href="<?php echo $data->getUrl();?>"><img class="img-responsive" src="<?php echo $data->thumbnail_file;?>"/></a>
							</div>
							 <div class="item-desc">
						              <a href="<?php echo $data->getUrl();?>"><?php echo $data->title;?></a>
						              <br/>
									  <span><?php echo $data->product_code;?></span>
									  </br>
									  <?php 	$productprice = $data->getProductMarkUpPrice ();?>
									    Price :<span><?php echo 'R'.$productprice;?></span>
									    </br>
								Color :<span><?php echo $data->getProductColor();?></span>
									</div>
									
										<div class="clearfix"></div>
									</div>
								  </div>