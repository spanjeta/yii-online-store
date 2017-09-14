<?php
class AdminController extends Controller {
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
								'admin',
								'delete',
								'acissue',
								'bus',
								'faq',
								'content',
								'fees',
								'siteissue',
								'compute',
								'calTime',
								'basicusers',
								'businessusers',
								'adminstrator',
								'notification'
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
	public function actionCalTime() {
		$comtime = ($_POST ['t_time']);
		$type = ( int ) ($_POST ['type']);
		
		$timeinsec = $comtime / 1000;
		
		$model = new Computation ();
		
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'type_id =' . $type );
		
		$data = Computation::model ()->find ( $criteria );
		if ($data)
			$model = $data;
		
		$model->computation_date = new CDbExpression ( 'now()' );
		$model->computation_time = $timeinsec;
		$model->type_id = $type;
		
		$model->save ();
		echo $comtime;
	}
	
	public function actionNotification() {
		$arr = array (
				'status' => 'NOK'
		);
		
		if (! Yii::app ()->user->isGuest) {
			//$user = Yii::app ()->user->model;
			//$arr ['task_count'] = $user->countMyTasks;
			$arr ['feed_count'] = Feed::recentFeeds ()->totalItemCount;
			
			$arr ['status'] = 'OK';
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionBasicUsers() {
		$model = new User ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['User'] ))
			$model->setAttributes ( $_GET ['User'] );
		
		$this->render ( 'baseUser', array (
				'model' => $model 
		) );
	}
	public function actionAdminstrator() {
		$model = new User ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['User'] ))
			$model->setAttributes ( $_GET ['User'] );
		
		$this->render ( 'adminstrator', array (
				'model' => $model 
		) );
	}
	public function actionBusinessUsers() {
		$model = new User ( 'search' );
		// if (isset($_GET['Product']))
		// $model->setAttributes($_GET['Product']);
		$grid_view = 'state_id,email,products,emporium,blogs,deals,featured,sold,Revenue,fee_paid,total_view,violations,last_visit_time,create_time';
		
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ["User"] )) {
			$model->setAttributes ( $_GET ['User'] );
		}
		if (isset ( $_GET ["Coloumns"] ))
			$columns = $_GET ["Coloumns"];
		$inner_list = array ();
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => User::getStatusOptions () 
			);
		}
		
		if (in_array ( 'email', $columns )) {
			$inner_list [] = array (
					'name' => 'email' 
			);
		}
		if (in_array ( 'products', $columns )) {
			$inner_list [] = array (
					'header' => 'products',
					'value' => '$data->getUserContent(Home::TYPE_PRODUCT)' 
			);
		}
		if (in_array ( 'emporium', $columns )) {
			$inner_list [] = array (
					'header' => 'emporium',
					'value' => '$data->getUserContent(Home::TYPE_EMPORIUM)' 
			);
		}
		if (in_array ( 'blogs', $columns )) {
			$inner_list [] = array (
					'header' => 'blogs',
					'value' => '$data->getUserContent(Home::TYPE_BLOG)' 
			);
		}
		if (in_array ( 'deals', $columns )) {
			$inner_list [] = array (
					'header' => 'deals',
					'value' => '$data->getUserContent(Home::TYPE_DEAL)' 
			);
		}
		if (in_array ( 'featured', $columns )) {
			$inner_list [] = array (
					'header' => 'featured',
					'value' => '$data->getUserfeatured()' 
			);
		}
		if (in_array ( 'sold', $columns )) {
			$inner_list [] = array (
					'header' => 'sold',
					'value' => '$data->getUserSoldProduct()' 
			);
		}
		if (in_array ( 'Revenue', $columns )) {
			$inner_list [] = array (
					'header' => 'Revenue($)',
					'value' => '$data->getUserRevenued()' 
			);
		}
		
		if (in_array ( 'fee_paid', $columns )) {
			$inner_list [] = array (
					'header' => 'fee_paid($)',
					'value' => '' 
			);
		}
		if (in_array ( 'total_view', $columns )) {
			$inner_list [] = array (
					'header' => 'total_view',
					'value' => '' 
			);
		}
		if (in_array ( 'violations', $columns )) {
			$inner_list [] = array (
					'header' => 'violations',
					'value' => '' 
			);
		}
		
		if (in_array ( 'last_visit_time', $columns )) {
			
			$inner_list [] = array (
					'name' => 'last_visit_time',
					'type' => 'raw',
					'value' => '(strtotime($data->last_visit_time)) ? date("j F y", strtotime($data->last_visit_time)) : date("j F", strtotime($data->last_visit_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'last_visit_time',
							'htmlOptions' => array (
									'id' => 'last_visit_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		
		if (in_array ( 'create_time', $columns )) {
			$inner_list [] = array (
					'name' => 'create_time',
					'type' => 'raw',
					'value' => '(strtotime($data->create_time)) ? date("j F y", strtotime($data->create_time)) : date("j F", strtotime($data->create_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'create_time',
							'htmlOptions' => array (
									'id' => 'create_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		
		// $inner_list[] = array('class'=>'CButtonColumn');
		$this->render ( 'businessusers', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionCompute() {
		$criteria1 = new CDbCriteria ();
		$startdate = ($_POST ['start_date']);
		$enddate = ($_POST ['end_date']);
		
		$content_startdate = ($_POST ['start_date_content']);
		$content_enddate = ($_POST ['end_date_content']);
		
		$type = ($_POST ['type']);
		$criteria = new CDbCriteria ();
		
		if ($type == 2) {
			
			$criteria1->addCondition ( 'type_id =' . $type );
			
			if (! empty ( $startdate ) && ! empty ( $enddate )) {
				$criteria->addBetweenCondition ( 'create_time', $startdate, $enddate );
			}
			$computation = Computation::model ()->find ( $criteria1 );
			
			$basicusers = User::model ()->active ()->findAll ( $criteria );
			
			$allusers = User::model ()->count ( $criteria );
			$basicusers = User::model ()->basicUsers ()->count ( $criteria );
			$bususers = User::model ()->busUsers ()->count ( $criteria );
			$newusers = User::model ()->newUsers ()->count ( $criteria );
			
			$this->renderPartial ( '_userstatic', array (
					'allusers' => $allusers,
					'basicusers' => $basicusers,
					'bususers' => $bususers,
					'newusers' => $newusers,
					'computation' => $computation 
			) );
			
			exit ();
		} else if ($type == 3) {
			
			$criteria1->addCondition ( 'type_id =' . $type );
			
			if (! empty ( $content_startdate ) && ! empty ( $content_enddate )) {
				$criteria->addBetweenCondition ( 'create_time', $content_startdate, $content_enddate );
			}
			
			$blogs = Blog::model ()->count ( $criteria );
			$products = Product::model ()->count ( $criteria );
			$emporiums = Emporium::model ()->count ( $criteria );
			$deals = Deal::model ()->count ( $criteria );
			$allcontents = ($blogs + $products + $emporiums + $deals);
			$featureItems = 5;
			$computation = Computation::model ()->find ( $criteria1 );
			
			$this->renderPartial ( '_contentstatic', array (
					'deals' => $deals,
					'products' => $products,
					'emporiums' => $emporiums,
					'blogs' => $blogs,
					'allcontents' => $allcontents,
					'featureitems' => $featureItems,
					'computation' => $computation 
			) );
			exit ();
		}
	}
	public function actionFaq() {
		$dataProvider = new CActiveDataProvider ( 'Faq' );
		$this->render ( 'faq', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionAcIssue() {
		$this->render ( 'acissue' );
	}
	public function actionIndex() {
		$model = new User ( 'search' );
		
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['User'] ))
			$model->setAttributes ( $_GET ['User'] );
		
		$basicusers = User::model ()->active ()->findAll ();
		$allusers = User::model ()->count ();
		$basicusers = User::model ()->basicUsers ()->count ();
		$bususers = User::model ()->busUsers ()->count ();
		$newusers = User::model ()->newUsers ()->count ();
		$products = Product::model ()->count ();
		$orders = Order::model ()->count ();
		
		$month = time ();
		
		$months [] = date ( 'Y M', $month );
		for($i = 1; $i <= 11; $i ++) {
			$month = strtotime ( '-1 month', $month );
			$months [] = date ( 'Y M', $month );
		}
		$asc_months = array_reverse ( $months );
		
		$dataArray = [ ];
		$columns = array ();
		foreach ( $asc_months as $key => $m ) {
			
			$columns ['id'] = $key;
			$columns ['time'] = $m;
			$i = date ( 'm', strtotime ( $m ) );
			$year = date ( 'Y', strtotime ( $m ) );
			$columns ['price'] = Order::getMonthlyPrice ( $i, $year );
			$dataArrays [] = $columns;
		}
		foreach ( $dataArrays as $key => $dataArray ) {
			$datatime [$key] = $dataArrays [$key] ['time'];
		}
		foreach ( $dataArrays as $key => $dataArray ) {
			$dataprice [$key] = $dataArrays [$key] ['price'];
		}
		
		$this->render ( 'index', array (
				'model' => $model,
				'allusers' => $allusers,
				'basicusers' => $basicusers,
				'bususers' => $bususers,
				'newusers' => $newusers,
				'products' => $products,
				'orders' => $orders,
				'dataTime' => $datatime,
				'dataPrice' => $dataprice 
		
		) );
	}
	public function actionBus() {
		$model = new Company ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Company'] ))
			$model->setAttributes ( $_GET ['Company'] );
		
		$this->render ( 'bus', array (
				'model' => $model 
		) );
	}
	
	public function actionFees() {
		$this->render ( 'fees' );
	}
	public function actionSiteIssue() {
		$this->render ( 'siteissue' );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new User ();
		
		$this->processSEO ( $model );
	}
}