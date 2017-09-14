<?php
class MailingController extends AdminController
{

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionUpdate($id)
	{
		$model = $this->loadModel($id,'Mailing');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Mailing']))
		{
			$model->attributes=$_POST['Mailing'];
			if($model->save()) {
				Yii::app()->user->setFlash('success','Email: '.$model->subject.' is updated');
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	

	public function actionCreate($id=NULL)
	{
		$model=new Mailing;
		$model->status = 55710;
		
		if(isset($id)) {
			$modelE = EventBooking::model()->with(array('user'=>array('select'=>'email')))->findAll(array('select'=>'t.user_id','condition'=>"t.event_id=$id"));
//			var_dump($modelE);
			Yii::app()->user->setFlash('info','Please note this list contain all the users who are subscribed');
			$tempArr = array();
			if(count($modelE)>0) {
				foreach($modelE as $row) {
					$tempArr[] = $row->user->email;
				}
			}                        
		}else{			
			// $modelE = User::model()->findAll(array('select'=>'email','condition'=>"status=55654"));
			$modelE = User::model()->findAll(array('select'=>'email','condition'=>"status in ('55654','55778','55741')"));
			$tempArr = array();
			foreach($modelE as $row) {
				$tempArr[] = $row->email;
			}
		}
		$model->queue = implode(',',$tempArr);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Mailing']))
		{
			$model->attributes=$_POST['Mailing'];
			$model->startedOn = date('Y-m-d H:i:s');
			$model->finishedOn = '0000-00-00 00:00:00';
			
			if($model->save()) {
				Yii::app()->user->setFlash('success','Email: '.$model->subject.' queued. It will be sent every 5 minutes in a batch');
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
			$model->status = 55714;

			if($model->save()) {
				Yii::app()->user->setFlash('success','Email: '.$model->subject.' stoped sending.');
				$this->redirect(array('index'));
			}

		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	

	public function actionIndex()
	{
		$model=new Mailing('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mailing']))
			$model->attributes=$_GET['Mailing'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

/* 
	public function loadModel($id)
	{
		$model=Mailing::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	*
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	/*protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mailing-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	} */
}
