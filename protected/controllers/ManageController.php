<?php
class ManageController extends Controller {
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
								'logout' 
						),
						'users' => array (
								'*' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'index' 
						),
						'users' => array (
								'@' 
						) 
				),
				array (
						'allow',
						'actions' => array (
								'admin',
								'delete',
								'acissue',
								'bus',
								'faq',
								'content',
								'flat',
								'deal',
								'product',
								'blog',
								'emporium',
								'blog',
								'page',
								'button' 
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
	 * This action is using for showing site home contents
	 * Enter description here ...
	 */
	public function actionContent() {
		$message = new Message ();
		
		$sliders = SliderImage::model ()->my ()->findAll ();
		
		$criteria = new CDbCriteria ();
		$criteria->limit = 5;
		$criteria->order = 'order_no ASC, id desc';
		
		$homes = SiteHome::model ()->resetScope ()->findAll ( $criteria );
		$this->render ( 'content', array (
				'message' => $message,
				'homes' => $homes,
				'sliders' => $sliders 
		) );
	}
	public function actionButton() {
		$dataProvider = new CActiveDataProvider ( 'Button' );
		$this->render ( 'button', array (
				'dataProvider' => $dataProvider 
		) );
	}
	public function actionProduct() {
		$model = new Product ( 'search' );
		$grid_view = 'id,state_id,title,user,feature_site,price,related_products,Stock,Views,item_sold,item_returned,Date_Modified';
		$grid_view .= ',Date_Created,Total_Live_Days,List_Fees,Sold_Fees,is_sale';
		$inner_list = array ();
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ['Product'] ))
			$model->setAttributes ( $_GET ['Product'] );
		if (isset ( $_GET ['Coloumns'] )) {
			$columns = $_GET ['Coloumns'];
			// $columns = array_keys($model->getAttributes($_GET['Product']));
		}
		
		if (isset ( $columns ) and in_array ( 'id', $columns )) {
			$inner_list [] = array (
					'name' => 'id' 
			);
		}
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'header' => 'Status',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => Product::getStatusOptions () 
			);
		}
		
		if (in_array ( 'title', $columns )) {
			$inner_list [] = array (
					'name' => 'title' 
			);
		}
		if (in_array ( 'user', $columns )) {
			$inner_list [] = array (
					'name' => 'user',
					'value' => '$data->createUser->email' 
			
			);
		}
		if (in_array ( 'feature_site', $columns )) {
			$inner_list [] = array (
					'name' => 'feature_site',
					'value' => '$data->getFeatureOptions($data->feature_site )', // before it was, (feature_site)
					'filter' => Product::getFeatureOptions () 
			);
		}
		if (in_array ( 'price', $columns )) {
			$inner_list [] = array (
					'name' => 'price',
					'value' => '$data->price',
					'header' => 'price ($)' 
			);
		}
		if (in_array ( 'related_products', $columns )) {
			$inner_list [] = array (
					'header' => 'related_products',
					'value' => '$data->relatedCount' 
			);
		}
		if (in_array ( 'Stock', $columns )) {
			$inner_list [] = array (
					'name' => 'sku',
					'header' => 'Stock',
					'value' => '$data->sku' 
			);
		}
		if (in_array ( 'Views', $columns )) {
			$inner_list [] = array (
					'name' => 'view_count',
					'header' => 'Views',
					'value' => '$data->view_count' 
			);
		}
		if (in_array ( 'item_sold', $columns )) {
			$inner_list [] = array (
					'header' => 'item_sold',
					'value' => '$data->getsoldCount' 
			);
		}
		if (in_array ( 'item_returned', $columns )) {
			$inner_list [] = array (
					'header' => 'item_returned',
					'value' => '$data->countReturnItem()' 
			);
		}
		
		if (in_array ( 'Date_Modified', $columns )) {
			
			$inner_list [] = array (
					'name' => 'Date_Modified',
					'type' => 'raw',
					'value' => '(strtotime($data->update_time)) ? date("j F y", strtotime($data->update_time)) : date("j F", strtotime($data->update_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'update_time',
							'htmlOptions' => array (
									'id' => 'update_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		
		if (in_array ( 'Date_Created', $columns )) {
			
			$inner_list [] = array (
					'name' => 'Date_Created',
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
		if (in_array ( 'Total_Live_Days', $columns )) {
			$inner_list [] = array (
					
					'header' => 'Total_Live_Days',
					'value' => 'Product::getTotalLiveday($data)' 
			);
		}
		if (in_array ( 'List_Fees', $columns )) {
			$inner_list [] = array (
					'name' => 'List_Fees',
					'value' => '' 
			);
		}
		if (in_array ( 'Sold_Fees', $columns )) {
			$inner_list [] = array (
					'name' => 'Sold_Fees',
					
					'value' => '' 
			);
		}
		if (in_array ( 'is_sale', $columns )) {
			$inner_list [] = array (
					'name' => 'is_sale',
					'value' => '$data->onsale() ? "Sale" : "New" ',
					'filter' => Product::getSale () 
			);
		}
		// $inner_list[] = array('class'=>'CButtonColumn');
		$this->render ( 'product', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionEmporium() {
		$model = new Emporium ( 'search' );
		$grid_view = 'id,Thumb,state_id,title,user,type,Products_Tagged,Views,Date_Modified,Date_Created,Total_Live_Days';
		$inner_list = array ();
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ['Emporium'] )) {
			$model->setAttributes ( $_GET ['Emporium'] );
		}
		if (isset ( $_GET ["Coloumns"] ))
			$columns = $_GET ["Coloumns"];
		if (isset ( $columns ) and in_array ( 'id', $columns )) {
			$inner_list [] = array (
					'name' => 'id' 
			);
		}
		if (in_array ( 'Thumb', $columns )) {
			$inner_list [] = array (
					'type' => 'raw',
					'header' => 'Thumb',
					'value' => 'CHtml::image(Yii::app()->createUrl("emporium/download",
						array("file"=>$data->image_file,"id"=>$data->create_user_id)),"thumb")' 
			);
		}
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => Emporium::getStatusOptions () 
			);
		}
		if (in_array ( 'title', $columns )) {
			$inner_list [] = array (
					'name' => 'title' 
			
			);
		}
		
		if (in_array ( 'user', $columns )) {
			$inner_list [] = array (
					'name' => 'user',
					'value' => '$data->createUser->email' 
			);
		}
		if (in_array ( 'type', $columns )) {
			$inner_list [] = array (
					'name' => 'type_id',
					'value' => '$data->getTypeOptions($data->type_id)',
					'filter' => Emporium::getTypeOptions () 
			);
		}
		
		if (in_array ( 'Products_Tagged', $columns )) {
			$inner_list [] = array (
					'header' => 'Products_Tagged',
					'name' => 'tags',
					'value' => '$data->tags' 
			);
		}
		
		if (in_array ( 'Views', $columns )) {
			$inner_list [] = array (
					'name' => 'view_count',
					'header' => 'Views',
					'value' => '$data->view_count' 
			);
		}
		
		if (in_array ( 'Date_Modified', $columns )) {
			
			$inner_list [] = array (
					'name' => 'Date_Modified',
					'type' => 'raw',
					'value' => '(strtotime($data->update_time)) ? date("j F y", strtotime($data->update_time)) : date("j F", strtotime($data->update_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'update_time',
							'htmlOptions' => array (
									'id' => 'update_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		
		if (in_array ( 'Date_Created', $columns )) {
			$inner_list [] = array (
					'name' => 'Date_Created',
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
		if (in_array ( 'Total_Live_Days', $columns )) {
			$inner_list [] = array (
					
					'header' => 'Total_Live_Days',
					'value' => 'Product::getTotalLiveday($data)' 
			);
		}
		
		// $inner_list[] = array('class'=>'CButtonColumn');
		$this->render ( 'emporium', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionBlog() {
		$model = new Blog ( 'search' );
		// if (isset($_GET['Product']))
		// $model->setAttributes($_GET['Product']);
		$grid_view = 'id,state_id,title,user,type_id,category_id,Views,Date_Modified,Date_Created';
		
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ["Blog"] )) {
			$model->setAttributes ( $_GET ['Blog'] );
		}
		if (isset ( $_GET ["Coloumns"] ))
			$columns = $_GET ["Coloumns"];
		$inner_list = array ();
		if (isset ( $columns ) and in_array ( 'id', $columns )) {
			$inner_list [] = array (
					'name' => 'id' 
			);
		}
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'header' => 'Status',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => Blog::getStatusOptions () 
			);
		}
		
		if (in_array ( 'title', $columns )) {
			$inner_list [] = array (
					'name' => 'title' 
			);
		}
		if (in_array ( 'user', $columns )) {
			$inner_list [] = array (
					'name' => 'user',
					'value' => '$data->createUser->email' 
			);
		}
		if (in_array ( 'type_id', $columns )) {
			$inner_list [] = array (
					'name' => 'type_id',
					'value' => '$data->getTypeOptions($data->type_id)',
					'filter' => Blog::getTypeOptions () 
			);
		}
		if (in_array ( 'category_id', $columns )) {
			$inner_list [] = array (
					'name' => 'category_id',
					'value' => '$data->type->title',
					'filter' => BlogCategory::getCategoryOptions () 
			);
		}
		if (in_array ( 'Views', $columns )) {
			$inner_list [] = array (
					'name' => 'view_count',
					'header' => 'Views',
					'value' => '$data->view_count' 
			);
		}
		
		if (in_array ( 'Date_Modified', $columns )) {
			
			$inner_list [] = array (
					'name' => 'Date_Modified',
					'type' => 'raw',
					'value' => '(strtotime($data->update_time)) ? date("j F y", strtotime($data->update_time)) : date("j F", strtotime($data->update_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'update_time',
							'htmlOptions' => array (
									'id' => 'update_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		if (in_array ( 'Date_Created', $columns )) {
			$inner_list [] = array (
					'name' => 'Date_Created',
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
		$this->render ( 'blog', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionDeal() {
		$model = new Deal ( 'search' );
		$grid_view = 'id,state_id,title,user,automatic_extension,type_id,price,Related_Products,stock,Views,Item_Sold,Item_Returned';
		$grid_view .= ',start_date,Total_Live_Days,List_Fees,Sold_Fees,Deal_Discription,Deal_Amount';
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ["Deal"] )) {
			$model->setAttributes ( $_GET ['Deal'] );
		}
		if (isset ( $_GET ["Coloumns"] ))
			$columns = $_GET ["Coloumns"];
		
		$inner_list = array ();
		if (isset ( $columns ) and in_array ( 'id', $columns )) {
			$inner_list [] = array (
					'name' => 'id' 
			);
		}
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'header' => 'Status',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => Deal::getStatusOptions () 
			);
		}
		
		if (in_array ( 'title', $columns )) {
			$inner_list [] = array (
					'name' => 'title' 
			);
		}
		if (in_array ( 'user', $columns )) {
			$inner_list [] = array (
					'name' => 'user',
					'value' => '$data->createUser->email' 
			);
		}
		if (in_array ( 'automatic_extension', $columns )) {
			$inner_list [] = array (
					'name' => 'automatic_extension',
					'header' => 'automatic_extension (Weeks)' 
			);
		}
		if (in_array ( 'type_id', $columns )) {
			$inner_list [] = array (
					'name' => 'type_id',
					'value' => '$data->getTypeOptions($data->type_id)',
					'filter' => Deal::getTypeOptions () 
			);
		}
		
		if (in_array ( 'price', $columns )) {
			$inner_list [] = array (
					'header' => 'price',
					'value' => '$data->getPriceOfProduct()',
					'header' => 'price ($)' 
			);
		}
		if (in_array ( 'Related_Products', $columns )) {
			$inner_list [] = array (
					'header' => 'Related_Products',
					'value' => '$data->getRelatedCount()' 
			
			);
		}
		if (in_array ( 'stock', $columns )) {
			$inner_list [] = array (
					'header' => 'stock',
					'value' => '$data->dealQuantity()' 
			);
		}
		if (in_array ( 'Views', $columns )) {
			$inner_list [] = array (
					'header' => 'Views',
					'value' => '$data->getTotalViewCount()' 
			);
		}
		if (in_array ( 'Item_Sold', $columns )) {
			$inner_list [] = array (
					'header' => 'Item_Sold',
					'value' => '$data->getTotalSoldCount()' 
			);
		}
		if (in_array ( 'Item_Returned', $columns )) {
			$inner_list [] = array (
					'header' => 'Item_Returned',
					'value' => '$data->item->product->countReturnItem()' 
			);
		}
		
		if (in_array ( 'start_date', $columns )) {
			$inner_list [] = array (
					'name' => 'start_date',
					'type' => 'raw',
					'value' => '(strtotime($data->start_date)) ? date("j F y", strtotime($data->start_date)) : date("j F", strtotime($data->start_date))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'start_date',
							'htmlOptions' => array (
									'id' => 'start_date_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		if (in_array ( 'Total_Live_Days', $columns )) {
			$inner_list [] = array (
					
					'header' => 'Total_Live_Days',
					'value' => 'Product::getTotalLiveday($data)' 
			);
		}
		if (in_array ( 'List_Fees', $columns )) {
			$inner_list [] = array (
					'name' => 'List_Fees',
					'value' => '' 
			);
		}
		if (in_array ( 'Sold_Fees', $columns )) {
			$inner_list [] = array (
					'name' => 'Sold_Fees',
					'value' => '' 
			);
		}
		if (in_array ( 'Deal_Discription', $columns )) {
			$inner_list [] = array (
					'name' => 'title',
					'header' => 'Deal_Discription',
					'value' => '$data->title' 
			);
		}
		if (in_array ( 'Deal_Amount', $columns )) {
			$inner_list [] = array (
					'header' => 'Deal_Amount',
					'value' => '$data->dealAmount()' 
			
			);
		}
		// $inner_list[] = array('class'=>'CButtonColumn');
		$this->render ( 'deal', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionPage() {
		$model = new Page ( 'search' );
		// if (isset($_GET['Product']))
		// $model->setAttributes($_GET['Product']);
		$grid_view = 'id,state_id,title,user,type_id,Views,Date_Modified,Date_Created';
		
		$columns = explode ( ',', $grid_view );
		$model->unsetAttributes ();
		if (isset ( $_GET ["Page"] )) {
			$model->setAttributes ( $_GET ['Page'] );
		}
		if (isset ( $_GET ["Coloumns"] ))
			$columns = $_GET ["Coloumns"];
		
		$inner_list = array ();
		if (isset ( $columns ) and in_array ( 'id', $columns )) {
			$inner_list [] = array (
					'name' => 'id' 
			);
		}
		if (in_array ( 'state_id', $columns )) {
			$inner_list [] = array (
					'name' => 'state_id',
					'value' => '$data->getStatusOptions($data->state_id)',
					'filter' => Page::getStatusOptions () 
			);
		}
		
		if (in_array ( 'title', $columns )) {
			$inner_list [] = array (
					'name' => 'url',
					'header' => 'title' 
			);
		}
		if (in_array ( 'user', $columns )) {
			$inner_list [] = array (
					'name' => 'user',
					'value' => '$data->createUser->email' 
			);
		}
		if (in_array ( 'type_id', $columns )) {
			$inner_list [] = array (
					'name' => 'type_id',
					'value' => '$data->getTypeOptions($data->type_id)',
					'filter' => Page::getTypeOptions () 
			);
		}
		
		if (in_array ( 'Views', $columns )) {
			$inner_list [] = array (
					'header' => 'Views',
					'name' => 'view_count',
					'value' => '$data->view_count' 
			);
		}
		
		if (in_array ( 'Date_Modified', $columns )) {
			
			$inner_list [] = array (
					'name' => 'Date_Modified',
					'type' => 'raw',
					'value' => '(strtotime($data->update_time)) ? date("j F y", strtotime($data->update_time)) : date("j F", strtotime($data->update_time))',
					'filter' => $this->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
							'model' => $model,
							'attribute' => 'update_time',
							'htmlOptions' => array (
									'id' => 'update_time_search' 
							),
							'options' => array (
									'dateFormat' => 'yy-mm-dd' 
							) 
					), true ) 
			);
		}
		
		if (in_array ( 'Date_Created', $columns )) {
			$inner_list [] = array (
					'name' => 'Date_Created',
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
		$this->render ( 'flatpage', array (
				'model' => $model,
				'columns' => $columns,
				'inner_list' => $inner_list 
		) );
	}
	public function actionProdColumn() {
		$model = new User ();
		
		$columns = array_keys ( $model->getAttributes ( $model->safeAttributeNames ) ); // we are getting in a array.array('id','name','age','sex','email','address'),
		/*
		 * echo '<pre>';
		 * print_r($model->getAttributes());
		 * print_r($columns);
		 * echo '</pre>';
		 */
		// die('OK');
		if (isset ( $_GET ["Columns"] ))
			$columns = $_GET ["Columns"]; // If user chooses the column, column names changes accordingly.
		$model->unsetAttributes (); // clear any default values
		if (isset ( $_GET ['User'] ))
			$model->attributes = $_GET ['User'];
		
		$this->render ( 'admin', array (
				'model' => $model,
				'columns' => $columns 
		) );
	}
}