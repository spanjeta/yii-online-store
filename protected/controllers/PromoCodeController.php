<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. <www.toxsl.com>
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
?>
<?php
class PromoCodeController extends Controller {
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
								'applyPromo' 
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
		$model = $this->loadModel ( $id, 'PromoCode' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model 
		) );
	}

	public function actionApplyPromo() {
		
		// \Yii::app()->response->format = 'json';
		$response = [ 
				'status' => 'NOK' 
		];
		
		$data = json_encode ( $_GET );
		$model = PromoCode::model ()->findByAttributes ( [ 
				'code' => $_GET ['code'] 
		] );
		
		
		if ($model) {
		
		
		$criteria=new CDbCriteria;
		$criteria->condition = "expiry_date >= '".date ( 'Y-m-d' )."'";
		$criteria->params = array (
				'code' => $_GET ['code']
		);
		$checkExpiry = PromoCode::model()->find( $criteria );
		
		
		if(empty($checkExpiry))
		{
			$response['message'] = "Promo Code Expired";
			echo CJSON::encode ( $response );
			Yii::app ()->end ();
		}
		// $model = $this->loadModel('code', 'PromoCode');
		
		
			$model->discount;
			$discountPrice = ($_GET ['amount'] * $model->discount) / 100;
			$totalPrice = $_GET ['amount'] - $discountPrice;
			$percentage = $model->discount;
			$discountPrice = number_format ( $discountPrice, 2 );
			$totalPrice = number_format ( $totalPrice, 2 );
			$percentage = number_format ( $percentage, 2 );
			$response ['status'] = "OK";
			$response ['discountPrice'] = $discountPrice;
			$response ['totalPrice'] = $totalPrice;
			$response ['percentage'] = $percentage;
			$response ['message'] = Yii::t('app','applied successfully');
			/*
			 * $request = Yii::app()->request;
			 *
			 *
			 * $response['reply'] = $request->post ( 'code' );
			 */
			// /$model = Cart::getCart ();
			// $item = CartItem::findbyCartIdAndProduct ( $model->id, $request->post ( 'product_id' ) );
		} else {
			$response ['message'] = Yii::t('app','invalid promo code');
		}
		
		echo CJSON::encode ( $response );
		
		Yii::app ()->end ();
	}
	public function actionAdd() {
		$model = new PromoCode ();
		
		$this->performAjaxValidation ( $model, 'promo-code-form' );
		
		if (isset ( $_POST ['PromoCode'] )) {
			$model->setAttributes ( $_POST ['PromoCode'] );
			
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
		$this->render ( 'add', array (
				'model' => $model 
		) );
	}
	
	/*
	 * public function actionAdd()
	 * {
	 * $model = new PromoCode;
	 *
	 * //$this->performAjaxValidation($model, 'promo-code-form');
	 *
	 * if (isset($_POST['PromoCode'])) {
	 * $model->setAttributes($_POST['PromoCode']);
	 *
	 *
	 *
	 *
	 * if ($model->save()) {
	 *
	 * $this->redirect(array('view', 'id' => $model->id));
	 * }else
	 * {
	 * print_R($model->getErrors()); exit;
	 * echo "not saved"; exit;
	 * }
	 * }
	 * $this->updateMenuItems($model);
	 * $this->render('add', array( 'model' => $model));
	 * }
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'PromoCode' );
		
		if (! ($this->isAllowed ( $model )))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'promo-code-form' );
		
		if (isset ( $_POST ['PromoCode'] )) {
			$model->setAttributes ( $_POST ['PromoCode'] );
			
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
	
	/*
	 * public function actionDelete($id)
	 * {
	 * $model = $this->loadModel($id, 'PromoCode');
	 *
	 * if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	 *
	 * if (Yii::app()->getRequest()->getIsPostRequest()) {
	 * $this->loadModel($id, 'PromoCode')->delete();
	 *
	 * if (!Yii::app()->getRequest()->getIsAjaxRequest())
	 * $this->redirect(array('manage'));
	 * } else
	 * throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	 * }
	 */
	public function actionDelete($id) {
		$model = $this->loadModel ( $id, 'PromoCode' );
		
		// if( !($this->isAllowed ( $model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->loadModel ( $id, 'PromoCode' )->delete ();
		
		$this->redirect ( array (
				'/promoCode/index' 
		) );
	}
	public function actionIndex() {
		$model = new PromoCode ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['PromoCode'] ))
			$model->setAttributes ( $_GET ['PromoCode'] );
		
		$this->render ( 'index', array (
				'model' => $model 
		) );
	}
	public function actionManage() {
		$model = new PromoCode ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['PromoCode'] ))
			$model->setAttributes ( $_GET ['PromoCode'] );
		
		$this->render ( 'manage', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new PromoCode ();
		
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
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'delete' ),
							'url' => '#',
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									'confirm' => Yii::t ( 'app', 'are you sure you want to delete this item?') 
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