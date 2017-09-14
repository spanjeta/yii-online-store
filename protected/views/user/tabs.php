
<div class="clearfix mar_top2"></div>

<div class="row-fluid main_inner tabs_container">

	<div class="tabs">

		<ul class="">

			<li><?php	echo CHtml::link('Manage My Store',array('home/detail'),array('class'=>$this->isLinkActive(User::ACTIVE_STORE))); ?>
				<ul
					class="tab_drop container <?php  echo $this->isOpen(User::ACTIVE_STORE);?>">

					<li><a href=<?php echo Yii::app()->createUrl('home/detail');?>>Shop
							details</a>
					</li>
					
					<li><a href=<?php echo Yii::app()->createUrl('offer/index');?>>Offer
							& Deals</a>
					</li>
					<li><a href=<?php echo Yii::app()->createUrl('postage/index');?>>Postage
							Management</a>
					</li>
					<li><a href=<?php echo Yii::app()->createUrl('home/warranty');?>>Warranty
							& Care</a>
					</li>

				</ul>
			</li>


			<li><?php	echo CHtml::link('Inventory',array('product/inventory'),array('class'=>$this->isLinkActive(User::ACTIVE_INVENTORY))); ?>
				<ul
					class="tab_drop container <?php  //echo $this->isOpen(Userhttp:toxsl.in/new_ecommerce/::ACTIVE_INVENTORY);?>">
					<li><a
						href=<?php echo Yii::app()->createUrl('product/inventory');?>>List
							Of Products</a>
					</li>
					<?php /**/?>
					<li><a href=<?php echo Yii::app()->createUrl('product/create');?>>Add
							Product</a>
					</li>
					<?php ?>

				</ul>
			</li>
		<li><?php	echo CHtml::link('Orders',array('order/index'),array('class'=>$this->isLinkActive(User::ACTIVE_ORDER)));?>

				<ul
					class="tab_drop container <?php  echo $this->isOpen(User::ACTIVE_ORDER);?>">
					<li><a href=<?php echo Yii::app()->createUrl('order/index');?>>Selling
							Orders</a>
					</li>
				
				

				</ul>
			</li>

			<li><?php	echo CHtml::link('Account Settings',array('user/account'),array('class'=>$this->isLinkActive(User::ACTIVE_ACCOUNT)));?>
				<ul
					class="tab_drop container <?php  echo $this->isOpen(User::ACTIVE_ACCOUNT);?>">
					<li><a href=<?php echo Yii::app()->createUrl('user/account');?>>My
							Info </a>
					</li>

				</ul>
			</li>
			
			<li><?php	echo CHtml::link('My shipping addresses',array('user/shipping'),array('class'=>$this->isLinkActive(User::ACTIVE_SHIPPING))); ?>
			</li>
			
			<li><?php	echo CHtml::link('My credit cards',array('creditCard/index')); ?>
			</li>
			
		

		</ul>
	</div>

