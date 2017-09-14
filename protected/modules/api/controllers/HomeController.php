<?php

class HomeController extends GxController {

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('view','refine', 'search','advSearch','locSearch','tabcontent',
								'download', 'thumbnail','sort','content','html','megaMenu','psearch'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update','index'),
						'users'=>array('@'),
		),
		array('allow',
						'actions'=>array('admin','delete'),
						'expression'=>'Yii::app()->user->isAdmin',
		),
		array('deny',
						'users'=>array('*'),
		),
		);
	}

	public function actionHtml()
	{
		$html[] = array('id'=>1,'title'=>'1. this is owesome product<br>2. this having warranty.<br>3. nice look.<br><b>4. i like this</b><br>');
		$arr['html'] = $html;
		$this->sendJSONResponse($arr);
	}
	/**
	 * This api is using of showing the megamenu on tab like web
	 * Enter description here ...
	 */
	public function actionMegaMenu()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$categories = Category::model()->findAll();
		$criteria = new CDbCriteria;
		$criteria->addCondition('feature_site = 1');
		$featureproducts = Product::model()->findAll($criteria);

		foreach($categories as $category)
		{
			$json_cat[] = $category->toArray();
		}
		foreach($featureproducts as $featureproduct)
		{
			$json_product[] = $featureproduct->toArrayMini();
		}
		$arr['status'] = 'OK';
		$arr['categories'] = $json_cat;
		$arr['products'] = $json_product;

		$this->sendJSONResponse($arr);
	}
	public function actionUpdate()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$json = array();

		//$_POST['Home']['imagids']=('4,3,5');
		if (isset($_POST['Home']))
		{

			$i = 0;
			$j = 0;
			$posts = null;
			$images = null;
			$slogan = null;
			if(isset($_POST['Home']['imagids']) && !empty ($_POST['Home']['imagids']))
			{
				$images = ($_POST['Home']['imagids']);
					
			}
			if(isset($_POST['Home']['postids']) && !empty ($_POST['Home']['postids']))
			{
				$posts = ($_POST['Home']['postids']);
			}
			if(isset($_POST['Home']['slogan']) && !empty ($_POST['Home']['slogan']))
			{
				$slogan = ($_POST['Home']['slogan']);
			}

			$criteria = new CDbCriteria;
			$criteria->addCondition('create_user_id ='. Yii::app()->user->id);
			$sliders = SliderImage::model()->findAll($criteria);
			$homes = Home::model()->findAll($criteria);

			if(isset($images) && !empty($images))
			{
				$imagepos = explode(',',$images);

				foreach($imagepos as $key=>$value)
				{


					$slider = SliderImage::model()->findByPk($value);

					$slider->order_no = $key;
					

					if($slider->save())
					{
						$json[] = $slider->order_no;
					}
					else {
						$err = '';
						foreach( $slider->getErrors() as $error)
						$err .= implode( ".",$error);
						$arr['error'] = $err;
					}

				}
			}

			if(isset($posts) && !empty($posts))
			{
				$homepos = explode(',',$posts);
					
				foreach($homepos as $key=>$value)
				{
					$home = Home::model()->findByPk($value);
					$home->order_no = $key;
					//$home->saveAttributes(array('order_no'));
					$home->save();
				}
			}

			$shop = Yii::app()->user->model->company;
			if($shop && isset($slogan) && !empty($slogan))
			{
				$shop->shop_slogan = $slogan;
				//$shop->saveAttributes(array('shop_slogan'));
				$shop->save();
			}
			$arr['status'] = 'OK';
			$arr['message'] = 'Successfully updated';
		}

		else
		{
			$arr['data'] = 'no data post';
		}
		$this->sendJSONResponse($arr);
	}
	/**
	 * this api is user after login to manage his home page
	 */
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');

		$criteria = new CDbCriteria;
		//	$criteia->addCondition('create_user_id ='. Yii::app()->user->id);

		$criteria->order = 'order_no ASC';

		$criteria->limit = 5;
		$sliders = SliderImage::model()->my()->findAll($criteria);
		
		$homes = Home::model()->my()->findAll();

		$json_list = array();
		$home_list = array();
		if($sliders)
		{
			foreach ($sliders as $model)
			{
				$json_list[] = $model->toArray();
			}
		}
		if($homes)
		{
			foreach ($homes as $home)
			{
				$home_list[] = $home->toArray();
			}
		}
		$com = Yii::app()->user->model->company;
		$slogan = array();
		if($com)
		{
			$slogan[] =   $com->getnametoraay(); // Yii::app()->user->model->company->shop_slogan;
		}
		$arr['shop_slogan'] = $slogan;

		$arr['sliderimages'] = $json_list;
		$arr['homelist'] = $home_list;

		$arr['status'] = 'OK';
		$this->sendJSONResponse($arr);
	}
	/**
	 * this api is used for main home page
	 */

	public function actionContent()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Product::model()->resetScope()->findAll();

		$criteria = new CDbCriteria;
		$criteria->limit = 2;
		$criteria->order = 'id ASC';
		$sliders = SliderImage::model()->findAll($criteria);

		$sitehomes = SiteHome::model()->findAll();
		$b_list = array();
		if($sitehomes)
		{
			foreach ($sitehomes as $sitehome)
			{
				$wishtype = $sitehome->getContentType();
				if($wishtype && !empty($wishtype)){

					$b_list[] = $wishtype->toArray($sitehome->id);
				}
			}
		}
		$arr['contents'] = $b_list;

		$json_list = array();
		$slider_list = array();

		foreach ($sliders as $slider)
		{
			$slider_list[] = $slider->toArray();
		}
		$arr['sliderImages'] = $slider_list;
		$arr['contents'] = $b_list;

		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	/**
	 * This action is used in tab content to show customize data
	 * Enter description here ...
	 */
	public function actionTabcontent()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$models = Product::model()->resetScope()->findAll();

		$criteria = new CDbCriteria;
		$criteria->limit = 2;
		$criteria->order = 'id ASC';
		$sliders = SliderImage::model()->findAll($criteria);

		if(Yii::app()->user->isGuest) {
			$sitehomes = SiteHome::model()->findAll();
		}
		else{
			$sitehomes = SiteHome::getFeedData();

		}
		$b_list = array();
		if($sitehomes)
		{
			foreach ($sitehomes as $sitehome)
			{
				$wishtype = $sitehome->getContentType();
				if($wishtype)
				$b_list[] = $wishtype->toArray($sitehome->id);
			}
		}
		$arr['contents'] = $b_list;

		$json_list = array();
		$slider_list = array();

		foreach ($sliders as $slider)
		{
			$slider_list[] = $slider->toArray();
		}
		$arr['sliderImages'] = $slider_list;
		$arr['contents'] = $b_list;

		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	/**
	 * added refine content where ever need drop down or related data
	 *
	 */
	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$colors = Color::model()->findAll();
		$stores = Company::model()->findAll();
		$brands = Brand::model()->findAll();

		$categorys = Category::model()->findAll();
		$blogcategorys = BlogCategory::model()->findAll();
		$storecategorys = BlogCategory::model()->findAll();

		$sortlists = array('Price','Newest','Most Viewed','Most Sold');
		$price_range = array('Price Low To High','Price High To Low');

		$optionlist = Home::getTypeOptions();
		$loclists = Home::getLocOptions();

		$color_list = array();
		$store_list = array();
		$brand_list = array();
		$cat_list = array();
		$blogcat_list = array();
		$storecat_list = array();
		if($colors)
		{
			foreach ($colors as $color)
			{
				$color_list[] = $color->toArray();
			}
		}
		if($stores)
		{
			foreach ($stores as $store)
			{
				$store_list[] = $store->getnametoraay();
			}
		}
		if($brands)
		{
			foreach ($brands as $brand)
			{
				$brand_list[] = $brand->toArray();
			}
		}

		foreach ($categorys as $category)
		{
			$cat_list[] = $category->toArray();
		}
		foreach ($blogcategorys as $blogcat)
		{
			$blogcat_list[] = array('id'=>$blogcat->id,'title'=>$blogcat->title);
		}
		foreach ($storecategorys as $storecat)
		{
			$storecat_list[] = array('id'=>$storecat->id,'title'=>$storecat->title);
		}
		foreach ($sortlists as $key=>$value)
		{
			$sorts[] = array('id'=>$key,'title'=>$value);
		}
		foreach ($optionlist as $key=>$option)
		{
			$options[] = array('type_id'=>$key,'title'=>$option);
		}
		foreach ($loclists as $key=>$option)
		{
			$location[] = array('type_id'=>$key,'title'=>$option);
		}
		foreach ($price_range as $key=>$option)
		{
			$price_range1[] = array('price_id'=>$key,'title'=>$option);
		}
		$arr['colors'] = $color_list;
		$arr['brands'] = $brand_list;
		$arr['categories'] = $cat_list;
		$arr['blog_categories'] = $blogcat_list;
		$arr['store_categories'] = $storecat_list;
		$arr['stores'] = $store_list;
		$arr['sorts'] = $sorts;
		//	$arr['prices'] = $prices;
		$arr['status'] = 'OK';

		$arr['options'] = $options;
		$arr['loc_options'] = $location;

		$arr['price_range'] = $price_range1;
		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	/**
	 * this one is used only in case of product search on refine case for android and iphone
	 */

	public function actionPsearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Product();
		if (isset($_POST['Product']))
		{
			$model->attributes = $_POST['Product'];


			//	$arr['postdata'] = $_POST;
			//	$arr['min_price'] = $model->min_price;
			//	$arr['max_price'] = $model->max_price;

			$contents = $model->advSearchApi();
			if($contents)
			{
				foreach($contents as $content)
				{
					$json_list[] = $content->toArray();
				}
				$arr['status'] = 'OK';
				$arr['records'] = $json_list;
			}
			else {
				$arr['record'] = 'no record found';
			}
		}
		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}


	public function actionSearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Home();
		if (isset($_POST['Home']))
		{
			$model->attributes = $_POST['Home'];
			$contents = $model->basicSearchApi();
			if($contents)
			{
				foreach($contents as $content)
				{
					if($model->type_id == Home::TYPE_EMPORIUM)
					{
						if($content->empproducts)
						{
							$json_list[] = $content->toArray();
						}
					}

					else if($model->type_id == Home::TYPE_DEAL)
					{
						if($content->item)
						{
							$json_list[] = $content->toArray();
						}
					}
					else
					{
						$json_list[] = $content->toArray();
					}

				}
				$arr['status'] = 'OK';
				$arr['records'] = $json_list;
			}
			else {
				$arr['record'] = 'no record found';
			}
		}
		else
		{
			$arr['data'] = 'data not post';
		}
		$this->sendJSONResponse($arr);
	}

	/**
	 * i for product 5 for store
	 * @param unknown_type $type
	 */

	public function actionLocSearch($type_id = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model = new Home();

		$model->type_id = $type_id;
		//	$location = $model->latlongWithdata();
		//	$map[] = $location;
		if (isset($_POST['Home']))
		{
			$model->attributes = $_POST['Home'];
			$products =	$model->ListSearchApi();

			$map = array();
			$json_list = array();
			if($products)
			{
				foreach($products as $product)
				{
					$json_list[] = $product->toArray();
				}
				$location = $model->latlongWithdata();
				$arr['param'] = array('type_id'=>$model->type_id,'title'=>$model->title);
			}
			else {
				$arr['record'] = 'no record found';
			}


			$map[] = $location;

			$arr['status'] = 'OK';
			$arr['list_view'] = $json_list;
			$arr['map_view'] = $map;
		}
		else
		{
			$arr['data'] = 'data not post';
		}

		$arr['map_view'] = isset($map) ? $map : array();
		$this->sendJSONResponse($arr);
	}



	/**
	 * 	$sortlists = array('Price','Newest','Most Viewed','Most Sold');
	 * @param unknown_type $id
	 */

	public function actionSort($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteia = new CDbCriteria;
		$criteia->order = 'price ASC';
		$products = Home::getSortProducts($id);
		if($products)
		{
			$prod_list = array();
			foreach ($products as $product)
			{
				$prod_list[] = $product->toArray();
			}
			$arr['products'] = $prod_list;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}

}