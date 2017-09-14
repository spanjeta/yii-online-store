<?php

class DefaultController extends Controller
{



	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','showlogs','deleteAssets','deleteAuthsessions'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array(),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array(),
						'users'=>array('admin'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
				
		);
	}
	
	
	public function actionIndex() {
	    $this->render('index');
	}
	public function actionShowLogs(){
	    $url = Yii::app()->runtimePath.'/application.log';
	
	    if(file_exists($url)){
	       
	        $myfile = fopen($url, 'r');
	        while(!feof($myfile)) {
	            echo nl2br(fgets($myfile));
	        }
	        fclose($myfile);
	       
	    }else{
	        echo "<span style='color:green;'>No Recent Logs</span>";
	    }
	    Yii::app()->end();
	}
	public function actionDeleteAssets()
	{
	    $path = Yii::app()->getAssetManager()->basePath;
	    self::rrmdir($path);
	    $runtime = Yii::app()->runtimePath;
	    self::rrmdir($runtime);	    
	    echo "<span style='color:green;'>Deleted ..</span>";
	    Yii::app()->end();
	}
	
	public static function rrmdir($dir, $delete = false)
	{
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != "..") {
					if (filetype($dir . "/" . $object) == "dir") {
						self::rrmdir($dir . "/" . $object, true);
					} else
						if ($object != 'assets') {
	
							if (unlink($dir . "/" . $object))
								echo '<p style="color:red">Removed File : ' . $dir . "/" . $object . '<br /></p>';
						}
				}
			}
			reset($objects);
	
			if ($delete) {
				if (rmdir($dir))
					echo '<p style="color:grey">Removed Directory :' . $dir . '<br /></p>';
			}
		}
	}
	public function actionDeleteAuthsessions()
	{
	    $auths = AuthSession::model()->findAll();
	    if ($auths) {
	        foreach($auths as $auth) {
	            $auth->delete();
	            echo "<span style='color:red;'> The user logged in from this device id is deleted : ".$auth->auth_code ."</span><br/>";
	        }
	    }else{
	        echo "<span style='color:green'>No user is loggen in</span>";
	    }
	
	}
	
}