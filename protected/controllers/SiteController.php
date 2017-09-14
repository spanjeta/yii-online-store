<?php
class SiteController extends Controller {
	public $layout = '//layouts/main';
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array (
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha' => array (
						'class' => 'CCaptchaAction',
						'backColor' => 0xFFFFFF 
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page' => array (
						'class' => 'CViewAction' 
				),
				'crugeconnector' => array (
						'class' => 'CrugeConnectorAction' 
				) 
		);
	}
	
	public function actionLoginSuccess($key){
		
		$loginData = Yii::app()->crugeconnector->getStoredData();
		// loginData: remote user information in JSON format.
		
		$info = $loginData;
		$this->renderText('<h1>Welcome!</h1><p>'.$info.'</p> key='.$key);
	}
	
	public function actionLoginError($key, $message=''){
		$this->renderText('<h1>Login Error</h1><p>'.$message.'</p> key='.$key);
	}
	/**
	 * Check php version
	 * Enter description here ...
	 */
	public function actionPhpVersion() {
		Yii::import ( 'ext.ECSVExport' );
		
		// for use with array of arrays
		$data = array (
				array (
						'key1' => 'value1',
						'key2' => 'value2' 
				) 
		);
		
		$csv = new ECSVExport ( $data );
		$output = $csv->toCSV (); // returns string by default
		
		echo $output;
		echo 'Current PHP version: ' . phpversion ();
		// phpinfo();
		exit ();
	}
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSource() {
		$criteria1 = new CDbCriteria ();
		// $criteria1->compare('title', $_GET['term'], true);
		$criteria1->group = 'title';
		$criteria1->limit = 7;
		
		$criteria1->addCondition ( 'title LIKE "' . $_GET ['term'] . '%" ' );
		// $criteria1->params[':tn']=$_GET['term'].'%';
		
		$criteria = new CDbCriteria ();
		// $criteria->compare('title', $_GET['term'], true);
		
		$criteria->addCondition ( 'title LIKE :pn' );
		$criteria->params [':pn'] = $_GET ['term'] . '%';
		$criteria->limit = 4;
		
		$products = Product::model ()->findAll ( $criteria1 );
		
		$blogs = Blog::model ()->findAll ( $criteria );
		
		$emporiums = Emporium::model ()->findAll ( $criteria );
		
		$deals = Deal::model ()->findAll ( $criteria );
		
		$returnVal = array ();
		
		if ($products) {
			foreach ( $products as $product ) {
				$returnVal [] = array (
						'label' => 'Search  " ' . $product->title . ' "' . 'In Products',
						'value' => $product->title,
						'id' => $product->id,
						'type' => Home::TYPE_PRODUCT 
				);
			}
		}
		if ($blogs) {
			foreach ( $blogs as $blog ) {
				$returnVal [] = array (
						'label' => 'Search  " ' . $blog->title . ' " In Blogs ',
						'value' => $blog->title,
						'id' => $blog->id,
						'type' => Home::TYPE_BLOG 
				);
			}
		}
		
		if ($deals) {
			foreach ( $deals as $deal ) {
				$returnVal [] = array (
						'label' => 'Search  " ' . $deal->title . ' " In Deals ',
						'value' => $deal->title,
						'id' => $deal->id,
						'type' => Home::TYPE_DEAL 
				);
			}
		}
		
		if ($emporiums) {
			foreach ( $emporiums as $emporium ) {
				$returnVal [] = array (
						'label' => 'Search  " ' . $emporium->title . ' " In Emporium ',
						'value' => $emporium->title,
						'id' => $emporium->id,
						'type' => Home::TYPE_EMPORIUM 
				);
			}
		}
		$returnVal [] = array (
				'label' => 'Search ' . $_GET ['term'] . ' In All ',
				'value' => $_GET ['term'],
				'id' => '',
				'type' => Home::TYPE_ALL 
		);
		
		// print_r($returnVal); exit;
		
		echo CJSON::encode ( $returnVal );
		Yii::app ()->end ();
	}
	public function actionQuery() {
		$command = Yii::app ()->db->createCommand ( 'Alter table `tbl_user_address` add `shop_location` varchar(512) after `street_add`;' );
		
		$update = $command->execute ();
	}
	public function actionShowLogs() {
		$url = Yii::app ()->runtimePath . '/application.log';
		if (file_exists ( $url )) {
			$myfile = fopen ( $url, 'r' );
			echo nl2br ( fread ( $myfile, filesize ( $url ) ) );
			/*
			 * while(!feof($myfile)) {
			 * echo nl2br(fgets($myfile));
			 * }
			 */
			// window.scrollTo(500,0);
			echo '<script>

		window.scrollTo(0, document.body.scrollHeight) ;
  			</script>';
		}
	}
	public function actionDeleteAssets() {
		$path = Yii::app ()->basePath . '/../assets';
		User::rrmdir ( $path );
		$runtime = Yii::app ()->runtimePath;
		User::rrmdir ( $runtime );
	}
	public function actionIndex() {
		$this->layout = 'main';
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id = 1' );
		$criteria->order = 'id ASC';
		$criteria->limit = 5;
		// $images = SliderImage::model()->findAll($criteria);
		$criteria1 = new CDbCriteria ();
		$criteria1->order = 'id desc';
		$criteria1->limit = '12';
		
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria1,
				'pagination' => array (
						'pageSize' => 12 
				) 
		
		) );
		
		$categorys = Category::model ()->findAll ();
		// $shorts = Home::getHomeShortList();
		$this->render ( 'index', array (
				// 'images'=>$images,
				// 'shorts'=>$shorts,
				'categorys' => $categorys,
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * using for shorting
	 */
	public function actionShort($type_id = null) {
		// $this->redirect(array('index'));
		$criteria = new CDbCriteria ();
		$criteria->limit = 2;
		$criteria->order = 'id ASC';
		$images = SliderImage::model ()->findAll ( $criteria );
		
		$shorts = Home::getHomeShortList ();
		
		$sitehomes = SiteHome::getSiteContent ( $type_id );
		
		$this->render ( 'index', array (
				'images' => $images,
				'shorts' => $shorts,
				'categorys' => $categorys,
				'sitehomes' => $sitehomes 
		) );
	}
	
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app ()->errorHandler->error) {
			
			if (Yii::app ()->request->isAjaxRequest)
				echo $error ['message'];
			else
				$this->render ( 'error', $error );
		}
	}
	
	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm ();
		if (isset ( $_POST ['ContactForm'] )) {
			$model->attributes = $_POST ['ContactForm'];
			if ($model->validate ()) {
				/*
				 * $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				 * $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				 * $headers="From: $name <{$model->email}>\r\n".
				 * "Reply-To: {$model->email}\r\n".
				 * "MIME-Version: 1.0\r\n".
				 * "Content-type: text/plain; charset=UTF-8";
				 *
				 * mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				 */
				Yii::app ()->user->setFlash ( 'contact', 'Thank you for contacting us. We will respond to you as soon as possible.' );
			}
		}
		$this->render ( 'contact', array (
				'model' => $model 
		) );
	}
	public function actionBlog() {
		$blogs = Blog::model ()->findAll ();
		
		$this->render ( 'blog', array (
				'blogs' => $blogs 
		) );
	}
	public function actionStore() {
		$stores = Company::model ()->findAll ();
		
		$this->render ( 'store', array (
				'stores' => $stores 
		) );
	}
	public function actionCategory($id = null) {
		$model = new Product ();
		$criteria = new CDbCriteria ();
		// $criteria->limit = 2;
		if ($id) {
			$criteria->addCondition ( 'category_id =' . $id );
		}
		$categorys = Category::model ()->findAll ();
		
		$products = Product::model ()->priceDesc ()->findAll ( $criteria );
		// $sale = Product::model()->getOnSaleProducts($data);
		/*
		 * echo '<pre>';
		 * print_r($products);
		 * echo '</pre>';
		 * exit;
		 */
		$colors = Color::model ()->findAll ();
		$brands = Brand::model ()->findAll ();
		$stores = Company::model ()->findAll ();
		
		$this->render ( 'category', array (
				'products' => $products,
				'categorys' => $categorys,
				'colors' => $colors,
				'brands' => $brands,
				'stores' => $stores,
				'model' => $model,
				'id' => $id 
		) );
	}
	
	/**
	 * this one is used for category search.
	 * price_id = 0 low to high one means high to low.
	 */
	public function actionAccesory() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'category_id =4' );
		$products = Product::model ()->findAll ( $criteria );
		
		$this->render ( 'accesory', array (
				'products' => $products 
		) );
	}
	public function actionGift() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'category_id =5' );
		$products = Product::model ()->findAll ( $criteria );
		
		$this->render ( 'accesory', array (
				'products' => $products 
		) );
	}
	public function actionFeature() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'is_featured=1' );
		$products = Product::model ()->findAll ( $criteria );
		
		$this->render ( 'accesory', array (
				'products' => $products 
		) );
	}
	public function actionSearch() {
		$category_id = $_POST ['category_id'];
		$store_id = $_POST ['store_id'];
		$brand_id = $_POST ['brand_id'];
		$color_id = $_POST ['color_id'];
		$price_id = $_POST ['price_id'];
		$is_discount = $_POST ['is_discount'];
		$criteria = new CDbCriteria ();
		
		if (! empty ( $category_id ))
			$criteria->addCondition ( 'category_id =' . $category_id );
		
		if (! empty ( $store_id ))
			$criteria->addCondition ( 'store_id =' . $store_id );
		
		if (! empty ( $brand_id ))
			$criteria->addCondition ( 'brand_id =' . $brand_id );
		
		if (! empty ( $is_discount )) {
			$product_list = Product::getAllSaleAndDealProductList ();
			if ($is_discount == Product::SALE_ON) {
				$criteria->addInCondition ( 'id', $product_list );
			}
		}
		
		if (! empty ( $color_id ))
			$criteria->addCondition ( 'color_id =' . $color_id );
		
		if (isset ( $price_id )) {
			
			switch ($price_id) {
				case 0 :
					{
						$criteria->order = 'is_featured  DESC';
						break;
					}
				case 1 :
					{
						$criteria->order = 'price DESC';
						break;
					}
				case 2 :
					{
						$criteria->order = 'price ASC';
						break;
					}
				case 3 :
					{
						$criteria->order = 'view_count DESC';
						break;
					}
				default :
					{
						$criteria->order = 'is_featured  DESC';
						break;
					}
			}
		}
		$products = Product::model ()->resetScope ()->findAll ( $criteria );
		
		$this->renderPartial ( '_pview', array (
				'products' => $products 
		) );
		
		Yii::app ()->end ();
	}
	
	/*
	 * public function actionDeals()
	 * {
	 * $deals = Deal::model()->findAll();
	 * $offers=Offer::model()->findAll();
	 * $this->render('deals',array('deals'=>$deals,'offers'=>$offers));
	 * }
	 */
	public function actionAbout() {
		$this->render ( 'about' );
	}
	public function actionTerms() {
		$this->render ( 'terms' );
	}
	public function actionPrivacy() {
		$this->render ( 'privacy' );
	}
	public function actionOrder() {
		$this->render ( 'order' );
	}
	public function actionReturns() {
		$this->render ( 'returns' );
	}
	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		$model = new LoginForm ();
		
		// if it is ajax validation request
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'login-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
		
		// collect user input data
		if (isset ( $_POST ['LoginForm'] )) {
			$model->attributes = $_POST ['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model->validate () && $model->login ())
				$this->redirect ( Yii::app ()->user->returnUrl );
		}
		// display the login form
		$this->render ( 'login', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app ()->user->logout ();
		$this->redirect ( Yii::app ()->homeUrl );
	}
	public function actionSitemap() {
		$map_links = array (
				
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/' ),
						'frequency' => 'weekly',
						'priority' => '1',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/index' ),
						'changefreq' => 'daily',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/feature' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/accesory' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/gift' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/deals' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/terms' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/about' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/contact' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/privacy' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/returns' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/faq/faqpage' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				),
				array (
						'loc' => Yii::app ()->createAbsoluteUrl ( '/site/order' ),
						'frequency' => 'weekly',
						'priority' => '0.8',
						'lastmod' => date ( 'Y-m-d\TH:i:sP' ) 
				) 
		);
		
		Yii::import ( 'ext.Sitemap' );
		$sitemap = new Sitemap ();
		$sitemap->addData ( $map_links );
		$sitemap->getSitemapUrls ( 0.5 );
		
		// $sitemap->addData($this->getSitemapUrls(array('Task','Bidding','User','Comment'), 1));
		$sitemap->renderXML ();
	}
}