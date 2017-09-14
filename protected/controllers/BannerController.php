<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. <www.toxsl.com>
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
?>
<?php
class BannerController extends Controller {
	public function filters() {
		return array (
				'accessControl' 
		);
	}
	public function accessRules() {
		return array (
				
				/* array (
						'allow',
						'actions' => array (
								
						),
						'users' => array (
								'@' 
						) 
				), */
				array (
						'allow',
						'actions' => array (
								'index',
								'view',
								'add',
								'update' ,
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
		$model = $this->loadModel ( $id, 'Banner' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	public function actionAdd() {
		$model = new Banner ();
		
		$this->performAjaxValidation ( $model, 'banner-form' );
		
		
			if (isset ( $_POST ['Banner'] )) {
				$model->setAttributes ( $_POST ['Banner'] );
				$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
				
				$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
				
			
				if ($uploaded_file) {
					$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				//	list($width, $height) = getimagesize($uploaded_file->tempName);
					
				//	if($width!=1500 && $height!=500){
						
			   	   //      $error = 'Banner size should be 1500*500 dimension';
			
						
				
			//		}else{
						$uploaded_file->saveAs ( $filename );
						$model->image_file = basename ( $filename );
						if ($model->save ()) {
							
							//	$uploadedFile->saveAs(Yii::app()->basePath.'/../banner/'.$fileName);
							
							
							
							if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
								Yii::app ()->end ();
								else
									$this->redirect ( array (
											'view',
											'id' => $model->id
									) );
			//			}
					}
			}

		}else{
			//print_r($model->errors);
		}
		$this->updateMenuItems ( $model );
		if(!empty($error)){
		$this->render ( 'add', array (
				'model' => $model ,
				'error' => $error
		) );
		}else {
			$this->render ( 'add', array (
					'model' => $model ,
					//'error' => $error
			) );
		}
	}

	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Banner' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'banner-form' );
		$old_image = $model->image_file;
		if (isset ( $_POST ['Banner'] )) {
			$model->setAttributes ( $_POST ['Banner'] );
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
			
			//$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
			
		/* 	if ($uploaded_file) {
				$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
				//list($width, $height) = getimagesize($uploaded_file->tempName);
	
				//if($width!=1500 && $height!=500){
		      //  $error = 'Banner size should be 1500*500 dimension';
		
				//}else{
				$uploaded_file->saveAs ( $filename );
				$model->image_file = basename ( $filename );
				if ($model->save ()) {
					$this->redirect ( array (
							'view',
							'id' => $model->id
					) );
				//}
				}
			}
			else{ */
				$model->image_file = $old_image;
				$uploaded_file = CUploadedFile::getInstance ( $model, 'image_file' );
				if ($uploaded_file) {
					
					$filename = $path . 'Banner' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
					$uploaded_file->saveAs($filename);
					$model->image_file = basename ( $filename);
				//	print_r($model->image_file);exit;
					if ($model->save ()) {
						$this->redirect ( array (
								'view',
								'id' => $model->id
						) );
					}else{
						print_r($model->getErrors());
					}
				}else{
					print_r($model->getErrors());
				}
				
				
			//}
			
		}
		$this->updateMenuItems ( $model );
		if(!empty($error)){
			$this->render ( 'add', array (
					'model' => $model ,
					'error' => $error
			) );
		}else {
			$this->render ( 'add', array (
					'model' => $model ,
					//'error' => $error
			) );
		}
	}
	/* public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'Banner' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		if (!Yii::app ()->getRequest ()->getIsPostRequest ()) {
			$this->loadModel ( $id, 'Banner' )->delete ();
			
			if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
				$this->redirect ( array (
						'manage' 
				) );
		} else
			throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
<<<<<<< Updated upstream
<<<<<<< Updated upstream

	}
=======
=======
>>>>>>> Stashed changes
	} */
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'Banner' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->loadModel ( $id, 'Banner' )->delete ();
		
		$this->redirect ( array (
				'banner/manage'
		) );
	}

	public function actionIndex() {
		$model = new Banner ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Banner'] ))
			$model->setAttributes ( $_GET ['Banner'] );
		
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	public function actionManage() {
		$model = new Banner ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Banner'] ))
			$model->setAttributes ( $_GET ['Banner'] );
		
		$this->render ( 'manage', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Banner ();
		
		switch ($this->action->id) {
			case 'update' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'View' ),
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
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
				}
				break;
			case 'index' :
				{
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Add' ),
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
							'label' => Yii::t ( 'app', 'Add' ),
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
							'label' => Yii::t ( 'app', 'Manage' ),
							'url' => array (
									'manage' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-wrench' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Update' ),
							'url' => array (
									'update',
									'id' => $model->id 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-edit' 
					);
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'Delete' ),
							'url' => array (
									'delete',
									'id' => $model->id
							),
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									'confirm' => 'Are you sure you want to delete this item?' 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'fa fa-remove' 
					);
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