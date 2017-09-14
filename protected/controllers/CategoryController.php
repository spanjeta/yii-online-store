<?php
class CategoryController extends Controller {
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
								'create',
								'update',
								'search',
								'addSub',
								'getSubCategory' ,
								'index',
								'admin',
								'delete',
								'view' 
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
	public function actionCreate() {
		$model = new Category ();
		
		$this->performAjaxValidation ( $model, 'category-form' );
		
		if (isset ( $_POST ['Category'] )) {
			$model->setAttributes ( $_POST ['Category'] );
			$model->type_id = Category::CATEGORY_MAIN;
			
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
			
			$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
			
			if ($uploaded_file) {
				$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				
				list($width, $height) = getimagesize($uploaded_file->tempName);
				
				if($width!=216 && $height!=250){
					
					$error = Yii::t('app','image size should be 216*250 dimension');
			
				}else{
					$uploaded_file->saveAs ( $filename );
					$model->image_file = basename ( $filename );
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
			}
			
		}else{
			print_r($model->errors);
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
	public function actionGetSubCategory($cat_id = null) {
		$arr ['status'] = 'NOK';
		// $model = new Product ( 'search' );
		/*
		 * echo "<pre>";
		 * print_r($cat_id);
		 * die();
		 */
		$category = Category::model ()->findByPk ( $cat_id );
		
		if ($category) {
			$cat = $category->getSubcategorys ();
			
			$list = [];
			if( !empty($cat) ) {
				foreach ( $cat as $da ) {
					$list [ $da->id ] = $da->title;
				}
			} 
			$arr ['status'] = 'OK';
			$arr ['data'] = $list;
		}
		
		$this->sendJSONResponse ( $arr );
	}
	public function actionAddSub($id) {
		$model = new Category ();
		
		$this->performAjaxValidation ( $model, 'category-form' );
		
		if (isset ( $_POST ['Category'] )) {
			$model->setAttributes ( $_POST ['Category'] );
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
			
			$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
			
			if ($uploaded_file) {
				$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				
				list($width, $height) = getimagesize($uploaded_file->tempName);
				
				if($width!=216 && $height!=250){
					
					$error = Yii::t('app','image size should be 216*250 dimension');
					
				}else{
					$uploaded_file->saveAs ( $filename );
					$model->image_file = basename ( $filename );
					if ($model->type_id = Category::TYPE_PARENT) {
					}
					$model->type_id = Category::TYPE_CHILD;
					$model->parent_id = $id;
					if ($model->save ()) {
						if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
							Yii::app ()->end ();
							else
								$this->redirect ( array (
										'view',
										'id' => $model->parent_id
								) );
					}
				
				}
			}
			
		}else{
			print_r($model->errors);
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
	public function actionDelete($id) {
		// $model = $this->loadModel ( $id, 'Category' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		// if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
		$this->loadModel ( $id, 'Category' )->delete ();
		
		if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
			$this->redirect ( array (
					'index' 
			) );
		// } else
		// throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
	}
	public function actionView($id) {
		$model = $this->loadModel ( $id, 'Category' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		// $this->processActions($model);
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Category' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->performAjaxValidation ( $model, 'category-form' );
		$old_image = $model->image_file;
		if (isset ( $_POST ['Category'] )) {
			$model->setAttributes ( $_POST ['Category'] );
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
			
			$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
			if ($uploaded_file) {
				$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				list($width, $height) = getimagesize($uploaded_file->tempName);
				
				if($width!=216 && $height!=250){
					$error = Yii::t('app','image size should be 216*250 dimension');
					
				}else{
					$uploaded_file->saveAs ( $filename );
					$model->image_file = basename ( $filename );
					if ($model->save ()) {
						$this->redirect ( array (
								'view',
								'id' => $model->id
						) );
					}
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
					
			) );
		}
	}
	public function actionIndex() {
		$model = new Category ( 'search' );
		
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Category'] ))
			$model->setAttributes ( $_GET ['Category'] );
		// print_r($model);exit;
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Page ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'view' ),
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
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					);
					// $this->menu[] = array('label'=>Yii::t('app', 'List'), 'url'=>array('index'),'icon'=>'icon-th-list icon-white');
				}
				break;
			case 'index' :
				{
					/* $this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'admin' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-wrench icon-white' 
					); */
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'create' ),
							'url' => array (
									'create' 
							),
							'icon' => 'icon-plus icon-white' 
					);
				}
				break;
			case 'admin' :
				{
					// $this->menu[] = array('label'=>Yii::t('app', 'List'), 'url'=>array('index'),'icon'=>'icon-th-list icon-white');
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'create' ),
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
					// $this->menu[] = array('label'=>Yii::t('app', 'List'), 'url'=>array('index'),'icon'=>'icon-th-list icon-white');
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
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
					);  */
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'add subcategory' ),
							'url' => array (
									'addSub',
									'id' => $model->id 
							),
							'icon' => 'icon-plus icon-white' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'update' ),
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