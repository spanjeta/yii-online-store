<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. <www.toxsl.com>
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
?>
<?php
class VarProductController extends Controller {
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
								'addVarientImages',
								'pimages',
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'index',
								'view',
								'add',
								'update',
								'manage',
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
	public function isAllowed($model) {
		return $model->isAllowed ();
	}
	public function actionView($id) {
		$model = $this->loadModel ( $id, 'VarProduct' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	
	/*
	 * public function actionAdd()
	 * {
	 * $model = new VarProduct();
	 *
	 * //$this->performAjaxValidation($model, 'var-product-form');
	 *
	 * if (isset($_POST['VarProduct'])) {
	 * $model->setAttributes($_POST['VarProduct']);
	 *
	 * if ($model->save()) {
	 * if (Yii::app()->getRequest()->getIsAjaxRequest())
	 * Yii::app()->end();
	 * else
	 * $this->redirect(array('view', 'id' => $model->id));
	 * }
	 * }
	 * $this->updateMenuItems($model);
	 * $this->render('add', array( 'model' => $model));
	 * }
	 */
	 
	 public function actionAddVarientImages() {
	 	$model = new TempFile ();
	 	$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
	 	
	 	$uploaded_file = CUploadedFile::getInstanceByName ( 'image_file' );
	 	if ($uploaded_file) {
	 		$filename = $path . 'VarProduct' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
	 		$uploaded_file->saveAs ( $filename );
	 		$model->image_path = basename ( $filename );
	 		$model->type_id = TempFile::VARIENT_PRODUCT_IMAGE;
	 		if ($model->save ()) {
	 			
	 			echo 'success';
	 		} else {
	 			echo 'not save';
	 		}
	 	} else {
	 		echo 'not uploaded';
	 	}
	 }
	 public function actionPimages() {
	 	$criteria = new CDbCriteria ();
	 	$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
	 	$criteria->addCondition ( 'type_id = ' . TempFile::PRODUCT_IMAGE );
	 	$images = TempFile::model ()->findAll ( $criteria );
	 
	 	$this->renderPartial ( '_pimages', array (
	 			'images' => $images
	 	),
	 			// 'id'=>$id,
	 			false, true );
	 }
	 
	public function actionAdd() {
		$model = new VarProduct ();
		$image = TempFile::model()->findAll();
		$this->performAjaxValidation ( $model, 'variant-product-form' );
		
		if (isset ( $_POST ['VarProduct'] )) {
			$model->setAttributes ( $_POST ['VarProduct'] );
			if(!empty($image)){
			if ($model->save ()) {
				$model->linkImages ( TempFile::VARIENT_PRODUCT_IMAGE);
				if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
					Yii::app ()->end ();
				else
					$this->redirect ( array (
							'view',
							'id' => $model->id 
					) );
			}
			}else{
				Yii::app ()->user->setFlash ( 'error', 'Images can not be empty' );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'add', array (
				'model' => $model 
		) );
	}
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'VarProduct' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'var-product-form' );
		
		if (isset ( $_POST ['VarProduct'] )) {
			$model->setAttributes ( $_POST ['VarProduct'] );
			
			if ($model->save ()) {
				$this->redirect ( array (
						'view',
						'id' => $model->id 
				) );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'VarProduct' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
			$this->loadModel ( $id, 'VarProduct' )->delete ();
			
			if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
				$this->redirect ( array (
						'manage' 
				) );
		} else
			throw new CHttpException ( 400, Yii::t ( 'app', 'your request is invalid.' ) );
	}
	public function actionIndex() {
		$model = new VarProduct ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['VarProduct'] ))
			$model->setAttributes ( $_GET ['VarProduct'] );
		
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	public function actionManage() {
		$model = new VarProduct ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['VarProduct'] ))
			$model->setAttributes ( $_GET ['VarProduct'] );
		
		$this->render ( 'manage', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new VarProduct ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'view' ),
							'url' => array (
									'view',
									'id' => $model->id 
							),
							'icon' => 'fa fa-eye' 
					);
				}
			case 'add' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
				}
				break;
			case 'index' :
				{/* 
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					); */
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'add' ),
							'url' => array (
									'add' 
							),
							'icon' => 'fa fa-plus' 
					);
				}
				break;
			case 'manage' :
				{
					
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'add' ),
							'url' => array (
									'add' 
							),
							'icon' => 'fa fa-plus' 
					);
				}
				break;
			default :
			case 'view' :
				{
					
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-edit' 
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
							'icon' => 'fa fa-remove' 
					); */
					// $this->menu[] = array('label'=>Yii::t('app', 'Add'), 'url'=>array('add'),'icon'=>'fa fa-plus');
				}
				break;
		}
		
		// Add SEO headers
		$this->processSEO ( $model );
		
		// merge actions with menu
		$this->actions = array_merge ( $this->actions, $this->menu );
	}
}