<?php
class PageController extends Controller {
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
								'view',
								/* 'download', 'thumbnail' */),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'detailpage',
								'search',
								'ajaxCreate',
								'addWarranty',
								'addPostage' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'create',
								'update',
								'index',
								'admin',
								
								'detail' ,
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
		$model = $this->loadModel ( $id, 'Page' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		// $this->processActions($model);
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}
	public function actionDetail($id) {
		$this->layout = 'column1';
		$translate=Yii::app()->translate;
		$lang = $translate->getLanguage();
		
		$model = Page::model ()->findByAttributes ( array (
				'type_id' => $id ,
				'lang_type' => $lang
		) );
		
		if ($model != null) {
		//	$this->updateMenuItems ( $model );
			$this->render ( 'detail', array (
					'model' => $model 
			) );
		} else {
			$this->redirect ( array (
					'site/index' 
			) );
		}
	}
	public function actionDetailPage($id) {
		$this->layout = 'column1';
		$model = Page::model ()->findByAttributes ( array (
				'id' => $id
		) );
		
		if ($model != null) {
			//	$this->updateMenuItems ( $model );
			$this->render ( 'detailpage', array (
					'model' => $model
			) );
		} else {
			$this->redirect ( array (
					'site/index'
			) );
		}
	}
	/**
	 * One action for all pop ups used in place of product create page.
	 * 
	 * @param unknown_type $type        	
	 */
	public function actionAjaxCreate($type) {
		switch ($type) {
			case Page::POPUP_WARRANTY :
				{
					$model = new Warranty ();
					$this->renderPartial ( '_warranty', array (
							'model' => $model 
					) );
					break;
				}
			case Page::POPUP_POSTAGE :
				{
					$model = new Postage ();
					$this->renderPartial ( '_postage', array (
							'model' => $model 
					) );
					break;
				}
			case Page::POPUP_PAYMENT :
				{
					$paymentSetting = Yii::app ()->user->model->paymentSetting;
					
					if (! $paymentSetting)
						$paymentSetting = new PaymentSetting ();
					
					$paypal = new PaypalInfo (); // using both of the paypal and payment setting
					$paymentSetting = new PaymentSetting ();
					$model = new Warranty ();
					$this->renderPartial ( '_payment', array (
							'paypal' => $paypal,
							'paymentSetting' => $paymentSetting 
					) );
					break;
				}
		}
	}
	public function actionAddWarranty() {
		$model = new Warranty ();
		if (isset ( $_POST ['Warranty'] )) {
			$model->setAttributes ( $_POST ['Warranty'] );
			
			if ($model->save ()) {
				
				echo '<div class="alert alert-success"> Successfully Added </div>';
			} else {
				echo '<div class="alert alert-danger"> Please fill required fields </div>';
			}
		}
	}
	public function actionAddPostage() {
		$model = new Postage ();
		
		if (isset ( $_POST ['Postage'] )) {
			$model->setAttributes ( $_POST ['Postage'] );
			
			if ($model->save ()) {
				
				echo 'success';
				exit ();
			} else {
				echo '<div class="alert alert-danger"> Please fill required fields </div>';
			}
			
			$this->renderPartial ( '_postage', array (
					'model' => $model 
			) );
		}
	}
	public function actionCreate() {
		
		$model = new Page ();
		
		$this->performAjaxValidation ( $model, 'page-form' );
		
		if (isset ( $_POST ['Page'] )) {
			
			$model->setAttributes ( $_POST ['Page'] );
			
			
			if ($model->save ()) {
				if (Yii::app ()->getRequest ()->getIsAjaxRequest ())
					Yii::app ()->end ();
				else					
					$this->redirect ( array (
							'view',
							'id' => $model->id 
					) );
			}else{
				print_r($model->getErrors());exit;
			}
		}
		
		$this->updateMenuItems ( $model );
		$this->render ( 'create', array (
				'model' => $model 
		) );
	}
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Page' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->performAjaxValidation ( $model, 'page-form' );
		
		if (isset ( $_POST ['Page'] )) {
			$model->setAttributes ( $_POST ['Page'] );
			
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
		$model = $this->loadModel ( $id, 'Page' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->loadModel ( $id, 'Page' )->delete ();
		
		$this->redirect ( array (
				'page/admin'
		) );
	}
	public function actionIndex() {
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'Page' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionSearch() {
		$model = new Job ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Page'] )) {
			$model->setAttributes ( $_GET ['Page'] );
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
		$model = new Page ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Page'] ))
			$model->setAttributes ( $_GET ['Page'] );
		
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
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'manage' ),
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
					); */
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'create' ),
							'url' => array (
									'create' 
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