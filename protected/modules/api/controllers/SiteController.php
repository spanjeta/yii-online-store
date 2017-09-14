<?php

class SiteController extends Controller
{
	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		array('allow',
						'actions'=>array('index','view','about','contact','download', 'thumbnail','searchList','asearch'),
						'users'=>array('*'),
		),
		array('allow',
						'actions'=>array('create','update', 'search','edit','items','search','delete','dactivate'),
						'users'=>array('@'),
		),
		array('allow',
						'actions'=>array('admin'),
						'expression'=>'Yii::app()->user->isAdmin',
		),
		array('deny',
						'users'=>array('*'),
		),
		);
	}


	/**
	 * here you can access the autosearch list with
	 */

	public function actionSearchlist($q = null)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'OK');


		// its for blog emporium and deals search
		$criteria = new CDbCriteria();
		$criteria->addCondition('title LIKE :pn');
		$criteria->params[':pn']=$q.'%';
		$criteria->limit = 4;


		// its for product search
		$criteria1 = new CDbCriteria();
		$criteria1->group = 'title';
		$criteria1->limit = 7;
		$criteria1->addCondition('title LIKE "'.$q.'%" ');

		// this is for shop search
		$criteria2 = new CDbCriteria();
		$criteria2->limit = 3;
		$criteria2->addCondition('shop_name LIKE "'.$q.'%" ');

		$products = Product::model()->findAll($criteria1);

		$blogs = Blog::model()->findAll($criteria);

		$emporiums = Emporium::model()->findAll($criteria);

		$deals = Deal::model()->findAll($criteria);

		$stores = Company::model()->findAll($criteria2);

		$returnVal = array();

		if($products){
			foreach($products as $product)
			{
				$returnVal[] = array(
						'title'=>'Search  " '.$product->title . ' "'.'In Products',
						'value'=>$product->title,
						'type_id'=>Home::TYPE_PRODUCT,
				);
			}
		}
		if($blogs){
			foreach($blogs as $blog)
			{
				$returnVal[] = array(
						'title'=>'Search  " '.$blog->title.' " In Blogs ',
						'value'=>$blog->title,
						'type_id'=>Home::TYPE_BLOG,
				);
			}
		}
		if($deals){
			foreach($deals as $deal)
			{
				$returnVal[] = array(
						'title'=>'Search  " '.$deal->title.' " In Deals ',
						'value'=>$deal->title,
						'type_id'=>Home::TYPE_DEAL,
				);
			}
		}
		if($emporiums){
			foreach($emporiums as $emporium)
			{
				$returnVal[] = array(
						'title'=>'Search  " '.$emporium->title.' " In Emporium ',
						'value'=>$emporium->title,
						'type_id'=>Home::TYPE_EMPORIUM,
				);
			}
		}

		if($stores){
			foreach($stores as $store)
			{
				$returnVal[] = array(
						'title'=>'Search  " '.$store->shop_name.' " In Store ',
						'value'=>$store->shop_name,
						'type_id'=>Home::TYPE_STORE,
				);
			}
		}
		$returnVal[] = array(
				'title'=>'Search '.$q.' In All ',
				'value'=>$q,
				'type_id'=>Home::TYPE_ALL,
		);
		//	print_r($returnVal); exit;
		$arr['contents'] = $returnVal;

		$this->sendJSONResponse($arr);
		//	Yii::app()->end();
	}

	/**
	 * here i will send the search result from all respected content as per value and titilef
	 */

	public function actionAsearch()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'OK');
		$title = isset($_POST['Home']['title']) ? $_POST['Home']['title'] :  '';
		$type = isset($_POST['Home']['type_id']) ? $_POST['Home']['type_id'] : '';
		$arr['post'] = $_POST;
				//$title ='bl';
		 //$type = 10; 

		$contents = null;
		$contentlist = array();
		$arr['title'] = $title;
		$arr['type_id'] = $type;

		$criteria = new CDbCriteria;
		switch($type)
		{
			case Home::TYPE_BLOG:
				{
					$criteria->compare('title', $title, true, ' OR ');
					$criteria->compare('content',$title, true, ' OR ');
					$contents = Blog::model()->findAll($criteria);
					break;
				}
			case Home::TYPE_PRODUCT:
				{
					$criteria->compare('title', $title, true , ' OR ');
					$criteria->compare('description',$title, true,' OR ');
					$contents = Product::model()->findAll($criteria);
					break;
				}
			case Home::TYPE_EMPORIUM:
				{
					$criteria->compare('title', $title, true, 'OR ');
					$criteria->compare('description',$title, true, 'OR ');
					$contents = Emporium::model()->findAll($criteria);
					break;
				}
			case Home::TYPE_DEAL:
				{
					$criteria->compare('title', $title, true);
					$contents = Deal::model()->findAll($criteria);
					break;
				}

			case Home::TYPE_STORE:
				{
					$criteria->compare('shop_name',$title,true);
					$contents = Company::model()->findAll($criteria);
					break;
				}
			default:
				{
					$criteria->compare('title', $title, true);
					$deals = Deal::model()->findAll($criteria);
					$emporiums = Emporium::model()->findAll($criteria);
					$products = Product::model()->findAll($criteria);
					$blogs = Blog::model()->findAll($criteria);
					$jsonlist = array();
					if($products)
					{
						foreach($products as $product)
						{
							$jsonlist[] =  $product->toArray();
						}
					}
					if($blogs)
					{
						foreach($blogs as $blog)
						{
							$jsonlist[] =  $blog->toArray();
						}
					}
					if($emporiums)
					{
						foreach($emporiums as $emporium)
						{
							$jsonlist[] =  $emporium->toArray();
						}
					}
					if($deals)
					{
						foreach($deals as $deal)
						{
							$jsonlist[] =  $deal->toArray();
						}
					}
					$arr['contents'] = $jsonlist;
					$this->sendJSONResponse($arr);
					break;
				}
		}

		if($contents)
		{
			foreach($contents as $content)
			{
				$contentlist[] =  $content->toArray();
			}
		}
		$arr['contents'] = $contentlist;
		$this->sendJSONResponse($arr);
	}

	public function actionAbout()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.
				Lorem Ipsum has been the industrys standard dummy text ever since the 1500s,
				when an unknown printer took a galley of type and scrambled it to make a type specimen book. I
				t has survived not only five centuries, but also the leap into electronic typesetting,
				remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
				sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
				PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting
				industry. Lorem Ipsum has been the industrys
				standard dummy text ever since the 1500s, when an unknown printer took a
				galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,
				but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s
				with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing
				software like Aldus PageMaker including versions of Lorem Ipsum';
		$arr['status'] = 'OK';
		$arr['about'] = $content;

		$this->sendJSONResponse($arr);
	}
	public function actionContact()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			{
				$arr['status'] = 'OK';
				$arr['message'] = 'Thank you for contacting us. We will respond to you as soon as possible.';

				/* $headers="From: {$model->email}\r\nReply-To: {$model->email}";
				 mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				 Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				 $this->refresh(); */
			}
			//	$arr['message'] = 'Thank you for contacting us. We will respond to you as soon as possible.';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionTerms()
	{
		$this->render('terms');
	}
	public function actionPrivacy()
	{
		$this->render('privacy');
	}

}