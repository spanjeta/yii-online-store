<?php
class BrandController extends Controller {
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout = '//layouts/column2';
	
	/**
	 *
	 * @return array action filters
	 */
	/* public function filters() {
		return array (
			// 'accessControl', // perform access control for CRUD operations
			// 'postOnly + delete' // we only allow deletion via POST request
		);
	} */
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
								'create',
								'update' ,
								'manage',
								'delete',
								'admin',
								'addImages'
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
	}/* 
	public function filters() {
		return array (
				'accessControl'
		);
	} */
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 *
	 * @return array access control rules
	 */
	/* public function accessRules() {
		return array (
				array (
						'allow', // allow all users to perform 'index' and 'view' actions
						'actions' => array (
								
								
						
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions' => array (
								
								
						),
						'users' => array (
								'index',
								'view',
								'create',
								'update',
								'delete',
								'addImages',
								'admin' 
						) 
				),
				array (
						'allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions' => array (
								'admin',
								'delete' 
						),
						'users' => array (
								'admin' 
						) 
				),
				array (
						'deny', // deny all users
						'users' => array (
								'*' 
						) 
				) 
		
		);
	} */
	
	/**
	 * Displays a particular model.
	 *
	 * @param integer $id
	 *        	the ID of the model to be displayed
	 */
	public function actionView($id) {
		$model = $this->loadModel ( $id, 'Brand' );
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model
		) );
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		
		$model = new Brand ();
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation ( $model );
		
		if (isset ( $_POST ['Brand'] )) {
			
			$model->attributes = $_POST ['Brand'];
			
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
		
			$uploaded_file = CUploadedFile::getInstanceByName ( 'Brand[image_file]' );
			
			if ($uploaded_file) {
				
				$filename = $path . 'Brand' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				list($width, $height) = getimagesize($uploaded_file->tempName);
				
				if($width!=216 && $height!=250){
					
					$error = 'Image size should be 216*250 dimension';
				}else{
					$uploaded_file->saveAs ( $filename );
					$model->image_file = basename ( $filename );
					if ($model->save ())
						$this->redirect ( array (
								'view',
								'id' => $model->id
						) );
				}
					
				}
			
		}
	
		
		$this->updateMenuItems ( $model );
		if(!empty($error)){
			$this->render ( 'create', array (
					'model' => $model ,
					'error' => $error
			) );
		}else {
			$this->render ( 'create', array (
					'model' => $model ,
					
			) );
		}
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel (  $id ,'Brand');
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$old_image = $model->image_file;
		if (isset ( $_POST ['Brand'] )) {
			$model->attributes = $_POST ['Brand'];

			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;

			$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
			if ($uploaded_file) {
				$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			//	list($width, $height) = getimagesize($uploaded_file->tempName);
				
			//	if($width!=216&& $height!=250){
			//		$error = 'Image size should be 216*250 dimension';
			//		
			//	}else{
					$uploaded_file->saveAs ( $filename );
					$model->image_file = basename ( $filename );
					if ($model->save ()) {
						$this->redirect ( array (
								'view',
								'id' => $model->id
						) );
		//			}
				}
			}
			else{
				$model->image_file = $old_image;
				$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
				if ($uploaded_file) {
					$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
					$uploaded_file->saveAs($filename);
					$model->image_file = basename ( $filename);
				}
				if ($model->save ()) {
					$this->redirect ( array (
							'view',
							'id' => $model->id
					) );
				}
				
			}
			
		}
		$this->updateMenuItems ( $model );
		if(!empty($error)){
			$this->render ( 'update', array (
					'model' => $model ,
					'error' => $error
			) );
		}else {
			$this->render ( 'update', array (
					'model' => $model ,
					//'error' => $error
			) );
		}
	}
	
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 *
	 * @param integer $id
	 *        	the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$this->loadModel ( $id, 'Brand' )->delete ();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (! isset ( $_GET ['ajax'] ))
			$this->redirect ( isset ( $_POST ['returnUrl'] ) ? $_POST ['returnUrl'] : array (
					'admin' 
			) );
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider ( 'Brand' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		$model = new Brand ( 'search' );
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['Brand'] ))
			$model->attributes = $_GET ['Brand'];
		$this->updateMenuItems ( $model );
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 *
	 * @param integer $id
	 *        	the ID of the model to be loaded
	 * @return Brand the loaded model
	 * @throws CHttpException
	 */
	/* public function loadModel($id) {
		$model = Brand::model ()->findByPk ( $id );
		if ($model === null)
			throw new CHttpException ( 404, 'The requested page does not exist.' );
		return $model;
	} */
	
	/**
	 * Performs the AJAX validation.
	 *
	 * @param Brand $model
	 *        	the model to be validated
	 */
	/* protected function performAjaxValidation($model) {
		if (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] === 'brand-form') {
			echo CActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	} */
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Color ();
		
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
					/*
					 * $this->menu [] = array (
					 * 'label' => Yii::t ( 'app', 'List' ),
					 * 'url' => array (
					 * 'index'
					 * ),
					 * 'icon' => 'icon-th-list icon-white'
					 * );
					 */
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
					/*
					 * $this->menu [] = array (
					 * 'label' => Yii::t ( 'app', 'List' ),
					 * 'url' => array (
					 * 'index'
					 * ),
					 * 'icon' => 'icon-th-list icon-white'
					 * );
					 */
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					
					  /* $this->menu [] = array (
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
					 */
					/* $this->menu [] = array (
							'label' => Yii::t ( 'app', 'Create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					); */
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
