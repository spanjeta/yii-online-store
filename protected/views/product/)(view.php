<script type="text/javascript"
	src="<?php echo Yii::app()->theme->baseUrl; ?>/lightbox/js/lightbox.js"></script>
<link rel="stylesheet"
	href="<?php echo Yii::app()->theme->baseUrl ?>/lightbox/css/lightbox.css" />
<section class="main_wrapper">
	<div class="internal-p-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5">
					<div>
					<?php
					
					$prodimages = ProductImage::model ()->findAllByAttributes ( array (
							'product_id' => $model->id 
					) );
					?>
					<?php
					if (isset ( $prodimages )) {
						foreach ( $prodimages as $prodimage ) {
							?>
					<a href="<?php echo $prodimage->getProImage();?>" data-title=""
							rel="lightbox[images]" data-lightbox="example-set"> <img
							class="img-responsive"
							src="<?php echo $prodimage->getProImage();?>" alt="image-1"
							id="product_image" />
						</a>
					<?php }}?>
						
					</div>

				</div>
				<div class="p-right-column col-lg-7 col-md-7">
					<h1 class="cart-detail1"><?php echo $model->title;?></h1>
					<p class="detail-price">$<?php echo $model->price;?></p>
					<p class="detail-price1">The hemlines of dresses vary depending on
						the whims of fashion and the modesty or personal taste of the
						wearer.</p>
					<ul class="detail-price2">
						<li>Formal Print</li>
						<li>Formal Print</li>
						<li>Formal Print</li>
					</ul>
					<div class="col-md-6 pad0">
						<div class="product-attributes-label label1">
				<?php
				
$prod_id = $model->prod_id;
				
				?>
				
						<?php
						
						$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
								'action' => Yii::app ()->createUrl ( $this->route ),
								'method' => 'get',
								'id' => 'address-form',
								'type' => 'horizontal' 
						) );
						;
						?>
		<?php echo $form->dropDownList($model, 'size_id', GxHtml::listDataEx(Product::getProdColors($prod_id)), array(
				'htmlOptions' => array(
				'class' => 'color-btn'			
		),
				'prompt' => Yii::t('app', 'Select Color'))); ?>
	
		<?php //echo $form->dropDownList($model, 'size_id',  GxHtml::listDataEx(Product::model()->findAllAttributes(null, true)) , array('prompt' => Yii::t('app', 'Select Color'))); ?>
	<?php $this->endWidget(); ?>
							
							<select class="color-btn">

								<option>Select Color</option>


							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-attributes-label label1 pad0">
							<select class=" color-btn">

								<option>Select Size</option>


							</select>
						</div>
					</div>




					<div class="col-md-12 pad0 cart-add">
						<div class="col-md-6 pad0">
							<a href="" class="cart-wishlist"> Add to wishlist</a>
						</div>
						<div class="col-md-6 pad0">
							<a href="" class="cart-add cart-wishlist"> Add to cart</a>
						</div>
					</div>

				</div>


				<div class="clearfix"></div>


			</div>
		</div>
	</div>







</section>


