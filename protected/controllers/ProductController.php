<?php
class ProductController extends Controller {
	public function filters() {
		return array ();
		// 'accessControl',
	}
	public function accessRules() {
		return array (
				array (
						'allow',
						'actions' => array (
								'index',
								'filterSearch',
								'productSearch',
								'view',
								'download',
								'thumbnail',
								'info',
								'thumb',
								'cart',
								'att',
								'productPrice',
								'productSize',
								'summary',
								'list',
								'searchList',
								'searchResults',
								'pay',
								'searchAttribute',
								'checkSize',
								'searchVariant',
								'rate',
								'newView',
								'getprice',
								'brandlist',
								'prodcutImages' 
						
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'preview',
								'enq',
								'varient',
								'addCart',
								'search',
								'inventory',
								'emporium',
								'offers',
								'order',
								'ajaxIndex',
								'productPrice',
								'productSize',
								'manage',
								'pupimages',
								'orderb',
								'addImages',
								'pimages',
								'sortItems',
								'paym',
								'checkSize',
								'wishlist',
								
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'createVarProduct',
								'updateVarient',
								'addVarientImages',
								'deleteImage',
								'delete',
								'update',
								'create',
								'admin',
								'productPrice',
								'productSize',
								'import',
								'delete' 
						),
						'expression' => 'Yii::app()->user->isAdmin' 
				),
				array (
						'deny',
						'actions' => array (
								'create',
								'admin',
								'productPrice',
								'productSize',
								'import',
								'delete' 
						),
						'users' => array (
								'*',
								'@' 
						) 
				) 
		);
	}
	public function actionPay() {
		$this->render ( 'pay' );
		// $this->render('enq');
	}
	public function actionSearchResults($q = null) {
		$this->layout = 'column1';
		
		$model = new Product ();
		$terms = explode ( '(', $q );
		if (isset ( $terms ['0'] )) {
			$q = $terms ['0'];
		}
		
		$criteria = new CDbCriteria ();
		if ($q != null) {
			$criteria->compare ( 'title', $q, true );
		}
		// $criteria->order = 'id desc';
		// $criteria->order = 'CAST(markup_price as decimal(20,6)) ASC';
		$criteria->addCondition ( 'price != 0' );
		// $criteria->addCondition ( 'image_file != ""' );
		
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria,
				'pagination' => array (
						'pageSize' => 12 
				) 
		) );
		
		$this->render ( 'results', array (
				'dataProvider' => $dataProvider,
				'model' => $model,
				'q' => $q 
		) );
	}
	public function actionImport() {
		$model = new ProductPrice ();
		ini_set ( 'max_execution_time', 300 );
		// echo ini_get('max_execution_time');
		$flag = false;
		$response = null;
		if (isset ( $_FILES ['ProductPrice'] )) {
			
			$csv_file = $_FILES ['ProductPrice'] ['tmp_name'] ['image_file'];
			
			if ($csv_file != null) {
				$handle = fopen ( $csv_file, "r" );
				
				if ($handle != null) {
					$transaction = Yii::app ()->db->beginTransaction ();
					try {
						$delimiter = $model->getDelimiter ( $csv_file );
						
						$headers = fgetcsv ( $handle, 1000, $delimiter );
						// $data = fgetcsv ( $handle, 1000, ";" );
						
						// print_r($headers);
						
						while ( ($data = fgetcsv ( $handle, 1000, $delimiter )) !== FALSE ) {
							
							$data_values = array_combine ( $headers, $data );
							
							// echo $data_values ['Title_E'];
							ProductPrice::import ( $data_values );
							$flag = true;
						}
						
						$transaction->commit ();
						if ($flag == true) {
							Yii::app ()->user->setFlash ( 'success', '<strong> Done ! </strong> File is uploaded successfully.' );
						}
					} catch ( Exception $e ) {
						$transaction->rollback ();
						// echo $e->getTraceAsString();
						echo $e->getMessage () . PHP_EOL . "<BR>";
						Yii::app ()->user->setFlash ( 'danger', $e->getMessage () );
					}
					
					fclose ( $handle );
				}
			} else {
				Yii::app ()->user->setFlash ( 'danger', 'No File Found.' );
			}
		}
		
		$this->redirect ( array (
				'admin' 
		) );
	}
	public function actionPaym() {
		$payment = new PaypalTest ();
		$payment->splitPay ();
	}
	public function actionSearchAttribute($id) {
		$arr = array (
				'controller' => $this->id,
				'action' => $this->action->id,
				'status' => 'NOK' 
		);
		$product = Product::model ()->findByPk ( $id );
		
		$criteria = new CDbCriteria ();
		$criteria->group = 'color_id';
		if (isset ( $_POST ['color'] ))
			$criteria->addCondition ( 'color_id =' . $_POST ['color'] );
		$criteria->addCondition ( 'product_id =' . $product->prod_id );
		$variantProduct = VariantProduct::model ()->find ( $criteria );
		if (isset ( $_POST ['color'] )) {
			if ($product->color_id == $_POST ['color']) {
				$variantProduct = $product;
			}
		}
		if ($variantProduct != null) {
			$arr ['status'] = 'OK';
			$arr ['image'] = $variantProduct->image_file;
		}
		$this->sendJSONResponse ( $arr );
	}
	/*
	 * public function actionGetPrice($id) {
	 * $arr = array (
	 * 'controller' => $this->id,
	 * 'action' => $this->action->id,
	 * 'status' => 'NOK'
	 * );
	 *
	 * if ($variantProduct != null) {
	 * $arr ['status'] = 'OK';
	 * $arr ['image'] = $variantProduct->image_file;
	 * }
	 * $this->sendJSONResponse ( $arr );
	 * }
	 */
	public function actionSearchVariant($id) {
		$arr = array (
				'controller' => $this->id,
				'action' => $this->action->id,
				'status' => 'NOK' 
		);
		$variantProduct = VariantProduct::model ()->findByPk ( $id );
		if ($variantProduct) {
			$product = Product::model ()->findByAttributes ( array (
					'prod_id' => $variantProduct->product_id 
			) );
			
			$criteria = new CDbCriteria ();
			$criteria->group = 'color_id';
			if (isset ( $_POST ['color'] ))
				$criteria->addCondition ( 'color_id =' . $_POST ['color'] );
			$criteria->addCondition ( 'product_id =' . $product->prod_id );
			$variantProduct = VariantProduct::model ()->find ( $criteria );
			if (isset ( $_POST ['color'] )) {
				if ($product->color_id == $_POST ['color']) {
					$variantProduct = $product;
				}
			}
			if ($variantProduct != null) {
				$arr ['status'] = 'OK';
				$arr ['image'] = $variantProduct->image_file;
			}
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionProductImages($vId, $pId) {
		$arr = array (
				'controller' => $this->id,
				'action' => $this->action->id,
				'status' => 'NOK',
				'error' => '' 
		);
		
		$models = ProductImage::model ()->findAllByAttributes ( array (
				'product_id' => $pId,
				'var_id' => $vId 
		) );
		
		$array = array ();
		$modelData = array ();
		
		if (! empty ( $models )) {
			foreach ( $models as $model ) {
				
				// $array[] = $model->image_path;
				
				$array [] = Yii::app ()->createAbsoluteUrl ( 'product/download', array (
						'file' => $model->image_path 
				) );
				
				/*
				 * $array = array (
				 * 'id' => $model->id,
				 * 'product_id' => $model->product_id,
				 * 'var_id' => $model->var_id,
				 * 'image_path' =>$model->image_path,
				 * //'discount_price' => $model->discount_price,
				 * 'type_id' => $model->type_id,
				 * 'state_id' => $model->state_id
				 * );
				 */
				
				// $modelData [] = $array;
			}
		}
		
		$arr ['data'] = $array;
		
		echo json_encode ( $arr );
		Yii::app ()->end ();
	}
	public function actionProductPrice($cId, $pId) {
		$arr = array (
				'controller' => $this->id,
				'action' => $this->action->id,
				'status' => 'NOK',
				'error' => '' 
		);
		
		$models = VarProduct::model ()->findAllByAttributes ( array (
				'product_id' => $pId,
				'color_id' => $cId 
		) );
		
		$array = array ();
		$modelData = array ();
		
		if (! empty ( $models )) {
			foreach ( $models as $model ) {
				$criteria = new CDbCriteria ();
				$criteria->addCondition ( 'product_id =' . $pId );
				$criteria->addCondition ( 'var_id = ' . $model->id );
				
				$criteria->order = 'id DESC';
				// $criteria->limit = 4;
				$image = ProductImage::model ()->findAll ( $criteria );
				
				$img = array ();
				if (! empty ( $image )) {
					foreach ( $image as $imge ) {
						if (! empty ( $imge->image_path )) {
							$img [] = Yii::app ()->createAbsoluteUrl ( 'product/download', array (
									'file' => $imge->image_path 
							) );
						}
					}
				}
				
				$array = array (
						'id' => $model->id,
						'sku' => $model->sku,
						'product_id' => $model->product_id,
						'color_id' => $model->color_id,
						'color_title' => isset ( $model->size ) ? $model->size->title : '',
						'size_id' => $model->size_id,
						'quantity' => $model->quantity,
						
						'image' => $img,
						
						'price' => $model->price,
						'discount_price' => $model->discount_price,
						'type_id' => $model->type_id,
						'state_id' => $model->state_id 
				);
				
				$modelData [] = $array;
			}
		}
		
		$arr ['data'] = $modelData;
		
		echo json_encode ( $arr );
		Yii::app ()->end ();
	}
	public function actionProductSize($cId, $pId, $sId) {
		$arr = array (
				'controller' => $this->id,
				'action' => $this->action->id,
				'status' => 'NOK',
				'error' => '' 
		);
		
		$model = VarProduct::model ()->findByAttributes ( array (
				'product_id' => $pId,
				'color_id' => $cId,
				'size_id' => $sId 
		) );
		
		$array = array ();
		
		if (! empty ( $model )) {
			$array = array (
					'id' => $model->id,
					'sku' => $model->sku,
					'product_id' => $model->product_id,
					'color_id' => $model->color_id,
					'color_title' => isset ( $model->size ) ? $model->size->title : '',
					'size_id' => $model->size_id,
					'quantity' => $model->quantity,
					'price' => $model->price,
					'discount_price' => $model->discount_price,
					'type_id' => $model->type_id,
					'state_id' => $model->state_id 
			);
		}
		
		$arr ['data'] = $array;
		
		echo json_encode ( $arr );
		Yii::app ()->end ();
	}
	
	/**
	 * This action is used only for in case of ajax action url on view where we redirect on login on product info
	 * when click on add cart
	 * Enter description here ...
	 *
	 * @param unknown_type $id        	
	 */
	public function actionAddCart($id) {
		$this->redirect ( array (
				'user/login' 
		) );
		// $this->render('enq');
	}
	/**
	 * This action is used only for in case of ajax action url on view where we redirect on login on product info
	 * when click on enquiry
	 * Enter description here ...
	 *
	 * @param unknown_type $id        	
	 */
	public function actionEnq($id) {
		$this->redirect ( array (
				'info',
				'id' => $id 
		) );
		// $this->render('enq');
	}
	public function actionAtt() {
		$model = new Product ();
		$atts = $model->getValidatorList ();
		
		echo '<pre>';
		
		print_r ( $atts );
		
		// print_r($atts[0]->attributes);
	}
	public function actionSortItems() {
		if (isset ( $_POST ['items'] ) && is_array ( $_POST ['items'] )) {
			foreach ( $_POST ['items'] as $index => $id ) {
				$item = TempFile::model ()->findByPk ( $id );
				if ($item) {
					$item->order_no = $index;
					$item->saveAttributes ( array (
							'order_no' 
					) );
					echo "<p>$index : $id</p>"; // this isn't needed, but useful for checking that the data was received ok
				}
			}
		}
		exit (); // exit here so the response is kept short, you could always return a confirm message
	}
	public function actionCart($id) {
		$product = Product::model ()->findByPk ( $id );
		// if($product)
		$this->render ( 'cart', array (
				'product' => $product 
		) );
	}
	public function actionDeleteImage($id) {
		$temp = TempFile::model ()->findByPk ( $id );
		if ($temp) {
			$file = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER . $temp->image_path;
			if (file_exists ( $file )) {
				unlink ( $file );
			}
			$temp->delete ();
		}
	}
	/**
	 * Add images for product in temp db
	 */
	public function actionAddImages() {
		$model = new TempFile ();
		
		$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
		
		$arr = array (
				'error' => '',
				'success' => '' 
		);
		
		$uploaded_file = CUploadedFile::getInstanceByName ( 'image_file' );
		if ($uploaded_file) {
			$filename = $path . 'Product' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			// list ( $width, $height ) = getimagesize ( $uploaded_file->tempName );
			
			// if ($width != 1000 || $height != 1200) {
			// $arr ['error'] = 'Image size should be 1000*1200 dimension';
			// } else {
			$uploaded_file->saveAs ( $filename );
			$model->image_path = basename ( $filename );
			$model->type_id = TempFile::PRODUCT_IMAGE;
			if ($model->save ()) {
				$arr ['success'] = 'success';
				// }
			}
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionCheckSize() {
		$model = new TempFile ();
		
		$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH_USER;
		
		$arr = array (
				'error' => '' 
		);
		
		$uploaded_file = CUploadedFile::getInstanceByName ( 'image_file' );
		if ($uploaded_file) {
			$filename = $path . 'Product' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			list ( $width, $height ) = getimagesize ( $uploaded_file->tempName );
			
			if ($width >= 300 || $height >= 250) {
				$arr ['error'] = Yii::t('app','banner size should be 1500*500 dimension');
			}
			
			$arr ['width'] = $width;
			$arr ['height'] = $height;
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionAddVarientImages() {
		$model = new TempFile ();
		$path = Yii::app ()->basePath . '/..' . UPLOAD_PATH;
		
		$uploaded_file = CUploadedFile::getInstanceByName ( 'image_file' );
		if ($uploaded_file) {
			$filename = $path . 'VarProduct' . uniqid () . '_' . time () . '.' . $uploaded_file->getExtensionName ();
			$uploaded_file->saveAs ( $filename );
			$model->image_path = basename ( $filename );
			$model->type_id = TempFile::VARIENT_PRODUCT_IMAGE;
			if ($model->save ()) {
				echo 'success';
			} else {
				echo 'not save';
			}
		} else {
			echo 'not uploaded';
		}
	}
	public function actionReturn() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'state_id = ' . Payment::STATUS_CANCEL );
		
		$payments = Payment::model ()->findAll ( $criteria );
		$this->render ( 'returnproduct', array (
				'model' => $payments 
		) );
	}
	/**
	 *
	 * @param
	 *        	product image
	 */
	public function actionPimages() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'type_id = ' . TempFile::PRODUCT_IMAGE );
		$images = TempFile::model ()->findAll ( $criteria );
		$this->renderPartial ( '_pimages', array (
				'images' => $images 
		), 
				// 'id'=>$id,
				false, true );
	}
	
	/**
	 *
	 * @param
	 *        	varient product image
	 */
	public function actionVarPimages() {
		$criteria = new CDbCriteria ();
		$criteria->addCondition ( 'create_user_id =' . Yii::app ()->user->id );
		$criteria->addCondition ( 'type_id = ' . TempFile::VARIENT_PRODUCT_IMAGE );
		$images = TempFile::model ()->findAll ( $criteria );
		$this->renderPartial ( '_pimages', array (
				'images' => $images 
		), 
				// 'id'=>$id,
				false, true );
	}
	
	/**
	 *
	 * @param
	 *        	product information
	 */
	public function actionInfo($id) {
		$product = Product::model ()->findByPk ( $id );
		
		if ($product) {
			// $product->increaseViewCount(Home::TYPE_PRODUCT);
			$this->render ( 'info', array (
					'product' => $product 
			) );
		}
	}
	public function actionSummary($id) {
		$product = Product::model ()->findByPk ( $id );
		
		if ($product) {
			// $product->increaseViewCount(Home::TYPE_PRODUCT);
			$this->render ( 'summary', array (
					'product' => $product 
			) );
		}
	}
	public function actionPreview($id) {
		$product = Product::model ()->findByPk ( $id );
		if ($product)
			$this->render ( 'preview', array (
					'product' => $product 
			) );
	}
	
	/*
	 * Before change the this action rename it from the index of Product.
	 */
	public function actionInventory() {
		// $criteria = new CDbCriteria;
		// $criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		// $dataProvider = new CActiveDataProvider('Product',array('criteria'=>$criteria));
		$model = new Product ( 'search' );
		$model->unsetAttributes ();
		
		if (isset ( $_GET ['Product'] ))
			
			$model->setAttributes ( $_GET ['Product'] );
		
		$this->render ( 'inventory', array (
				'model' => $model 
		) );
	}
	public function actionEmporium() {
		$empimages = ImporiumImage::model ()->findAll ();
		
		$this->render ( 'imporium', array (
				'empimages' => $empimages 
		) );
	}
	public function actionOffers() {
		$this->render ( 'offers' );
	}
	public function isAllowed($model) {
		if ($model == null) {
			throw new CHttpException ( 403, Yii::t ( 'app', 'requested page does not exist.' ) );
		}
		return $model->isAllowed ();
	}
	public function actionRate() {
		$response = [ 
				'status' => 'NOK' 
		];
		
		// $data = json_encode ( $_GET );
		
		$ratingModel = Rating::model ()->findByAttributes ( [ 
				'create_user_id' => yii::app ()->user->id,
				'product_id' => $_GET ['product_id'] 
		] );
		
		if (! $ratingModel) {
			$model = new Rating ();
			$model->rating = $_GET ['rateValue'];
			$model->product_id = $_GET ['product_id'];
			if ($model->save ()) {
				$model->updateAvgRate ( $_GET ['product_id'] );
				
				$response ['status'] = "OK";
			}
		} else {
			
			// $ratingModel->setAttributes ( $_POST ['Rating'] );
			
			$ratingModel->rating = $_GET ['rateValue'];
			$ratingModel->product_id = $_GET ['product_id'];
			if ($ratingModel->save ()) {
				$ratingModel->updateAvgRate ( $_GET ['product_id'] );
				$response ['status'] = "OK";
			}
		}
		
		echo CJSON::encode ( $response );
		
		Yii::app ()->end ();
	}
	public function actionView($id) {
		$this->layout = 'main';
		$model = $this->loadModel ( $id, 'Product' );
		
		$criteria = new CDbCriteria ();
		$criteria->group = 'color_id';
		$criteria->compare ( 'product_id', $model->prod_id );
		$relatedProducts = VariantProduct::model ()->findAll ( $criteria );
		$lowerPriceProducts = '';
		/*
		 * foreach ($model as $m){
		 * if ($model->quantity == Order::STATE_){
		 * $model->quantity--;
		 * }
		 * }
		 */
		// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		// $this->processActions($model);
		$this->updateMenuItems ( $model );
		$this->render ( 'view', array (
				'model' => $model,
				'relatedProducts' => $relatedProducts 
		) );
	}
	public function actionViewProduct($id) {
		$userModel = new User ();
		
		if (Yii::app ()->user->isAdmin) {
			
			$this->layout = 'admin';
			$model = $this->loadModel ( $id, 'Product' );
			$criteria = new CDbCriteria ();
			$criteria->group = 'color_id';
			$criteria->compare ( 'product_id', $model->prod_id );
			$relatedProducts = VariantProduct::model ()->findAll ( $criteria );
			$lowerPriceProducts = '';
			// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
			// $this->processActions($model);
			$this->updateMenuItems ( $model );
			$this->render ( 'viewproduct', array (
					'model' => $model,
					'relatedProducts' => $relatedProducts 
			) );
		} else {
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		}
	}
	public function actionNewView($id) {
		$this->layout = 'main';
		$model = $this->loadModel ( $id, 'Product' );
		$criteria = new CDbCriteria ();
		$criteria->group = 'color_id';
		$criteria->compare ( 'product_id', $model->prod_id );
		$relatedProducts = VariantProduct::model ()->findAll ( $criteria );
		$lowerPriceProducts = '';
		// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		// $this->processActions($model);
		$this->updateMenuItems ( $model );
		$this->render ( 'newview', array (
				'model' => $model,
				'relatedProducts' => $relatedProducts 
		) );
	}
	public function actionWishList($id) {
		$this->layout = 'main';
		// $model = $this->loadModel ( $id, 'WishList' );
		
		$criteria = new CDbCriteria ();
		// $criteria->group = 'color_id';
		$criteria->compare ( 'create_user_id', $id );
		$relatedProducts = WishList::model ()->findAll ( $criteria );
		// $lowerPriceProducts = '';
		// if(!($this->isAllowed($model))) throw new CHttpException(403, Yii::t('app','You are not allowed to access this page.'));
		// $this->processActions($model);
		// $this->updateMenuItems ( $model );
		$this->render ( 'wishlist', array (
				// 'model' => $model,
				'relatedProducts' => $relatedProducts 
		) );
	}
	/**
	 * This action is used for single listing product
	 */
	public function actionCreate() {
		$model = new Product ();
		$temp = TempFile::model ()->findAll ();
		if (! $this->isAllowed ( $model )) {
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		}
		$this->performAjaxValidation ( $model, 'product-form' );
		
		if (isset ( $_POST ['Product'] )) {
			
			$model->setAttributes ( $_POST ['Product'] );
			
			$code = User::randomPassword ( 5, true );
			$model->product_code = $code;
			// print_r($temp);exit;
			if (! empty ( $temp )) {
				if ($model->save ()) {
					$varProduct = new VarProduct ();
					
					$varProduct->product_id = $model->id;
					$varProduct->brand_id = $model->brand_id;
					$varProduct->color_id = $model->color_id;
					$varProduct->size_id = $model->size_id;
					$varProduct->quantity = $model->quantity;
					$varProduct->price = $model->price;
					$varProduct->sku = $model->sku;
					$varProduct->discount_price = $model->discount_price;
					$varProduct->save ();
					
					if (! empty ( $model->size_id )) {
						$model->addRelatedSizeOnWeb ();
					}
					
					$model->linkImages ( TempFile::PRODUCT_IMAGE );
					// if(isset($_POST['button2']))
					// {
					$this->redirect ( array (
							'admin' 
					) );
					// }
					
					// $this->redirect(array('preview','id'=>$model->id));
					
					Yii::app ()->end ();
				}
			} else {
				Yii::app ()->user->setFlash ( 'error', 'Images can not be empty' );
			}
		} else {
			
			if (Yii::app ()->user->id)
				$model->deleteTemp ( TempFile::PRODUCT_IMAGE );
		}
		
		$this->updateMenuItems ( $model );
		if (Yii::app ()->user->isAdmin)
			$this->render ( 'create', array (
					'model' => $model 
			) );
		else
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
	}
	
	/**
	 * This action is used for variated product listing
	 */
	public function actionVarient() {
		$model = new Product ();
		$variation = new VarProduct ();
		$postage = Yii::app ()->user->model->postage;
		$payment = Yii::app ()->user->model->paymentSetting;
		$this->performAjaxValidation ( $model, 'create-product-variated-form' );
		if (isset ( $_POST ['Product'] )) {
			if ($postage && $payment) {
				$model->setAttributes ( $_POST ['Product'] );
				if (! empty ( $model->brand )) {
					$brand = new Brand ();
					$brand->title = $model->brand;
					$brand->save ();
					$model->brand_id = $brand->id;
				}
				$company = Yii::app ()->user->model->company;
				$shopcode = $company->shop_code;
				$code = User::randomPassword ( 3, true );
				$model->product_code = $shopcode . $code;
				$model->store_id = $company->id;
				if ($model->save ()) {
					if (! empty ( $model->related_items )) {
						$model->addRelatedItems ();
					}
					if (! empty ( $model->like_items )) {
						$model->addRelatedLikes ();
					}
					if (! empty ( $model->size_id )) {
						$model->addRelatedSizeOnWeb ();
					}
					$model->addHomeFeatured ( Home::TYPE_PRODUCT );
					$model->addSitedata ( Home::TYPE_PRODUCT );
					$model->linkImages ( TempFile::PRODUCT_IMAGE );
					if (isset ( $_POST ['button2'] )) {
						$this->redirect ( array (
								'createVarProduct',
								'pid' => $model->id 
						) );
					}
					$this->redirect ( array (
							'preview',
							'id' => $model->id 
					) );
					Yii::app ()->end ();
				}
			} else {
				$model->addError ( 'payment', 'Before adding product please verify your postage and payment method' );
			}
		} else {
			print_r ( $model->getErrors () );
			$model->deleteTemp ( TempFile::PRODUCT_IMAGE );
		}
		
		$this->updateMenuItems ( $model );
		$this->render ( 'varient', array (
				'model' => $model 
		) );
	}
	public function actionCreateVarProduct($pid) {
		$product = Product::model ()->findByPk ( $pid );
		if (! $this->isAllowed ( $product )) {
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		}
		
		$variation = new VarProduct ();
		$variation->product_id = $product->id;
		if (isset ( $_POST ['VarProduct'] )) {
			$variation->setAttributes ( $_POST ['VarProduct'] );
			if ($variation->save ()) {
				$variation->linkImages ( TempFile::VARIENT_PRODUCT_IMAGE );
				if (! empty ( $variation->size_id )) {
					$variation->addRelatedSizeOnWeb ();
				}
				if (isset ( $_POST ['submitagain'] )) {
					$this->redirect ( array (
							'createVarProduct',
							'pid' => $pid 
					) );
				}
				$this->redirect ( array (
						'inventory' 
				) );
			}
		}
		$this->render ( 'varient_product', array (
				'variation' => $variation,
				'product' => $product 
		) );
	}
	public function actionUpdateVarient($vpid = null, $pid = null) {
		$variation = VarProduct::model ()->findByPk ( $vpid );
		if (! $this->isAllowed ( $variation )) {
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		}
		$variation->linkImages ( TempFile::VARIENT_PRODUCT_IMAGE );
		if (isset ( $_POST ['VarProduct'] )) {
			$variation->setAttributes ( $_POST ['VarProduct'] );
			if ($variation->save ()) {
				
				if (! empty ( $variation->size_id )) {
					// $variation->addRelatedSizeOnWeb();
				}
				if (isset ( $_POST ['submitagain'] )) {
					$this->redirect ( array (
							'createVarProduct',
							'pid' => $pid 
					) );
				}
				$this->redirect ( array (
						'inventory' 
				) );
			}
		}
		$this->render ( 'updateVarient', array (
				'variation' => $variation 
		) );
	}
	public function actionUpdate($id) {
		$model = $this->loadModel ( $id, 'Product' );
		
		if (! ($model->isAllowed ()))
			throw new CHttpException ( 403, Yii::t ( 'app', 'You are not allowed to access this page.' ) );
		
		$this->performAjaxValidation ( $model, 'product-form' );
		
		if (isset ( $_POST ['Product'] )) {
			$model->setAttributes ( $_POST ['Product'] );
			
			if ($model->save ()) {
				/*
				 * if(!empty($model->related_items))
				 * {
				 * $model->addRelatedByApi();
				 * }
				 * if(!empty($model->size_id))
				 * {
				 * $model->a
				 * +ddRelatedSize();
				 * }
				 */
				$model->linkImages ( TempFile::PRODUCT_IMAGE );
				
				$this->redirect ( array (
						'admin' 
				) );
				
				Yii::app ()->end ();
			} else {
				TempFile::deleteTemp ( TempFile::PRODUCT_IMAGE );
			}
		}
		$this->updateMenuItems ( $model );
		$this->render ( 'update', array (
				'model' => $model 
		) );
	}
	public function actionDelete($id) {
		$this->loadModel ( $id, 'Product' )->delete ();
		
		// if (Yii::app ()->getRequest ()->getIsPostRequest ()) {
		
		if (! Yii::app ()->getRequest ()->getIsAjaxRequest ())
			$this->redirect ( array (
					'admin' 
			) );
		// } else
		// throw new CHttpException ( 400, Yii::t ( 'app', 'Your request is invalid.' ) );
	}
	public function actionIndex() {
		if (method_exists ( $this, 'actionInventory' )) {
			$this->redirect ( array (
					'inventory' 
			) );
		}
		
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'Product' );
		$this->render ( 'index', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionAjaxIndex() {
		$this->updateMenuItems ();
		$dataProvider = new CActiveDataProvider ( 'Product' );
		$this->renderPartial ( '_plist', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionSearch() {
		$model = new Product ( 'search' );
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		
		if (isset ( $_GET ['Product'] )) {
			$model->setAttributes ( $_GET ['Product'] );
			$this->renderPartial ( '_list', array (
					'dataProvider' => $model->search (),
					'model' => $model 
			) );
		}
		
		$this->renderPartial ( '_search', array (
				'model' => $model 
		) );
	}
	public function actionList($id, $cat_id = null, $q = null) {
		$this->layout = 'column1';
		$cat_ids = [ ];
		
		$category = Category::model ()->findByPk ( $id );
		if ($category)
			$cat_ids = $category->getSubcategoryIds ();
		$colors = Color::model ()->findAll ();
		if ($cat_id != null) {
			$cat_ids = array (
					$cat_id 
			);
		}
		$model = new Product ();
		
		$criteria = new CDbCriteria ();
		
		$criteria->addInCondition ( 'category_id', $cat_ids );
		
		$products = Product::model ()->findAll ( $criteria );
		
		$criteria = new CDbCriteria ();
		if ($q != null) {
			$criteria->compare ( 'title', $q, true );
		}
		
		$criteria->addInCondition ( 'category_id', $cat_ids );
		
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria 
		) );
		
		$this->render ( 'list', array (
				'dataProvider' => $dataProvider,
				'category' => $category,
				'model' => $model,
				'colors' => $colors,
				'products' => $products,
				'id' => $id,
				'q' => $q,
				'cat_id' => $cat_id 
		) );
	}
	public function actionBrandList($id) {
		$model = Brand::model ()->findByPk ( $id );
		$this->layout = 'main';
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'brand_id', $id );
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria 
		) );
		$this->render ( 'brandlist', array (
				'dataProvider' => $dataProvider,
				'id' => $id,
				'model' => $model 
		) );
	}
	public function actionProductSearch($id, $cat_id = null) {
		$arr ['status'] = 'NOK';
		$model = new Product ( 'search' );
		$category = Category::model ()->findByPk ( $id );
		if ($category)
			$cat_ids = $category->getSubcategoryIds ();
		$criteria = new CDbCriteria ();
		if (isset ( $_POST ['Product'] ['category_id'] )) {
			
			$cat_ids = $_POST ['Product'] ['category_id'];
			
			$_SESSION ['category_id'] = $cat_ids;
		}
		$criteria->addInCondition ( 'category_id', $cat_ids );
		if (isset ( $_POST ['Product'] ['size_id'] )) {
			
			$size_id = $_POST ['Product'] ['size_id'];
			
			$_SESSION ['size_id'] = $size_id;
			$criteria->compare ( 'size_id ', $size_id );
		}
		if (isset ( $_POST ['Product'] ['brand_id'] )) {
			
			$brand_id = $_POST ['Product'] ['brand_id'];
			
			$_SESSION ['brand_id'] = $brand_id;
			$criteria->compare ( 'brand_id ', $brand_id );
		}
		if (isset ( $_POST ['Product'] ['color_id'] )) {
			
			$color_id = $_POST ['Product'] ['color_id'];
			
			$_SESSION ['color_id'] = $color_id;
			$criteria->compare ( 'color_id ', $color_id );
		}
		if (isset ( $_POST ['Product'] ['min_price'] ) && isset ( $_POST ['Product'] ['max_price'] )) {
			
			if ($_POST ['Product'] ['min_price'] != '' && $_POST ['Product'] ['max_price'] != '') {
				$min_price = $_POST ['Product'] ['min_price'];
				$max_price = $_POST ['Product'] ['max_price'];
				
				$criteria->addBetweenCondition ( 'price', $min_price, $max_price );
			}
		}
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria 
		) );
		$arr ['status'] = 'OK';
		$arr ['html'] = $this->renderPartial ( '_search', array (
				'dataProvider' => $dataProvider,
				array (
						'pagination' => false 
				) 
		), true, false );
		if (isset ( $_GET ['Product_page'] )) {
			$page = null;
			$cat_ids = [ ];
			if (isset ( $_SESSION ['category_id'] ) || isset ( $_SESSION ['size_id'] ) || isset ( $_SESSION ['brand_id'] )) {
				$criteria = new CDbCriteria ();
				if (isset ( $_SESSION ['category_id'] )) {
					$cat_ids = $_SESSION ['category_id'];
				}
				$criteria->addInCondition ( 'category_id', $cat_ids );
				if (isset ( $_SESSION ['size_id'] )) {
					$size_id = $_SESSION ['size_id'];
					$criteria->compare ( 'size_id ', $size_id );
				}
				if (isset ( $_SESSION ['brand_id'] )) {
					$brand_id = $_SESSION ['brand_id'];
					$criteria->compare ( 'brand_id ', $brand_id );
				}
				if (isset ( $_SESSION ['color_id'] )) {
					$color_id = $_SESSION ['color_id'];
					$criteria->compare ( 'color_id ', $color_id );
				}
				
				$dataProvider = new CActiveDataProvider ( 'Product', array (
						'criteria' => $criteria 
				) );
				
				$page = $_GET ['Product_page'];
				
				$arr ['status'] = 'OK';
				$arr ['html'] = $this->redirect ( array (
						'searchList',
						'id' => $id,
						'cat_id' => $cat_id,
						'page' => $page 
				) );
			}
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionSearchList($id, $cat_id = null, $q = null) {
		$this->layout = 'column1';
		$category = Category::model ()->findByPk ( $id );
		
		$colors = Color::model ()->findAll ();
		
		$model = new Product ();
		
		$criteria = new CDbCriteria ();
		if (isset ( $_SESSION ['category_id'] )) {
			$cat_ids = $_SESSION ['category_id'];
		} else {
			$cat_ids = $category->getSubcategoryIds ();
			$criteria->addInCondition ( 'category_id', $cat_ids );
		}
		if (isset ( $_SESSION ['size_id'] )) {
			$criteria->compare ( 'size_id', $_SESSION ['size_id'] );
		}
		if (isset ( $_SESSION ['brand_id'] )) {
			$criteria->compare ( 'brand_id', $_SESSION ['brand_id'] );
		}
		
		$products = Product::model ()->findAll ( $criteria );
		
		$criteria->addInCondition ( 'category_id', $cat_ids );
		
		$dataProvider = new CActiveDataProvider ( 'Product', array (
				'criteria' => $criteria 
		) );
		
		$this->render ( 'list', array (
				'dataProvider' => $dataProvider,
				'category' => $category,
				'model' => $model,
				'colors' => $colors,
				'products' => $products,
				'id' => $id,
				'q' => $q,
				'cat_id' => $cat_id 
		) );
	}
	public function actionFilterSearch($id, $cat_id = null) {
		$arr ['status'] = 'NOK';
		$model = new Product ( 'search' );
		
		if (isset ( $_POST ['Product'] )) {
			$criteria = new CDbCriteria ();
			$sort_id = $_POST ['Product'] ['sort_id'];
			$sort_order = $_POST ['Product'] ['sort_order_id'];
			$category = Category::model ()->findByPk ( $id );
			$cat_ids = $category->getSubcategoryIds ();
			
			$criteria->addInCondition ( 'category_id', $cat_ids );
			
			if (isset ( $_POST ['Product'] ['min_price'] ) && isset ( $_POST ['Product'] ['max_price'] )) {
				if ($_POST ['Product'] ['min_price'] != '' && $_POST ['Product'] ['max_price'] != '') {
					$min_price = $_POST ['Product'] ['min_price'];
					$max_price = $_POST ['Product'] ['max_price'];
					
					$criteria->addBetweenCondition ( 'price', $min_price, $max_price );
				}
			}
			if (isset ( $_POST ['Product'] ['color_id'] )) {
				if ($_POST ['Product'] ['color_id'] != '') {
					$criteria1 = new CDbCriteria ();
					$criteria1->compare ( 'title', $_POST ['Product'] ['color_id'] );
					$color = Color::model ()->find ( $criteria1 );
					if ($color)
						$criteria->compare ( 'color_id', $color->id );
				}
			}
			$criteria->order = $sort_id . ' ' . $sort_order;
			
			$dataProvider = new CActiveDataProvider ( 'Product', array (
					'criteria' => $criteria 
			) );
			$arr ['status'] = 'OK';
			$arr ['html'] = $this->renderPartial ( '_search', array (
					'dataProvider' => $dataProvider,
					array (
							'pagination' => false 
					) 
			), true, false );
		}
		$this->sendJSONResponse ( $arr );
	}
	public function actionAdmin() {
		if (! (Yii::app ()->user->isAdmin))
			throw new CHttpException ( 403, Yii::t ( 'app', 'you are not allowed to access this page.' ) );
		$model = new Product ( 'search' );
		
		$model->unsetAttributes ();
		$this->updateMenuItems ( $model );
		if (isset ( $_GET ['Product'] ))
			$model->setAttributes ( $_GET ['Product'] );
		
		$this->render ( 'admin', array (
				'model' => $model 
		) );
	}
	protected function updateMenuItems($model = null) {
		// create static model if model is null
		if ($model == null)
			$model = new Product ();
		
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
							'label' => Yii::t ( 'app', 'create' ),
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
					$this->menu [] = array (
							'label' => Yii::t ( 'app', 'delete' ),
							'url' => '#',
							'linkOptions' => array (
									'submit' => array (
											'delete',
											'id' => $model->id 
									),
									'confirm' => Yii::t('app','are you sure you want to delete this item?') 
							),
							'visible' => Yii::app ()->user->isAdmin,
							'icon' => 'icon-remove icon-white' 
					);
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
		$this->actions = array_merge ( $this->actions, $this->menu );
	}
}