<?php
class Controller extends CController {
	/**
	 *
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 *      meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	// public $layout = '//layouts/admin_main';
	/**
	 *
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu = array ();
	public $top_menu = [ ];
	public $side_menu = [ ];
	public $user_menu = [ ];
	public $tabs_data = null;
	public $tabs_name = null;
	public $nav_left = 0;
	public $useGrid = TRUE;
	/**
	 *
	 * @var array the breadcrumbs of the current page. The value of this property will
	 *      be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 *      for more details on how to specify this property.
	 */
	public function printLogs($log = 'empty logs', $data) {
		// if ( $this->restrictUrl() )
		// Yii::log(CVarDumper::DumpAsString($log),CLogger::LEVEL_WARNING,$data);
	}
	public function sendJSONResponse($arr, $code = 200) {
		header ( 'Content-type: application/json' );
		
		$this->printLogs ( $arr, '<h2 style = "color:Green;"><b>Reponse</b></h2>' );
		echo json_encode ( $arr );
		Yii::app ()->end ();
	}
	public function behaviors() {
		return array (
				'exportableGrid' => array (
						'class' => 'application.components.ExportableGridBehavior',
						'filename' => 'Interviews.csv',
						'csvDelimiter' => ';'  // i.e. Excel friendly csv delimiter
				) 
		);
	}
	public $breadcrumbs = array ();
	public $actions = array ();
	public $menu_top = array ();
	public $menu_left = array ();
	private $_pageCaption = 'online-clothing';
	private $_pageDescription = "online-clothing";
	private $_pageKeywords = "online-clothing";
	
	/**
	 *
	 * @return string the page heading (or caption). Defaults to the controller name and the action name,
	 *         without the application name.
	 */
	protected function richTextEditor() {
		return 2; // 0 // mean no rich text editor
	}
	public function getPageCaption() {
		if ($this->_pageCaption !== null)
			return $this->_pageCaption;
		else {
			$name = ucfirst ( basename ( $this->getId () ) );
			if ($this->getAction () !== null && strcasecmp ( $this->getAction ()->getId (), $this->defaultAction ))
				return $this->_pageCaption = $name . ' ' . ucfirst ( $this->getAction ()->getId () );
			else
				return $this->_pageCaption = $name;
		}
	}
	
	/**
	 *
	 * @param string $value
	 *        	the page heading (or caption)
	 */
	public function setPageCaption($value) {
		$this->_pageCaption = $value;
	}
	
	/**
	 *
	 * @return string the page description (or subtitle). Defaults to the page title + 'page' suffix.
	 */
	public function getPageDescription() {
		if ($this->_pageDescription !== null)
			return $this->_pageDescription;
		else {
			return Yii::app ()->name . ' ' . $this->getPageCaption ();
		}
	}
	
	/**
	 *
	 * @param string $value
	 *        	the page description (or subtitle)
	 */
	public function setPageDescription($value) {
		if (! empty ( $value ))
			$this->_pageDescription = $value;
	}
	/**
	 *
	 * @param string $value
	 *        	the page description (or subtitle)
	 */
	public function setPageKeywords($value) {
		if (! empty ( $value ))
			$this->_pageKeywords = $value . ', ' . $this->_pageKeywords;
	}
	public function getPageKeywords() {
		if ($this->_pageKeywords !== null) {
			$list = explode ( ',', $this->_pageKeywords );
			array_map ( 'trim', $list );
			array_unique ( $list );
			$this->_pageKeywords = implode ( ',', $list );
			return $this->_pageKeywords;
		} else {
			return Yii::app ()->name . ', ' . $this->getPageCaption ();
		}
	}
	protected function processSEO($model = null) {
		
		if ($model && ! $model->isNewRecord) {
			
			if ($model->hasAttribute ( 'id' ))
				$this->pageCaption = Html::encode ( $model->label () ) . ' - ' . Html::encode ( Html::valueEx ( $model ) );
				$this->pageTitle = $this->pageCaption;
				if ($model->hasAttribute ( 'content' ))
					$this->pageDescription = Html::encode ( substr ( strip_tags ( $model->content ), 0, 150 ) );
					if ($model->hasAttribute ( 'title' ))
						$this->pageDescription = Html::encode ( $model->title );
		} else {
			
			if ($this->id != 'site') {
				$this->pageCaption = Html::encode ( ucfirst ( $this->id ) ) . ' | ' . Yii::app ()->name;
			} else if ($this->id == 'site' && $this->action->id == 'index') {
				$this->pageCaption = $this->_pageCaption;
			} else {
				
				$this->pageCaption = ucfirst ( $this->action->id ) . ' | ' . $this->_pageCaption;
			}
			
			$this->pageTitle = $this->pageCaption;
			$this->pageDescription = $this->_pageDescription;
			$this->pageKeywords = $this->_pageKeywords;
			
		}
	}
	
	
	public function init() {
		parent::init ();
	}
	public function addAnalytics() {
		{
			?>

<!--  Add Analytics here  -->


<?php
		}
	}
	protected function beforeAction($event) {
		/*
		 * $this->actions [] = array (
		 * 'label' => Yii::t ( 'app', 'Back' ),
		 * 'url' => '',
		 * 'onclick' => 'goBack()',
		 * 'icon' => 'fa fa-backward',
		 * 'itemOptions' => array (
		 * 'id' => 'back_btn'
		 * )
		 * );
		 */
		AuthSession::authenticateSession ();
		
		if (!empty(Yii::app ()->user->isAdmin)) {
			$this->layout = 'admin_main';
		}
		if (! Yii::app ()->user->isGuest) {
			defined ( 'UPLOAD_PATH_USER' ) or define ( 'UPLOAD_PATH_USER', '/wdir/uploads/' );
			defined ( 'THUMB_PATH_USER' ) or define ( 'THUMB_PATH_USER', '/wdir/uploads/' . Yii::app ()->user->id . '/thumb/' );
		}
		if (Yii::app ()->user->isBuser) {
			$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
			if (! is_dir ( $path )) {
				mkdir ( $path, 0777, true );
			}
		}
		//$this->processSEO ();
		return parent::beforeAction ( $event );
	}
	
	// Actions from GxController
	
	/**
	 * Returns the data model based on the primary key or another attribute.
	 * This method is designed to work with the values passed via GET.
	 * If the data model is not found or there's a malformed key, an
	 * HTTP exception will be raised.
	 * #MethodTracker
	 * This method is based on the gii generated method controller::loadModel, from version 1.1.7 (r3135). Changes:
	 * <ul>
	 * <li>Support to composite PK.</li>
	 * <li>Support to use any attribute (column) name besides the PK.</li>
	 * <li>Support to multiple attributes.</li>
	 * <li>Automatically detects the PK column names.</li>
	 * </ul>
	 *
	 * @param mixed $key
	 *        	The key or keys of the model to be loaded.
	 *        	If the key is a string or an integer, the method will use the tables' PK if
	 *        	the PK has a single column. If the table has a composite PK and the key
	 *        	has a separator (see below), the method will detect it and use it.
	 *        	<pre>
	 *        	$key = '12-27'; // PK values with separator for tables with composite PK.
	 *        	</pre>
	 *        	If $key is an array, it can be indexed by integers or by attribute (column)
	 *        	names, as for {@link CActiveRecord::findByAttributes}.
	 *        	If the array doesn't have attribute names, as below, the method will use
	 *        	the table composite PK.
	 *        	<pre>
	 *        	$key = array(
	 *        	12,
	 *        	27,
	 *        	...,
	 *        	);
	 *        	</pre>
	 *        	If the array is indexed by attribute names, as below, the method will use
	 *        	the attribute names to search for and load the model.
	 *        	<pre>
	 *        	$key = array(
	 *        	'model_id' => 44,
	 *        	...,
	 *        	);
	 *        	</pre>
	 *        	Warning: each attribute used should have an index on the database and the set of
	 *        	attributes used should identify only one item on the database (the attributes being
	 *        	ideally part of or multiple unique keys).
	 * @param string $modelClass
	 *        	The model class name.
	 * @return ActiveRecord The loaded model.
	 * @see ActiveRecord::pkSeparator
	 * @throws CHttpException if there's an invalid request (with code 400) or if the model is not found (with code 404).
	 */
	public function loadModel($key, $modelClass) {
		
		// Get the static model.
		$staticModel = ActiveRecord::model ( $modelClass );
		
		if (is_array ( $key )) {
			// The key is an array.
			// Check if there are column names indexing the values in the array.
			reset ( $key );
			if (key ( $key ) === 0) {
				// There are no attribute names.
				// Check if there are multiple PK values. If there's only one, start again using only the value.
				if (count ( $key ) === 1)
					return $this->loadModel ( $key [0], $modelClass );
				
				// Now we will use the composite PK.
				// Check if the table has composite PK.
				$tablePk = $staticModel->getTableSchema ()->primaryKey;
				if (! is_array ( $tablePk ))
					throw new CHttpException ( 400, Yii::t ( 'giix', 'Your request is invalid.' ) );
				
				// Check if there are the correct number of keys.
				if (count ( $key ) !== count ( $tablePk ))
					throw new CHttpException ( 400, Yii::t ( 'giix', 'Your request is invalid.' ) );
				
				// Get an array of PK values indexed by the column names.
				$pk = $staticModel->fillPkColumnNames ( $key );
				
				// Then load the model.
				$model = $staticModel->findByPk ( $pk );
			} else {
				// There are attribute names.
				// Then we load the model now.
				$model = $staticModel->findByAttributes ( $key );
			}
		} else {
			// The key is not an array.
			// Check if the table has composite PK.
			$tablePk = $staticModel->getTableSchema ()->primaryKey;
			if (is_array ( $tablePk )) {
				// The table has a composite PK.
				// The key must be a string to have a PK separator.
				if (! is_string ( $key ))
					throw new CHttpException ( 400, Yii::t ( 'giix', 'Your request is invalid.' ) );
				
				// There must be a PK separator in the key.
				if (stripos ( $key, ActiveRecord::$pkSeparator ) === false)
					throw new CHttpException ( 400, Yii::t ( 'giix', 'Your request is invalid.' ) );
				
				// Generate an array, splitting by the separator.
				$keyValues = explode ( ActiveRecord::$pkSeparator, $key );
				
				// Start again using the array.
				return $this->loadModel ( $keyValues, $modelClass );
			} else {
				// The table has a single PK.
				// Then we load the model now.
				$model = $staticModel->findByPk ( $key );
			}
		}
		
		// Check if we have a model.
		if ($model === null)
			throw new CHttpException ( 404, Yii::t ( 'giix', 'The requested page does not exist.' ) );
		
		return $model;
	}
	
	/**
	 * Performs the AJAX validation.
	 * #MethodTracker
	 * This method is based on the gii generated method controller::performAjaxValidation, from version 1.1.7 (r3135). Changes:
	 * <ul>
	 * <li>Supports multiple models.</li>
	 * </ul>
	 *
	 * @param CModel|array $model
	 *        	The model or array of models to be validated.
	 * @param string $form
	 *        	The name of the form. Optional.
	 */
	protected function performAjaxValidation($model, $form = null) {
		if (Yii::app ()->getRequest ()->getIsAjaxRequest () && (($form === null) || (isset ( $_POST ['ajax'] ) && $_POST ['ajax'] == $form))) {
			echo ActiveForm::validate ( $model );
			Yii::app ()->end ();
		}
	}
	
	/**
	 * Finds the related primary keys specified in the form POST.
	 * Only for HAS_MANY and MANY_MANY relations.
	 *
	 * @param array $form
	 *        	The post data.
	 * @param array $relations
	 *        	A list of model relations in the format returned by {@link CActiveRecord::relations}.
	 * @param string $uncheckValue
	 *        	Since Yii 1.1.7, htmlOptions (in {@link Html::activeCheckBoxList})
	 *        	has an option named 'uncheckValue'. If you set it to different values than the default value (''), you will
	 *        	need to set the appropriate value to this argument. This method can't be used when 'uncheckValue' is null.
	 * @return array An array where the keys are the relation names (string) and the values are arrays with the related model primary keys (int|string) or composite primary keys (array with pk name (string) => pk value (int|string)).
	 *         Example of returned data:
	 *         <pre>
	 *         array(
	 *         'categories' => array(1, 4),
	 *         'tags' => array(array('id1' => 3, 'id2' => 7), array('id1' => 2, 'id2' => 0)) // composite pks
	 *         )
	 *         </pre>
	 *         An empty array is returned in case there is no related pk data from the post.
	 *         This data comes directly from the form POST data.
	 * @see Html::activeCheckBoxList
	 * @throws InvalidArgumentException If uncheckValue is null.
	 */
	protected function getRelatedData($form, $relations, $uncheckValue = '') {
		if ($uncheckValue === null)
			throw new InvalidArgumentException ( Yii::t ( 'giix', 'giix cannot handle automatically the POST data if "uncheckValue" is null.' ) );
		
		$relatedPk = array ();
		foreach ( $relations as $relationName => $relationData ) {
			if (isset ( $form [$relationName] ) && (($relationData [0] == GxActiveRecord::HAS_MANY) || ($relationData [0] == GxActiveRecord::MANY_MANY)))
				$relatedPk [$relationName] = $form [$relationName] === $uncheckValue ? null : $form [$relationName];
		}
		return $relatedPk;
	}
	public function StartPanel($name = 'tabpanel1') {
		$this->tabs_name = $name;
		$this->tabs_data = array ();
	}
	public function AddPanel($title, $objects, $relations, $view, $model = null, $addMenu = true) {
		if ($addMenu)
			$this->menu [] = array (
					'label' => Yii::t ( 'app', 'Add ' ) . $title,
					'url' => array (
							$view . '/create',
							'id' => $model ? $model->id : null,
							'icon' => 'icon-plus icon-white' 
					) 
			);
		
		if ($objects) {
			
			if ($objects instanceof CActiveDataProvider)
				$dataProvider = $objects;
			else
				$dataProvider = new CArrayDataProvider ( $objects );
			
			if ($dataProvider->getItemCount ()) {
				$content = $this->renderPartial ( '/' . $view . '/_list', array (
						'dataProvider' => $dataProvider 
				), true );
				$this->tabs_data [] = array (
						'label' => $title,
						'content' => $content,
						'active' => count ( $this->tabs_data ) == 0 ? true : false 
				);
			}
		}
	}
	public function EndPanel() {
		$this->widget ( 'booster.widgets.TbTabs', array (
				'type' => 'tabs', // 'tabs' or 'pills'
				'tabs' => $this->tabs_data 
			// 'htmlOptions'=>array('class'=>'tabbable tabs-left well')
		) );
	}
	/*
	 * protected function getRelatedData($form, $relations, $uncheckValue = '') {
	 * if ($uncheckValue === null)
	 * throw new InvalidArgumentException ( Yii::t ( 'giix', 'giix cannot handle automatically the POST data if "uncheckValue" is null.' ) );
	 *
	 * $relatedPk = array ();
	 * foreach ( $relations as $relationName => $relationData ) {
	 * if (isset ( $form [$relationName] ) && (($relationData [0] == ActiveRecord::HAS_MANY) || ($relationData [0] == ActiveRecord::MANY_MANY)))
	 * $relatedPk [$relationName] = $form [$relationName] === $uncheckValue ? null : $form [$relationName];
	 * }
	 * return $relatedPk;
	 * }
	 * public function startPanel($name = 'tabpanel1') {
	 * $this->tabs_name = $name;
	 * $this->tabs_data = array ();
	 * }
	 * public function addPanel($title, $objects, $relations, $view, $model = null, $addMenu = true) {
	 * if ($addMenu)
	 * $this->menu [] = array (
	 * 'label' => Yii::t ( 'app', 'Add ' ) . $title,
	 * 'url' => array (
	 * $view . '/add',
	 * 'id' => $model ? $model->id : null,
	 * 'icon' => 'icon-plus icon-white'
	 * )
	 * );
	 *
	 * if ($objects) {
	 *
	 * if ($objects instanceof CActiveDataProvider)
	 * $dataProvider = $objects;
	 * else
	 * $dataProvider = new CArrayDataProvider ( $objects );
	 *
	 * if ($dataProvider->getItemCount () || Yii::app()->controller->id == 'project') {
	 * $content = $this->renderPartial ( '//' . $view . '/_grid', array (
	 * 'dataProvider' => $dataProvider,
	 * 'prevmodel' => $model
	 * ), true );
	 * $this->tabs_data [] = array (
	 * 'label' => $title . '(' . $dataProvider->totalItemCount .')',
	 * 'content' => $content,
	 * 'active' => false
	 * );
	 * }
	 * }
	 * }
	 */
	public function missingAction($actionID) {
		$this->redirect ( array (
				'index' 
		) );
	}
	public function actionThumbnail($file) {
		$this->actionDownload ( $file, true );
	}
	public function actionDownload($file = null, $id = null) {
		if (isset ( $file )) {
			$imgFile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . basename ( $file );
			
			if ($id)
				$imgFile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . basename ( $file );
			
			if (file_exists ( $imgFile )) {
				
				$request = Yii::app ()->getRequest ();
				$request->sendFile ( basename ( $imgFile ), file_get_contents ( $imgFile ) );
			}
		}
		throw new CHttpException ( 404, Yii::t ( 'app', 'File not found' ) );
	}
	public function actionThumb($file = null, $id = null) {
		Yii::import ( 'ext.easyimage.*' );
		
		if (isset ( $file )) {
			$thumbdir = Yii::app ()->basePath . '/..' . UPLOAD_PATH . basename ( $file );
			$imgFile = Yii::app ()->basePath . '/..' . UPLOAD_PATH . $file;
			
			$thumbfile = $thumbdir . 'thumb_' . basename ( $file );
			
			if (file_exists ( $imgFile )) {
				$image = new EasyImage ( $imgFile );
				$image->resize ( 144, 144 );
				$image->save ( $thumbfile );
			}
			$this->sendFile ( $thumbfile );
		}
		$this->actionThumb ( 'coupon.jpeg' );
	}
	public static function scaleImageFile($src_file, $send = false) {
		$dst_file = dirname ( $src_file ) . DIRECTORY_SEPARATOR . 'thumbnail_' . basename ( $src_file );
		
		if (! file_exists ( $dst_file )) {
			$max_width = 200;
			$max_height = 200;
			
			list ( $width, $height, $image_type ) = getimagesize ( $src_file );
			
			switch ($image_type) {
				case 1 :
					$src = imagecreatefromgif ( $src_file );
					break;
				case 2 :
					$src = imagecreatefromjpeg ( $src_file );
					break;
				case 3 :
					$src = imagecreatefrompng ( $src_file );
					break;
				default :
					return '';
					break;
			}
			
			$x_ratio = $max_width / $width;
			$y_ratio = $max_height / $height;
			
			if (($width <= $max_width) && ($height <= $max_height)) {
				$tn_width = $width;
				$tn_height = $height;
			} elseif (($x_ratio * $height) < $max_height) {
				$tn_height = ceil ( $x_ratio * $height );
				$tn_width = $max_width;
			} else {
				$tn_width = ceil ( $y_ratio * $width );
				$tn_height = $max_height;
			}
			
			$tmp = imagecreatetruecolor ( $tn_width, $tn_height );
			
			/* Check if this image is PNG or GIF to preserve its transparency */
			if (($image_type == 1) or ($image_type == 3)) {
				imagealphablending ( $tmp, false );
				imagesavealpha ( $tmp, true );
				$transparent = imagecolorallocatealpha ( $tmp, 255, 255, 255, 127 );
				imagefilledrectangle ( $tmp, 0, 0, $tn_width, $tn_height, $transparent );
			}
			imagecopyresampled ( $tmp, $src, 0, 0, 0, 0, $tn_width, $tn_height, $width, $height );
			
			/*
			 * imageXXX() has only two options, save as a file, or send to the browser.
			 * It does not provide you the oppurtunity to manipulate the final GIF/JPG/PNG file stream
			 * So I start the output buffering, use imageXXX() to output the data stream to the browser,
			 * get the contents of the stream, and use clean to silently discard the buffered contents.
			 */
			imagejpeg ( $tmp, $dst_file, 85 );
		}
		if ($send && file_exists ( $dst_file )) {
			header ( 'Content-type: image/jpeg' );
			header ( "Content-Disposition: inline; filename=" . basename ( $dst_file ) );
			header ( "Content-Length: " . filesize ( $dst_file ) );
			readfile ( $dst_file );
		}
		return $dst_file;
	}
	protected function processActions($model = null) {
	}
	public function isCreateAllowed() {
		if (! Yii::app ()->user->isUser)
			return true;
		
		return false;
	}
	function array2csv($array, $file) {
		if (count ( $array ) == 0) {
			return null;
		}
		ob_start ();
		$path = UPLOAD_PATH;
		$df = fopen ( $path . $file, "w" );
		
		fputcsv ( $df, array_keys ( reset ( $array ) ) );
		
		foreach ( $array as $row ) {
			fputcsv ( $df, $row );
		}
		fclose ( $df );
		return ob_get_clean ();
	}
}
