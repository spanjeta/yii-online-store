<?php
class CartItemController extends Controller {
	public function filters() {
		return array (
				'accessControl'
		);
	}
	public function accessRules() {
		return array(
				/*	array('allow',
				 'actions'=>array('index','view', 'download', 'thumbnail','add','updateSize','updateCart','updateCoupon'),
				 'users'=>array('*'),
				 ), */
				array (
						'allow',
						'actions' => array (
								'create',
								'update',
								'index',
								'view',
								'delete'
						),
						'users' => array (
								'@'
						)
				),
				array (
						'allow',
						'actions' => array (
								'admin',
								
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
	 * this action is used only for testing purpose
	 * Enter description here ...
	 *
	 * @param unknown_type $cart_id
	 */
	  public function actionIndex() {
	  	$this->layout = 'column1';
	  	$user_id = Yii::app ()->user->id;
	  	
	  	// here we have group by shop
	  	$criteria = new CDbCriteria ();
	  	$criteria->addCondition ( 'create_user_id =\'' . $user_id . '\'' );
	  	$cart = Cart::model ()->find ( $criteria );
	  	// here count total items -----------------------------------//
	  	$totalItems = 0;
	  	$criteria2 = new CDbCriteria ();
	  	$criteria2->addCondition ( 'create_user_id =\'' . $user_id . '\'' );
	  	if ($cart != null)
	  		$criteria2->addCondition ( 'cart_id = ' . $cart->id );
	  		$models = CartItem::model ()->findAll ( $criteria2 );
	  		if ($models) {
	  			foreach ( $models as $model ) {
	  				$totalItems =  $cart->itemCounts;
	  			}
	  		}
	  		// total item count close---------------------------------------------------- //
	  		
	  		$totalShops = count ( $models );
	  		
	  		$this->render ( 'index', array (
	  				'models' => $models,
	  				'cart' => $cart,
	  				'totalItems' => $totalItems,
	  				'totalShops' => $totalShops
	  		) );
	  }
	  public function actionCreate() {
	  	$model = new Cart ();
	  	
	  	$this->performAjaxValidation ( $model, 'cart-form' );
	  	
	  	if (isset ( $_POST ['Cart'] )) {
	  		$model->setAttributes ( $_POST ['Cart'] );
	  		
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
	  public function actionView($id) {
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	
	  	// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	// $this->processActions($model);
	  	$this->updateMenuItems ( $model );
	  	$this->render ( 'view', array (
	  			'model' => $model
	  	) );
	  }
	  public function actionUpdate($id) {
	  	$model = $this->loadModel ( $id, 'Cart' );
	  	
	  	// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	$this->performAjaxValidation ( $model, 'cart-form' );
	  	
	  	if (isset ( $_POST ['Cart'] )) {
	  		$model->setAttributes ( $_POST ['Cart'] );
	  		
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
	  public function actionDelete($id, $cart_id) {
	  	
	  	$model = $this->loadModel ( $id, 'CartItem' );
	  	
	  	// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	  	
	  	if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
			$this->loadModel ( $id, 'CartItem' )->delete ();
			
			$criteria = new CDbCriteria ();
			$criteria->select = 'SUM(amount) as sum';
			$criteria->compare ( 'cart_id', $cart_id );
			
			$user = CartItem::model ()->find ( $criteria );
			
			$cartModel = Cart::model ()->findByAttributes ( array (
					'id' => $cart_id 
			) );
			
			$cartModel->amount = $user->sum;
			
			$cartModel->save ();
			
			$this->redirect ( array (
					'cart/index' 
			) );
		} else
	  		throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
	  }
	  public function actionSearch() {
	  	$model = new Job ( 'search' );
	  	$model->unsetAttributes ();
	  	$this->updateMenuItems ( $model );
	  	
	  	if (isset ( $_GET ['Cart'] )) {
	  		$model->setAttributes ( $_GET ['Cart'] );
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
	  	$model = new Cart ( 'search' );
	  	$model->unsetAttributes ();
	  	$this->updateMenuItems ( $model );
	  	
	  	if (isset ( $_GET ['Cart'] ))
	  		$model->setAttributes ( $_GET ['Cart'] );
	  		
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
	  		$model = new Cart ();
	  		
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