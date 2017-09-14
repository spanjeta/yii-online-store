<!-- Bootstrap -->
<div class="subheader">
	<div class="container">
		<nav class="navbar">
			<div class="navbar-header">
				<button class="navbar-toggle" type="button" data-toggle="collapse"
					data-target=".js-navbar-collapse">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse js-navbar-collapse">
				<ul class="nav nav-justified">
	        
	      	 <?php   
	      	 
	    /*   	 $image [] = [
	      	 	0 => 'Accessories.jpg',
	      	 	1 => 'Upsells.jpg',
	      	 	2 => 'menu3.jpg',
	      	 	3 => 'boys.jpg',
	      	 	4 => 'menu5.jpg',
	      	 	5 => 'men.jpg',
	      	 	6 => 'menu1.jpg',
	      	 ]; */
	      	 
	       			   $category = new Category();
	                   $mainCategories = $category->getCategories(); 
	                   if($mainCategories != null) {
	                   	$i = 0;
	                   		foreach($mainCategories as $mainCategory) {
	                   		$subcategories = $mainCategory->getSubcategorys();
              ?>
	        
	        		<li class="dropdown mega-dropdown">
	        			<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo  Yii::t('app', $mainCategory->title); ?> <span
							class="fa fa-angle-down"></span></a>

							<ul class="dropdown-menu mega-dropdown-menu row">
							<li class="col-sm-3">
								<ul>
									 <img src="<?php echo Yii::app ()->createAbsoluteUrl ( 'product/download', array (
									 		'file' => $mainCategory->image_file
				) );?>" class="img-responsive">
								</ul>

							</li>
							
							<?php if( !empty($subcategories) ) {
								foreach ( $subcategories as $sub ) { ?>
									<li class="col-sm-3">
										<ul>
											<li>
											<a href="<?php echo Yii::app()->createUrl('product/list',array('id'=>$mainCategory->id,'cat_id'=>$sub->id));?>">
											 <?= Yii::t('app', $sub->title);?> 
											 </a>
											</li>
										</ul>
									</li>
							<?php	}
								
							 } ?>
							
							<li class="bottom-block"></li>
						</ul>
					</li>

				<?php $i++; }
	                 
	                }?>


				</ul>

			</div>
			<!-- /.nav-collapse -->
		</nav>
	</div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<!-- Include all compiled plugins (below), or include individual files as needed -->

<script>
    	jQuery(document).on('click', '.mega-dropdown', function(e) {
  e.stopPropagation()
})
    </script>
