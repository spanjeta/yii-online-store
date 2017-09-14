<?php
class SliderImageController extends Controller {
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
								'thumb',
								'download' 
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
								'addImages',
								'slImages',
								'addImage',
								'ajaxUpdate',
								'add',
								'upload',
								'upload1',
								'deleteAjax',
								'ajaxIndex',
								'ajaxUpdate1' 
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
	 * this is used for tempory storage in temp file while on company create
	 */
	public function actionAddImage() {
		$model = new TempFile ();
		
		$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
		
		$uploaded_file = CUploadedFile::getInstanceByName ( 'image_file' );
		if ($uploaded_file) {
			
			$filename = $path . 'Slider' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			$uploaded_file->saveAs ( $filename );
			$model->image_path = basename ( $filename );
			$model->type_id = TempFile::SLIDER_IMAGE;
			if ($model->save ()) {
				echo 'success';
			} else {
				echo 'not save';
			}
		}
	}
	/**
	 * This is used when we display slider image while added content in company
	 */
	public function actionslImages() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'type_id =' . TempFile::SLIDER_IMAGE );
		$images = TempFile::model ()->findAll ( $criteria );
		$this->renderPartial ( '_slimages', array (
				'images' => $images 
			// 'id'=>$id,
		), false, true );
	}
	
	/**
	 * this method using on home view for added image in data base.
	 * on manage home page.
	 */
	public function actionAdd() {
		$model = new SliderImage ();
		
		$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
		$uploaded_file = CUploadedFile::getInstanceByName ( 'image_path' );
		if ($uploaded_file) {
			$filename = $path . get_class ( $model ) . '_' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			$uploaded_file->saveAs ( $filename );
			$model->slider_image = basename ( $filename );
			$model->type_id = 1;
			$model->state_id = 1;
			$model->store_id = isset ( Yii::app ()->user->model->company ) ? Yii::app ()->user->model->company->id : 0;
			
			if ($model->save ()) {
				echo 'success';
			} else {
				echo 'not save';
			}
		}
	}
	/**
	 * this method used as a updation of all home page content in order wise on manage home
	 *
	 * this is used by business user
	 */
	public function actionAjaxUpdate() {
		$imagepos = isset ( $_POST ['images'] ) ? $_POST ['images'] : null;
		$homepos = isset ( $_POST ['posts'] ) ? $_POST ['posts'] : null;
		$slogan = ($_POST ['slogan']);
		
		if ($imagepos) {
			foreach ( $imagepos as $key => $value ) {
				$slider = SliderImage::model ()->findByPk ( $value );
				$slider->order_no = $key;
				$slider->saveAttributes ( array (
						'order_no' 
				) );
			}
		}
		if ($homepos) {
			foreach ( $homepos as $key => $value ) {
				$home = Home::model ()->findByPk ( $value );
				$home->order_no = $key;
				$home->saveAttributes ( array (
						'order_no' 
				) );
			}
		}
		$shop = Yii::app ()->user->model->company;
		if ($shop) {
			$shop->shop_slogan = $slogan;
			$shop->saveAttributes ( array (
					'shop_slogan' 
			) );
		}
	}
	
	/**
	 * this action is accessible by admin to set row position and slider image position
	 * this is handle by admin
	 */
	public function actionAjaxUpdate1() {
		$imagepos = isset ( $_POST ['images'] ) ? $_POST ['images'] : null;
		$homepos = isset ( $_POST ['posts'] ) ? $_POST ['posts'] : null;
		
		if ($imagepos) {
			foreach ( $imagepos as $key => $value ) {
				$slider = SliderImage::model ()->findByPk ( $value );
				$slider->order_no = $key;
				$slider->saveAttributes ( array (
						'order_no' 
				) );
			}
		}
		if ($homepos) {
			foreach ( $homepos as $key => $value ) {
				$home = SiteHome::model ()->findByPk ( $value );
				$home->order_no = $key;
				$home->saveAttributes ( array (
						'order_no' 
				) );
			}
		}
	}
	public function isAllowed($model) {
		return $model->isAllowed ();
	}
	
	/**
	 * this one is using for deleting slider image on manage home page
	 *
	 * @param
	 *        	unknown_id
	 */
	public function actionDeleteAjax($id) {
		$model = $this->loadModel ( $id, 'SliderImage' );
		if ($model) {
			$file = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER . $model->slider_image;
			if (file_exists ( $file )) {
				unlink ( $file );
			}
			if ($model->delete ())
				echo 'success';
			else
				echo 'failiar';
		}
	}
	public function actionIndex() {
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'SliderImage' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	
	/**
	 * this function is used for content on manage home page to show slider images
	 */
	public function actionAjaxIndex() {
		Yii::app ()->clientscript->scriptMap ['jquery.js'] = false;
		Yii::app ()->clientscript->scriptMap ['bootstrap.bootbox.min.js'] = false;
		Yii::app ()->clientscript->scriptMap ['bootstrap.notify.js'] = false;
		Yii::app ()->clientscript->scriptMap ['bootstrap.js'] = false;
		Yii::app ()->clientscript->scriptMap ['jquery-ui.min.js'] = false;
		
		$sliderimages = SliderImage::model ()->mybyorder ()->findAll ();
		$this->renderPartial ( 'index', array (
				'sliderimages' => $sliderimages 
		), false, true );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new SliderImage ();
		
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