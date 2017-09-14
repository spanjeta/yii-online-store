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
		<div class="women-section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<h2 class="category">Brand : <?php echo $model->title;?></h2>
						
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
	</section>
	
	