<?php
Yii::import ( 'zii.widgets.CPortlet' );
class CommentPortlet extends CPortlet {
	public $model = null;
	public $project_id ;
	
	public function init()
	{
		parent::init();
		
		/* if ( $this->model instanceof Product)
		 $this->project_id = $this->model->id;
		 if ( $this->model->hasAttribute('project_id'))$this->project_id = $this->model->project_id; */
	}
	public function getRecentComments() {
		
		
		$uploaded_files = CUploadedFile::getInstancesByName ( 'Comment[files]' );
		
		if (isset ( $_POST ['Comment'] ) && ( isset ( $_POST ['Comment'] ['comment'] ) || $uploaded_files )) {
			
			$comment = new Comment ();
			$comment->setAttributes ( $_POST ['Comment'] );
			$comment->model_type = get_class ( $this->model );
			$comment->model_id = $this->model->id;
			//$comment->project_id = $this->project_id;
			$comment->state_id = 0;
			if (count($uploaded_files) > 0) $comment->comment .=  ' ' . count($uploaded_files) . " File(s) uploaded.";
			$comment->save ();

			Yii::app()->controller->redirect(
					array(
							'product/view',
							'id' => $this->model->id
					)
				);
			
			//File::handleUpload ( $uploaded_files, $comment);
		}
		
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'model_type', get_class ( $this->model ) );
		$criteria->compare ( 'model_id', $this->model->id );
		$dataProvider = new CActiveDataProvider ( 'Comment', array (
				'criteria' => $criteria
		) );
		
		return $dataProvider;
	}
	
	
	protected function renderContent() {
		if (! Yii::app ()->user->isGuest) {
			$dataProvider = $this->getRecentComments ();
			$this->render ( 'commentPortlet', array (
					'dataProvider' => $dataProvider,
					'comment' => new comment ()
			) );
		}
	}
}