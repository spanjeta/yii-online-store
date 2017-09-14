 
 
 
 
 
 <div id="header" class="subheader" >
    <div class="header-container container">
	 <div class="row">
      	<div class="fl-nav-menu">
                 <nav>
            <div class="mm-toggle-wrap">
              <div class="mm-toggle"><i class="fa fa-bars"></i><span class="mm-label">Menu</span> </div>
            </div>
            <div class="nav-inner">
              <!-- BEGIN NAV -->
              <ul id="nav" class="hidden-xs nav nav-justified subheader-menu">
                <?php $category = new Category();
                   $mainCategories = $category->getCategories(); 
                   if($mainCategories != null){
                   foreach($mainCategories as $mainCategory){
                   $subcategories = $mainCategory->getSubcategorys();?>
               
               
                <li class="level0 parent drop-menu"><a href="<?php echo Yii::app()->createUrl('product/list',array('id'=>$mainCategory->id))?>"><span><?php echo $mainCategory->title;?></span> </a> 
                <?php if($subcategories != null){?>
                <!--sub sub category-->
                  <ul class="level1">
                  <?php foreach($subcategories as $subcategory){?>
                  <li class="level1 first"><a href="<?php echo Yii::app()->createUrl('product/list',array('id'=>$mainCategory->id,'cat_id'=>$subcategory->id));?>"><span><?php echo $subcategory->title;?></span></a></li>
                 <?php }?>
                                
                  </ul>
                  <?php }?>
                </li>
                <?php }}?>

              </ul>
              <!--nav-->
              </div>
              </nav>
        </div>
        
       <!-- --------------------------mobile view sidebar------------------- --> 
        <div id="mobile-menu">
       <ul class="mobile-menu">
   
    <li>
      <div class="home"><a href="#"><i class="fa fa-remove"></i>Home</a> </div>
    </li>
    <li ><span class="expand fa fa-plus"></span><a  href="#">Pages</a>
      <ul>
        <li><a href="shop0.php">Grid</a> </li>
        <li> <a href="list.html">List</a> </li>
        <li> <a href="product-detail.html">Product Detail</a> </li>
        <li> <a href="shopping-cart.html">Shopping Cart</a> </li>
        <li><span class="expand fa fa-plus"></span><a href="checkout.html">Checkout</a>
          <ul>
            <li><a href="checkout-method.html">Checkout Method</a> </li>
            <li><a href="checkout-billing-info.html">Checkout Billing Info</a> </li>
          </ul>
        </li>
        <li> <a href="wishlist.html">Wishlist</a> </li>
        <li> <a href="dashboard.html">Dashboard</a> </li>
        <li> <a href="multiple-addresses.html">Multiple Addresses</a> </li>
        <li> <a href="about-us.html">About us</a> </li>
        <li><span class="expand fa fa-plus"></span><a href="blog.html">Blog</a>
          <ul>
            <li><a href="blog-detail.html">Blog Detail</a> </li>
          </ul>
        </li>
        <li><a href="contact-us.html">Contact us</a> </li>
        <li><a href="404error.html">404 Error Page</a> </li>
      </ul>
    </li>
    <li><span class="expand fa fa-plus"></span><a  href="#">Women</a>
      <ul>
        <li><span class="expand fa fa-plus"></span> <a href="#" class="">Stylish Bag</a>
          <ul>
            <li> <a href="#" class="">Clutch Handbags</a> </li>
            <li> <a href="#l" class="">Diaper Bags</a> </li>
            <li> <a href="#" class="">Bags</a> </li>
            <li> <a href="#" class="">Hobo handbags</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Material Bag</a>
          <ul>
            <li> <a href="#">Beaded Handbags</a> </li>
            <li> <a href="#">Fabric Handbags</a> </li>
            <li> <a href="#">Handbags</a> </li>
            <li> <a href="#">Leather Handbags</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Shoes</a>
          <ul>
            <li> <a href="#">Flat Shoes</a> </li>
            <li> <a href="#">Flat Sandals</a> </li>
            <li> <a href="#">Boots</a> </li>
            <li> <a href="#">Heels</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Jwellery</a>
          <ul>
            <li> <a href="#">Bracelets</a> </li>
            <li> <a href="#">Necklaces &amp; Pendent</a> </li>
            <li> <a href="#l">Pendants</a> </li>
            <li> <a href="#">Pins &amp; Brooches</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Dresses</a>
          <ul>
            <li> <a href="#">Casual Dresses</a> </li>
            <li> <a href="#">Evening</a> </li>
            <li> <a href="#">Designer</a> </li>
            <li> <a href="#">Party</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Swimwear</a>
          <ul>
            <li> <a href="#">Swimsuits</a> </li>
            <li> <a href="#">Beach Clothing</a> </li>
            <li> <a href="#">Clothing</a> </li>
            <li> <a href="#">Bikinis</a> </li>
          </ul>
        </li>
      </ul>
    </li>
    <li><span class="expand fa fa-plus"></span><a href="#">Men</a>
      <ul>
        <li><span class="expand fa fa-plus"></span> <a href="#" class="">Shoes</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Sport Shoes</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Casual Shoes</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Leather Shoes</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">canvas shoes</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Dresses</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Casual Dresses</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Evening</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Designer</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Party</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Jackets</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Coats</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Formal Jackets</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Leather Jackets</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Blazers</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Watches</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Fasttrack</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Casio</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Titan</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Tommy-Hilfiger</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Sunglasses</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Ray Ban</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Fasttrack</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Police</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Oakley</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#">Accesories</a>
          <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Backpacks</a> </li>

            <li class="level2 nav-6-1-1"><a href="#">Wallets</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Laptops Bags</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Belts</a> </li>
          </ul>
        </li>
      </ul>
    </li>
    
    
    <li><span class="expand fa fa-plus"></span><a href="#">Kids</a>
      <ul>
       
        <li><span class="expand fa fa-plus"></span> <a href="#" class=""><span>Accesories</span></a>
         <ul class="level1">
            <li class="level2 nav-6-1-1"><a href="#">Backpacks</a> </li>

            <li class="level2 nav-6-1-1"><a href="#">Wallets</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Laptops Bags</a> </li>
            <li class="level2 nav-6-1-1"><a href="#">Belts</a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#"><span>Cameras</span></a>
          <ul>
            <li> <a href="#"><span>Camcorders</span></a> </li>
            <li> <a href="#"><span>Point &amp; Shoot</span></a> </li>
            <li> <a href="#"><span>Digital SLR</span></a> </li>
            <li> <a href="#"><span>Camera Accesories</span></a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#"><span>Audio &amp; Video</span></a>
          <ul>
            <li> <a href="#"><span>MP3 Players</span></a> </li>
            <li> <a href="#"><span>IPods</span></a> </li>
            <li> <a href="#"><span>Speakers</span></a> </li>
            <li> <a href="#"><span>Video Players</span></a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#"><span>Computer</span></a>
          <ul>
            <li> <a href="#"><span>External Hard Disk</span></a> </li>
            <li> <a href="#"><span>Pendrives</span></a> </li>
            <li> <a href="#"><span>Headphones</span></a> </li>
            <li> <a href="#"><span>PC Components</span></a> </li>
          </ul>
        </li>
        <li><span class="expand fa fa-plus"></span> <a href="#"><span>Appliances</span></a>
          <ul>
            <li> <a href="#"><span>Vaccum Cleaners</span></a> </li>
            <li> <a href="#"><span>Indoor Lighting</span></a> </li>
            <li> <a href="#"><span>Kitchen Tools</span></a> </li>
            <li> <a href="#"><span>Water Purifier</span></a> </li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#">Furniture</a> </li>
    <li><a href="#">Kids</a> </li>
    <li><a href="contact-us.html">Contact Us</a> </li>
  </ul>
</div></div></div></div>


