<?php
class FavController extends Controller
{

	public function filters() {
		return array(
				'accessControl',
		);
	}

	public function accessRules() {
		return array(
		/* 		array('allow',
		 'actions'=>array(  'download', 'thumbnail' ),
		 'users'=>array('*'),
		 ), */
		array('allow',
						'actions'=>array('blog','product','store','emporium','index','refine','search','sort','delete','deal'),
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
	 * Adding blog in wishlist
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionBlog($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id ='.$id);
		$criteria->addCondition('type_id ='.WishList::TYPE_BLOG);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$isfav = WishList::model()->find($criteria);
		if($isfav)
		{
			$model = $isfav;
		}
		else {
			$model = new WishList();
			$model->model_id = $id;
			$model->type_id = WishList::TYPE_BLOG;
			$model->state_id = 1;
		}
		if($model->save())
		{
			$arr['is_fav'] = $model->state_id;
			$arr['status'] = 'OK';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * Adding product in wishlist
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionProduct($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id ='.$id);
		$criteria->addCondition('type_id ='.WishList::TYPE_PRODUCT);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$isfav = WishList::model()->find($criteria);
		if($isfav)
		{
			$model = $isfav;
		}
		else {
			$model = new WishList();
			$model->model_id = $id;
			$model->type_id = WishList::TYPE_PRODUCT;
			$model->state_id = 1;
		}
		if($model->save())
		{

			$arr['is_fav'] = $model->state_id;
			$arr['status'] = 'OK';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * Adding store in wishlist
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionStore($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id ='.$id);
		$criteria->addCondition('type_id ='.WishList::TYPE_STORE);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$isfav = WishList::model()->find($criteria);
		if($isfav)
		{
			$model = $isfav;
			$model->state_id = 1;
		}
		else {
			$model = new WishList();
			$model->model_id = $id;
			$model->type_id = WishList::TYPE_STORE;
			$model->state_id = 1;
		}
		if($model->save())
		{

			$arr['is_fav'] = $model->state_id;
			$arr['status'] = 'OK';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * Adding emporium in wishlist
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionEmporium($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id ='.$id);
		$criteria->addCondition('type_id ='.WishList::TYPE_EMPORIUM);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$isfav = WishList::model()->find($criteria);
		if($isfav)
		{
			$model = $isfav;
		}
		else {
			$model = new WishList();
			$model->model_id = $id;
			$model->type_id = WishList::TYPE_EMPORIUM;
			$model->state_id = 1;
		}
		if($model->save())
		{

			$arr['is_fav'] = $model->state_id;
			$arr['status'] = 'OK';
		}

		$this->sendJSONResponse($arr);
	}
	/**
	 * Adding deal in wishlist
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionDeal($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('model_id ='.$id);
		$criteria->addCondition('type_id ='.WishList::TYPE_DEAL);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$isfav = WishList::model()->find($criteria);
		if($isfav)
		{
			$model = $isfav;
		}
		else {
			$model = new WishList();
			$model->model_id = $id;
			$model->type_id = WishList::TYPE_DEAL;
			$model->state_id = 1;
		}
		if($model->save())
		{
			$arr['is_fav'] = $model->state_id;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}
	public function actionIndex()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$wishlists = WishList::model()->myactive()->findAll();
		$b_list = array();
		if($wishlists)
		{
			foreach ($wishlists as $wishlist)
			{
		 	$wishtype = $wishlist->getContentType();
				if($wishtype)
				$b_list[] = $wishtype->toArray($wishlist->id);
			}
		}
		$arr['wishlists'] = $b_list;

		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	public function actionRefine()
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$refinelists = array('Blog','Product','Emporium','Deal','5'=>'Store');
		$sortlists = array('Latest');

		if($refinelists)
		{
			foreach ($refinelists as $key=>$value)
			{
				$list[] = array('id'=>$key,'name'=>$value);
			}
			foreach ($sortlists as $key=>$value)
			{
				$sort[] = array('id'=>$key,'title'=>$value);
			}

			$arr['refines'] = $list;
			$arr['sorts'] = $sort;
			$arr['status'] = 'OK';
		}
		$this->sendJSONResponse($arr);
	}


	public function actionDelete($id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$isfav = WishList::model()->findByPk($id);
		if($isfav)
		{
			$isfav->delete();
			$arr['status'] = 'OK';
			$arr['message'] = 'successfully deleted';
		}
		else {
			$arr['error'] = 'wishlist not found';
		}

		$this->sendJSONResponse($arr);
	}

	/**
	 * This api is used for searching the content category
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionSearch($type_id)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->addCondition('type_id ='.$type_id);
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$arr['type_id'] = $type_id;

		$wishlists = WishList::model()->findAll($criteria);
		$b_list = array();
		if($wishlists)
		{
			foreach ($wishlists as $wishlist)
			{
		 	$wishtype = $wishlist->getwish();
				if($wishtype)
				$b_list[] = $wishtype->toArray($wishlist->id);
			}
		}
		$arr['wishlists'] = $b_list;

		$arr['status'] = 'OK';

		$this->sendJSONResponse($arr);
	}

	/*
	 *   $id == 0 for latest
	 *   $id == 1 sort by price
	 */

	public function actionSort($id = 0)
	{
		$arr = array('controller'=>$this->id, 'action'=>$this->action->id,'status' =>'NOK');
		$criteria = new CDbCriteria;
		$criteria->order = 'rand()';

		if($id == 0)
		{
			$wishlists = WishList::model()->latest()->my()->findAll();
		}
		else{
			$wishlists = WishList::model()->myproduct()->findAll();
		}
		$b_list = array();
		if($wishlists)
		{
			foreach ($wishlists as $wishlist)
			{
		 	$wishtype = $wishlist->getwish();
				if($wishtype)
				$b_list[] = $wishtype->toArray($wishlist->id);
			}
		}
		$arr['status'] = 'OK';
		$arr['wishlists'] = $b_list;

		$this->sendJSONResponse($arr);
	}

}