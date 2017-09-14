<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. <www.toxsl.com>
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
?>
<?php

class PaymentSettingController extends Controller {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(

				array('allow', 
					'actions'=>array('index','view','add','update'),
					'users'=>array('@'),
					),
				array('allow', 
					'actions'=>array('manage','delete'),
					'expression'=>'Yii::app()->user->isAdmin',
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	public function isAllowed($model) 
	{
		return $model->isAllowed();
	}
	public function actionView($id) 
	{
		$model = $this->loadModel($id, 'PaymentSetting');
	
		if( !($this->isAllowed ( $model)))	throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));

		$this->updateMenuItems($model);
		$this->render('view', array(
			'model' => $model
		));
	}

	public function actionAdd() 
	{
		$model = new PaymentSetting;

		$this->performAjaxValidation($model, 'payment-setting-form');

		if (isset($_POST['PaymentSetting'])) {
			$model->setAttributes($_POST['PaymentSetting']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}
		$this->updateMenuItems($model);
		$this->render('add', array( 'model' => $model));
	}

	public function actionUpdate($id) 
	{
		$model = $this->loadModel($id, 'PaymentSetting');
		
		if( !($this->isAllowed ( $model)))	throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		
		$this->performAjaxValidation($model, 'payment-setting-form');

		if (isset($_POST['PaymentSetting'])) {
			$model->setAttributes($_POST['PaymentSetting']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}
		$this->updateMenuItems($model);
		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) 
	{
		$model = $this->loadModel($id, 'PaymentSetting');
		
		if( !($this->isAllowed ( $model)))	throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
	
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'PaymentSetting')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('manage'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() 
	{
		$model = new PaymentSetting('search');
		$model->unsetAttributes();
		$this->updateMenuItems($model);
		
		if (isset($_GET['PaymentSetting']))
			$model->setAttributes($_GET['PaymentSetting']);

		$this->render('index', array(
			'model' => $model,
		));
	}
	
	
	public function actionManage() 
	{
		$model = new PaymentSetting('search');
		$model->unsetAttributes();
		$this->updateMenuItems($model);
		
		if (isset($_GET['PaymentSetting']))
			$model->setAttributes($_GET['PaymentSetting']);

		$this->render('manage', array(
			'model' => $model,
		));
	}

	protected function updateMenuItems($model = null)
	{	
		// create static model if model is null
		if ( $model == null ) $model = new PaymentSetting();
		
		switch( $this->action->id)
		{
			case 'update':	
				{
					$this->menu[] = array('label'=>Yii::t('app', 'View') , 'url'=>array('view','id'=>$model->id),'icon'=>'fa fa-eye');
				}
			case 'add':
				{
					$this->menu[] = array('label'=>Yii::t('app', 'Manage'), 'url'=>array('manage'), 'visible'=> Yii::app()->user->isAdmin,'icon'=>'fa fa-wrench');							
					
				}
				break;				
			case 'index':
				{
					$this->menu[] = array('label'=>Yii::t('app', 'Manage'), 'url'=>array('manage'), 'visible'=> Yii::app()->user->isAdmin,'icon'=>'fa fa-wrench');							
					$this->menu[] = array('label'=>Yii::t('app', 'Add'), 'url'=>array('add'),'icon'=>'fa fa-plus');
				}
				break;
			case 'manage':
				{
					
					$this->menu[] = array('label'=>Yii::t('app', 'Add'), 'url'=>array('add'),'icon'=>'fa fa-plus');
				}
				break;				
			default:
			case 'view':
				{
					
					$this->menu[] = array('label'=>Yii::t('app', 'Manage'), 'url'=>array('manage'),'visible'=> Yii::app()->user->isAdmin,'icon'=>'fa fa-wrench');
					$this->menu[] = array('label'=>Yii::t('app', 'Update'), 'url'=>array('update', 'id' => $model->id),'visible'=> Yii::app()->user->isAdmin, 'icon'=>'fa fa-edit');	
					$this->menu[] = array('label'=>Yii::t('app', 'Delete'), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 
					'confirm'=>'Are you sure you want to delete this item?'),'visible'=> Yii::app()->user->isAdmin,'icon'=>'fa fa-remove');
					//$this->menu[] = array('label'=>Yii::t('app', 'Add'), 'url'=>array('add'),'icon'=>'fa fa-plus');
								
				}
				break;
		}
		
		// Add SEO headers
		$this->processSEO($model);
		
		//merge actions with menu
		$this->actions = array_merge( $this->actions, $this->menu);
	}
}