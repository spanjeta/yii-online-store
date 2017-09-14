<?php
class CompanyController extends Controller {
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	public function accessRules() {
		return array (
				array (
						'allow',
						'actions' => array (
								'index',
								'view',
								'download',
								'thumbnail',
								'ajaxIndex',
								'content',
								'thumb',
								'category' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'create',
								'update',
								'search',
								'monthly',
								'billing',
								'setting',
								'info' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'admin',
								'delete' 
						),
						'expression' => 'Yii::app()->user->isAdmin' 
				),
				array (
						'deny',
						'users' => array (
								'*' 
						) 
				) 
		);
	}
	
	/**
	 * This action is used on store home page to show info in popup regarding a particular shop
	 * Enter description here ...
	 * 
	 * @param unknown_type $type        	
	 * @param unknown_type $com_id        	
	 */
	public function actionContent($type, $com_id) {
		$company = Company::model ()->findByPk ( $com_id );
		
		if ($company) {
			$this->renderPartial ( '_content', array (
					'type' => $type,
					'company' => $company 
			) );
		}
	}
	public function isAllowed($model) {
		return $model->isAllowed ();
	}
	/**
	 * this action is used at the time of popup when we want to redirect on another page.
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 */
	public function actionInfo($id) {
		$this->redirect ( array (
				'view',
				'id' => $id 
		) );
	}
	
	/**
	 * This action is used for post type and sorting and also for product category in query string
	 * Enter description here ...
	 * 
	 * @param unknown_type $id        	
	 * @param unknown_type $type_id        	
	 * @param unknown_type $sort_id        	
	 */
	public function actionView($id = null, $type_id = null, $sort_id = null, $cat_id = null) {
		if ($id == null) {
			$id = Yii::app ()->user->model->company->id;
		}
		$model = Company::model ()->findByPk ( $id );
		$criteria1 = new CDbCriteria ();
		$criteria1->addCondition ( 'create_user_id =' . $model->create_user_id );
		
		$slider_images = SliderImage::model ()->short ()->findAll ( $criteria1 );
		$criteria = new CDbCriteria ();
		
		if ($type_id) {
			$criteria->addCondition ( 'type_id =' . $type_id );
		}
		
		if ($cat_id) {
			
			$ids = $model->getProductByCat ( $cat_id );
			$criteria->addInCondition ( 'model_id', $ids );
		}
		
		// 1 = most view , 2 = latest 3 = featured
		if ($sort_id) {
			switch ($sort_id) {
				case 1 :
					{
						$criteria->order = 'view_count desc';
						break;
					}
				case 2 :
					{
						$criteria->order = 'create_time desc';
						break;
					}
				case 3 :
					{
						$criteria->addCondition ( 'is_feature = 1' );
						break;
					}
			}
		}
		
		$criteria->addCondition ( 'store_id =' . $model->id );
		$sitehomes = Home::model ()->short ()->findAll ( $criteria );
		
		$categorys = Home::getContentList ();
		$this->updateMenuItems ( $model );
		
		$this->render ( 'view', array (
				'model' => $model,
				'categorys' => $categorys,
				'images' => $slider_images,
				'sitehomes' => $sitehomes,
				'type_id' => $type_id,
				'cat_id' => $cat_id 
		
		) );
	}
	public function actionCreate() {
		$model = new Company ();
		
		$this->performAjaxValidation ( $model, 'company-form' );
		
		if (isset ( $_POST ['Company'] )) {
			$model->setAttributes ( $_POST ['Company'] );
			
			if ($model->save ()) {
				if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
					Yii::app ()->end ();
				else
					$this->redirect ( array (
							'view',
							'id' => $model->id 
					) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'create', array (
				'model' => $model 
		) );
	}
	public function actionUpdate($id = null) {
		if ($id == null)
			$id = Yii::app ()->user->id;
		$model = $this->loadModel ( $id, 'User' );
		$company = $model->company;
		if ($company) {
			$old_logo = $company->logo_file;
			$old_image = $company->image_file;
			
			if (isset ( $_POST ['Company'] )) {
				$company->setAttributes ( $_POST ['Company'] );
				
				$image = $company->saveFile ( $company, 'image_file' );
				$logo = $company->saveFile ( $company, 'logo_file' );
				
				if (! $image) {
					$company->image_file = $old_image;
				} else {
					$imagefile = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER . $image;
					if (file_exists ( $imagefile )) {
						unlink ( $imagefile );
					}
				}
				if (! $logo) {
					$company->logo_file = $old_logo;
				} else {
					$imagefile = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER . $image;
					if (file_exists ( $imagefile )) {
						unlink ( $imagefile );
					}
				}
				
				if ($company->save ()) {
					echo 'Your shop detail has been successfully updated';
					exit ();
					// $this->redirect(array('home/view'));
				}
			}
			$this->renderPartial ( '_shopinfo', array (
					'company' => $company 
			) );
		}
	}
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'Company' );
		
		if (! ($model->isAllowed ()))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
			$this->loadModel ( $id, 'Company' )->delete ();
			
			if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
				$this->redirect ( array (
						'admin' 
				) );
		} else
			throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
	}
	public function actionAjaxIndex($id) {
		$model = $this->loadModel ( $id, 'Company' );
		
		$products = $model->products;
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'store_id =' . $model->id );
		$sitehomes = Home::model ()->findAll ( $criteria );
		$this->renderPartial ( '/site/_home', array (
				'products' => $products,
				'sitehomes' => $sitehomes 
		) );
	}
	public function actionIndex() {
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'Company' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionSearch() {
		$model = new Company ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Company'] )) {
			$model->setAttributes ( $_GET ['Company'] );
			$this->renderPartial ( '_list', array (
					'dataProvider' => $model->search (),
					'model' => $model 
			) );
		}
		
		$this->renderPartial ( '_search', array (
				'model' => $model 
		) );
	}
	public function actionAdmin() {
		$model = new Company ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Company'] ))
			$model->setAttributes ( $_GET ['Company'] );
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	/*
	 * protected function processActions($model = null)
	 * {
	 * parent::processActions($model);
	 * //$this->actions [] = array('label'=>Yii::t('app', 'Add Skill'), 'url'=>array('skill', 'id' => $model->id),'icon'=>'icon-plus icon-white');
	 * }
	 */
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Company ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'View' ),
							'url' => array (
									'view',
									'id' => $model->id 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
			case 'create' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'List' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
				}
				break;
			case 'index' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
				break;
			case 'admin' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'List' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
				break;
			default :
			case 'view' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'List' ),
							'url' => array (
									'index' 
							),
							'icon' => 'icon-th-list icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Delete' ),
							'url' => '#',
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									'confirm' => 'Are you sure you want to delete this item?' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-remove icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-edit icon-white' 
					);
				}
				break;
		}
		
		// Add SEO headers
		$this->processSEO ( $model );
		
		// merge actions with menu
		$this->actions = array_merge ( $this->actions, $this->menu );
	}
}