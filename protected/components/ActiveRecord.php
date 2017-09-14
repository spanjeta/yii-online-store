<?php
abstract class ActiveRecord extends CActiveRecord {
	public static $pkSeparator = '-';
	//public static $pkSeparator = '-';
	const TYPE_BLOG = 0;
	const TYPE_PRODUCT = 1;
	const TYPE_EMPORIUM = 2;
	const TYPE_DEAL = 3;
	const TYPE_OFFER = 4;
	const TYPE_STORE = 5;
	const TYPE_ALL = 10;
	
	/**getContentType
	 * this is for search on category page.
	 */
	
	const SEARCH_CAT = 1;
	const SEARCH_STORE = 2;
	const SEARCH_BRAND = 3;
	const SEARCH_COLOR = 4;
	const SEARCH_PRICE = 5;
	
	
	/**
	 * this is for Bulk upload section and image media in inventory section
	 */
	const CSV_IMAGE = 3;
	
	
	// this is for admin dashboard page
	const STATIC_BUS = 1;
	const STATIC_USER = 2;
	const STATIC_CONTENT = 3;
	
	
	// this is for category management
	const CATEGORY_SHOP = 1;
	const CATEGORY_BLOG = 2;
	const CATEGORY_PRODUCT = 3;
	const CATEGORY_MAIN = 0;
	
	// postage rule
	
	const TYPE_RULE = 1;
	const TYPE_CUSTOM = 2;
	
	// megamenu options for switch case :
	
	const ACTIVE_DASHBOARD = 1;
	const ACTIVE_STORE = 2;
	const ACTIVE_INVENTORY = 3;
	const ACTIVE_ORDER = 4;
	const ACTIVE_CONTENT = 5;
	const ACTIVE_MESSAGE = 6;
	const ACTIVE_ACCOUNT = 7;
	const ACTIVE_SHIPPING = 8;
	const ACTIVE_CREDIT = 9;
	
	// constant for pop up
	
	const POPUP_WARRANTY = 1;
	const POPUP_POSTAGE = 2;
	const POPUP_PAYMENT = 3;
	
	// this one is used in case of STORE  popup information
	
	const STORE_CONTACT = 1;
	const STORE_ABOUT = 2;
	const STORE_TERMS = 3;
	const STORE_DELIVERY = 4;
	// ----------------------------------------------------------//
	
	//Constant for product variation and product image used in product table, product image table
	// ---------------------------------------------------//
	const	TYPE_SINGLE_PRODUCT = 1;
	const	TYPE_VAR_PRODUCT = 2;
	public static function model($className = __CLASS__) {
		return parent::model ( $className );
	}
	public static function label($n = 1) {
		throw new Exception ( Yii::t ( 'app', 'This method should be overriden by the Active Record class.' ) );
	}
	public function getType() {
		if ($this->hasAttribute ( 'type_id' ))
			return $this->getTypeOptions ( $this->type_id );
		return "";
	}
	public static function getLabelOptions($id = null) {
		$labels = array (
				"default",
				"success",
				"primary",
				"info",
				"warning",
				"success",
				"danger",
				"default",
				"success",
				"primary",
				"info",
				"warning",
				"success",
				"danger" 
		);
		
		if ($id === null)
			return $labels;
		if (is_numeric ( $id ))
			return $labels [$id % count ( $labels )];
		return $id;
	}
	public static function getLanguageName($key = null) {
		if ($key == 'en') {
			return 'En';
		} else {
			return 'Zh';
		}
	}
	public function isDelayed() {
		$end_date = /* $this->hasAttribute ( 'planned_end_date' ) ? $this->planned_end_date : $this->hasAttribute ( 'end_date') ? $this->end_date :  */time ();
		$now = time () - (1 * 24 * 60 * 60); // 1 day
		$end = strtotime ( $end_date );
		return ($now > $end);
	}
	  public function getValue($model, $attribute, $defaultValue) {
		switch ($attribute) {
			case 'state_id' :
				return $model->getStatusOptions ( $model->$attribute );
			case 'type_id' :
				return $model->getTypeOptions ( $model->$attribute );
		}
		
		return $model->$attribute;
	}
	public $_oldAttrbiutes;
	public function afterFind() {
		$this->_oldAttrbiutes = $this->attributes;
	} 
	protected function afterSave() {
		if (! Yii::app ()->user->isGuest) {
			
			$msg = 'Updated ' . $this->label () . ' ';
			
			if ($this->isNewRecord)
				$msg = 'Added new ' . $this->label () . ' ';
			
			if ($this->hasAttribute ( 'id' )) {
				//$this->updateFeeds ( $msg );
			}
			
			//UserRating::updateScore ( $this );
			return true;
		}
		
		return parent::afterSave ();
	}
	protected function beforeDelete() {
		/* if ($this->hasAttribute ( 'id' )) {
			$msg = 'Deleted ' . $this->label () . ' ';
			if (Yii::app ()->controller->id != 'feed')
				$this->updateFeeds ( $msg );
			
			Comment::model ()->deleteRelatedAll ( array (
					'model_id' => $this->id,
					'model_type' => get_class ( $this ) 
			) );
			Feed::model ()->deleteRelatedAll ( array (
					'project_id' => $this->id,
					'model_type' => get_class ( $this ) 
			) );
			File::model ()->deleteRelatedAll ( array (
					'model_id' => $this->id,
					'model_type' => get_class ( $this ) 
			) );
		}*/
		return parent::beforeDelete (); 
	}
	public function deleteRelatedAll($query) {
		$models = $this->findAllByAttributes ( $query );
		foreach ( $models as $model ) {
			Yii::log ( get_class ( $model ) . '-' . $model, CLogger::LEVEL_WARNING, '$model' );
			$model->delete ();
		}
	}
	public function updateFeeds($content) {
		$class = get_class ( $this );
		$model = new Feed ();
		if ($this->hasAttribute ( 'project_id' ))
			$model->project_id = $this->project_id;
		
		$model->model_type = $class;
		$model->model_id = $this->id;
		$model->content = $content;
		if ($model->save ()) {
			return true;
		}
		return false;
	}
	public function addCommentHistory($content) {
		$class = get_class ( $this );
		$model = new Comment ();
		if ($this->hasAttribute ( 'project_id' ))
			$model->project_id = $this->project_id;
		
		$model->model_type = $class;
		$model->model_id = $this->id;
		$model->comment = $content;
		if ($model->save ()) {
			return true;
		}
		return false;
	}
	public function getRelationLabel($relationName, $n = null, $useRelationLabel = true) {
		// Exploding the chained relation names.
		$relNames = explode ( '.', $relationName );
		
		// Everything starts with this object.
		$relClassName = get_class ( $this );
		
		// The item index.
		$relIndex = 0;
		
		// Get the count of relation names;
		$countRelNames = count ( $relNames );
		
		// Walk through the chained relations.
		foreach ( $relNames as $relName ) {
			// Increments the item index.
			$relIndex ++;
			
			// Get the related static class.
			$relStaticClass = self::model ( $relClassName );
			
			// If is is the last name and the label is explicitly defined, return it.
			if ($relIndex === $countRelNames) {
				$labels = $relStaticClass->attributeLabels ();
				if (isset ( $labels [$relName] ))
					return $labels [$relName];
			}
			
			// Get the relations for the current class.
			$relations = $relStaticClass->relations ();
			
			// Check if there is (not) a relation with the current name.
			if (! isset ( $relations [$relName] )) {
				// There is no relation with the current name. It is an attribute or a property.
				// It must be the last name.
				if ($relIndex === $countRelNames) {
					// Check if it is an attribute.
					$attributeNames = $relStaticClass->attributeNames ();
					$isAttribute = in_array ( $relName, $attributeNames );
					// If it is an attribute and the attribute is a FK and $useRelationLabel is true, return the related AR label.
					if ($isAttribute && $useRelationLabel && (($relData = self::findRelation ( $relStaticClass, $relName )) !== null)) {
						// This will always be a BELONGS_TO, then singular.
						return self::model ( $relData [3] )->label ( 1 );
					} else {
						// There's no label for this attribute or property, generate one.
						return $relStaticClass->generateAttributeLabel ( $relName );
					}
				} else {
					// It is not the last item.
					throw new InvalidArgumentException ( Yii::t ( 'app', 'The attribute "{attribute}" should be the last name.', array (
							'{attribute}' => $relName 
					) ) );
				}
			}
			
			// Change the current class name: walk to the next relation.
			$relClassName = $relations [$relName] [1];
		}
		
		// Automatically apply the correct number if requested.
		if ($n === null) {
			// Get the type of the last relation from the last but one class.
			$relType = $relations [end ( $relNames )] [0];
			
			switch ($relType) {
				case self::HAS_MANY :
				case self::MANY_MANY :
					$n = 2;
					break;
				case self::BELONGS_TO :
				case self::HAS_ONE :
				default :
					$n = 1;
			}
		}
		
		// Get and return the label from the related AR.
		return self::model ( $relClassName )->label ( $n );
	}
	public function getAttributeLabel($attribute) {
		return $this->getRelationLabel ( $attribute );
	}
	public static function representingColumn() {
		return null;
	}
	public function __toString() {
		$representingColumn = $this->representingColumn ();
		
		if (($representingColumn === null) || ($representingColumn === array ()))
			if ($this->getTableSchema ()->primaryKey !== null) {
				$representingColumn = $this->getTableSchema ()->primaryKey;
			} else {
				$columnNames = $this->getTableSchema ()->getColumnNames ();
				$representingColumn = $columnNames [0];
			}
		
		if (is_array ( $representingColumn )) {
			$part = '';
			foreach ( $representingColumn as $representingColumn_item ) {
				$part .= ($this->$representingColumn_item === null ? '' : $this->$representingColumn_item) . '-';
			}
			return substr ( $part, 0, - 1 );
		} else {
			return $this->$representingColumn === null ? '' : ( string ) $this->$representingColumn;
		}
	}
	public function findAllAttributes($attributes = null, $withPk = false, $condition = '', $params = array()) {
		$criteria = $this->getCommandBuilder ()->createCriteria ( $condition, $params );
		if ($attributes === null)
			$attributes = $this->representingColumn ();
		if ($withPk) {
			$pks = self::model ( get_class ( $this ) )->getTableSchema ()->primaryKey;
			if (! is_array ( $pks ))
				$pks = array (
						$pks 
				);
			if (! is_array ( $attributes ))
				$attributes = array (
						$attributes 
				);
			$attributes = array_merge ( $pks, $attributes );
		}
		$criteria->select = $attributes;
		return parent::findAll ( $criteria );
	}
	public static function extractPkValue($model, $forceString = false) {
		if ($model === null)
			return null;
		if (! is_array ( $model )) {
			$pk = $model->getPrimaryKey ();
			if ($forceString && is_array ( $pk ))
				$pk = implode ( self::$pkSeparator, $pk );
			return $pk;
		} else {
			$pks = array ();
			foreach ( $model as $model_item ) {
				$pks [] = self::extractPkValue ( $model_item, $forceString );
			}
			return $pks;
		}
	}
	public function fillPkColumnNames($pk) {
		// Get the table PK column names.
		$columnNames = $this->getTableSchema ()->primaryKey;
		
		// Check if the count of values and columns match.
		$columnCount = count ( $columnNames );
		if (count ( $pk ) !== $columnCount)
			throw new InvalidArgumentException ( Yii::t ( 'app', 'The count of values in the argument "pk" ({countPk}) does not match the count of columns in the composite PK ({countColumns}).' ), array (
					'{countPk}' => count ( $pk ),
					'{countColumns}' => $columnCount 
			) );
			
			// Build the array indexed by the column names.
		if ($columnCount === 1) {
			if (is_array ( $pk ))
				$pk = $pk [0];
			return array (
					$columnNames => $pk 
			);
		} else {
			$result = array ();
			for($columnIndex = 0; $columnIndex < $columnCount; $columnIndex ++) {
				$result [$columnNames [$columnIndex]] = $pk [$columnIndex];
			}
			return $result;
		}
	}
	public function saveWithRelated($relatedData, $runValidation = true, $attributes = null, $options = array()) {
		// Merge the specified options with the default options.
		$options = array_merge ( 
				// The default options.
				array (
						'withTransaction' => true,
						'batch' => true 
				), 
				// The specified options.
				$options );
		
		try {
			// Start the transaction if required.
			if ($options ['withTransaction'] && ($this->getDbConnection ()->getCurrentTransaction () === null)) {
				$transacted = true;
				$transaction = $this->getDbConnection ()->beginTransaction ();
			} else
				$transacted = false;
				
				// Save the main model.
			if (! $this->save ( $runValidation, $attributes )) {
				if ($transacted)
					$transaction->rollback ();
				return false;
			}
			
			// If there is related data, call saveRelated.
			if (! empty ( $relatedData )) {
				if (! $this->saveRelated ( $relatedData, $runValidation, $options ['batch'] )) {
					if ($transacted)
						$transaction->rollback ();
					return false;
				}
			}
			
			// If transacted, commit the transaction.
			if ($transacted)
				$transaction->commit ();
		} catch ( Exception $ex ) {
			// If there is an exception, roll back the transaction...
			if ($transacted)
				$transaction->rollback ();
				// ... and rethrow the exception.
			throw $ex;
		}
		return true;
	}
	protected function saveRelated($relatedData, $runValidation = true, $batch = true) {
		if (empty ( $relatedData ))
			return true;
			
			// This active record can't be new for the method to work correctly.
		if ($this->getIsNewRecord ())
			throw new CDbException ( Yii::t ( 'app', 'Cannot save the related records to the database because the main record is new.' ) );
			
			// Save each related data.
		foreach ( $relatedData as $relationName => $relationData ) {
			// The pivot model class name.
			$pivotClassNames = $this->pivotModels ();
			$pivotClassName = $pivotClassNames [$relationName];
			$pivotModelStatic = ActiveRecord::model ( $pivotClassName );
			// Get the foreign key names for the models.
			$activeRelation = $this->getActiveRelation ( $relationName );
			$relatedClassName = $activeRelation->className;
			if (preg_match ( '/(.+)\((.+),\s*(.+)\)/', $activeRelation->foreignKey, $matches )) {
				// By convention, the first fk is for this model, the second is for the related model.
				$thisFkName = $matches [2];
				$relatedFkName = $matches [3];
			}
			// Get the primary key value of the main model.
			$thisPkValue = $this->getPrimaryKey ();
			if (is_array ( $thisPkValue ))
				throw new Exception ( Yii::t ( 'app', 'Composite primary keys are not supported.' ) );
				// Get the current related models of this relation and map the current related primary keys.
			$currentRelation = $pivotModelStatic->findAll ( new CDbCriteria ( array (
					'select' => $relatedFkName,
					'condition' => "$thisFkName = :thisfkvalue",
					'params' => array (
							':thisfkvalue' => $thisPkValue 
					) 
			) ) );
			$currentMap = array ();
			foreach ( $currentRelation as $currentRelModel ) {
				$currentMap [] = $currentRelModel->$relatedFkName;
			}
			// Compare the current map to the new data and identify what is to be kept, deleted or inserted.
			$newMap = $relationData;
			$deleteMap = array ();
			$insertMap = array ();
			if ($newMap !== null) {
				// Identify the relations to be deleted.
				foreach ( $currentMap as $currentItem ) {
					if (! in_array ( $currentItem, $newMap ))
						$deleteMap [] = $currentItem;
				}
				// Identify the relations to be inserted.
				foreach ( $newMap as $newItem ) {
					if (! in_array ( $newItem, $currentMap ))
						$insertMap [] = $newItem;
				}
			} else // If the new data is empty, everything must be deleted.
				$deleteMap = $currentMap;
				// If nothing changed, we simply continue the loop.
			if (empty ( $deleteMap ) && empty ( $insertMap ))
				continue;
				// Now act inserting and deleting the related data: first prepare the data.
				// Inject the foreign key names of both models and the primary key value of the main model in the maps.
			foreach ( $deleteMap as &$deleteMapPkValue )
				$deleteMapPkValue = array_merge ( array (
						$relatedFkName => $deleteMapPkValue 
				), array (
						$thisFkName => $thisPkValue 
				) );
			unset ( $deleteMapPkValue ); // Clear reference;
			foreach ( $insertMap as &$insertMapPkValue )
				$insertMapPkValue = array_merge ( array (
						$relatedFkName => $insertMapPkValue 
				), array (
						$thisFkName => $thisPkValue 
				) );
			unset ( $insertMapPkValue ); // Clear reference;
			                             // Now act inserting and deleting the related data: then execute the changes.
			                             // Delete the data.
			if (! empty ( $deleteMap )) {
				if ($batch) {
					// Delete in batch mode.
					if ($pivotModelStatic->deleteByPk ( $deleteMap ) !== count ( $deleteMap )) {
						return false;
					}
				} else {
					// Delete one active record at a time.
					foreach ( $deleteMap as $value ) {
						$pivotModel = ActiveRecord::model ( $pivotClassName )->findByPk ( $value );
						if (! $pivotModel->delete ()) {
							return false;
						}
					}
				}
			}
			// Insert the new data.
			foreach ( $insertMap as $value ) {
				$pivotModel = new $pivotClassName ();
				$pivotModel->setAttributes ( $value );
				if (! $pivotModel->save ( $runValidation )) {
					return false;
				}
			}
		} // This is the end of the loop "save each related data".
		
		return true;
	}
	public static function saveMultiple($models, $runValidation = true, $options = array()) {
		// Merge the specified options with the default options.
		$options = array_merge ( 
				// The default options.
				array (
						'withTransaction' => true,
						'detectRelations' => false 
				), 
				// The specified options.
				$options );
		// Define the default model options.
		$defaultModelOptions = array (
				'runValidation' => true,
				'attributes' => null,
				'relatedData' => null,
				'batch' => true 
		);
		
		// If $models is a single record, make it an array.
		if (! is_array ( $models ))
			$models = array (
					$models 
			);
			
			// The saved models array.
		$savedModels = array ();
		
		try {
			// Start the transaction if required.
			if ($options ['withTransaction'] && ($this->getDbConnection ()->getCurrentTransaction () === null)) {
				$transacted = true;
				$transaction = $this->getDbConnection ()->beginTransaction ();
			} else
				$transacted = false;
			
			foreach ( $models as $modelItem ) {
				// Get the model instance.
				$model = $modelItem ['model'];
				// Merge the options.
				if (isset ( $modelItem ['modelOptions'] ) && ($modelItem ['modelOptions'] !== array ()))
					$modelOptions = array_merge ( $defaultModelOptions, $modelItem ['modelOptions'] );
				else
					$modelOptions = $defaultModelOptions;
					// If set, the global "runValidation" value overrides the model setting.
				if ($runValidation !== null)
					$modelOptions ['runValidation'] = $runValidation;
					
					// Detect automatically the new active record and fill in the data for its FK.
				if ($options ['detectRelations']) {
					// Find if the model is new...
					if ($model->getIsNewRecord ()) {
						// ... if the model has a BELONGS_TO relation...
						foreach ( $model->relations () as $relationName => $relationData ) {
							if ($relationData [0] === ActiveRecord::BELONGS_TO) {
								// ...and if its FK is null.
								$fkName = $relationData [2];
								if ($model->$fkName === null) {
									// The FK is null. We need to fill it in.
									// We take the related model class name.
									$relatedClassName = $relationData [1];
									// And look for it in the array of the already saved models.
									if (isset ( $savedModels [$relatedClassName] )) {
										// We assume that this is the related model and
										// we assume that the relation is to the PK.
										$model->$fkName = $savedModels [$relatedClassName]->getPrimaryKey ();
									} else {
										// Related model not found.
										// We can't continue without filling up the FK!
										throw new Exception ( Yii::t ( 'app', 'Related model not found. Cannot continue without filling up the FK.' ) );
									}
								}
							}
						}
					}
				} // This is the end of 'detectRelations' loop.
				  // Save the model
				if (! $this->save ( $modelOptions ['runValidation'], $modelOptions ['attributes'] )) {
					if ($transacted)
						$transaction->rollback ();
					return false;
				}
				
				// If there is related data, use saveRelated.
				if (! empty ( $modelOptions ['relatedData'] )) {
					if (! $model->saveRelated ( $modelOptions ['relatedData'], $modelOptions ['runValidation'], $modelOptions ['batch'] )) {
						if ($transacted)
							$transaction->rollback ();
						return false;
					}
				}
				
				// Add the model to the saved models array.
				// Only the last model of each class is recorded.
				if ($options ['detectRelations'])
					$savedModels [get_class ( $model )] = $model;
			}
			
			// If transacted, commit the transaction.
			if ($transacted)
				$transaction->commit ();
		} catch ( Exception $ex ) {
			// If there is an exception, roll back the transaction...
			if ($transacted)
				$transaction->rollback ();
				// ... and rethrow the exception.
			throw $ex;
		}
		return true;
	}
	public static function findRelation($modelClass, $column) {
		if (is_string ( $modelClass ))
			$staticModelClass = self::model ( $modelClass );
		else
			$staticModelClass = self::model ( get_class ( $modelClass ) );
		
		if (is_string ( $column ))
			$column = $staticModelClass->getTableSchema ()->getColumn ( $column );
		
		if (! $column->isForeignKey)
			return null;
		
		$relations = $staticModelClass->relations ();
		// Find the relation for this attribute.
		foreach ( $relations as $relationName => $relation ) {
			// For attributes on this model, relation must be BELONGS_TO.
			if (($relation [0] === ActiveRecord::BELONGS_TO) && ($relation [2] === $column->name)) {
				return array (
						$relationName, // the relation name
						$relation [0], // the relation type
						$relation [2], // the foreign key
						$relation [1] 
				); // the related active record class name
			}
		}
		// None found.
		return null;
	}
	public function getUrl($action = 'view', $controller = null) {
		if ($controller == null)
			$controllerID = lcfirst ( get_class ( $this ) );
		else if (is_object ( $controller )) {
			$controllerID = $controller->getId ();
		} else {
			$pos = strpos ( $controller, 'Controller' );
			if ($pos)
				$controllerID = substr ( $controller, 0, pos );
		}
		$params = array (
				'id' => $this->id 
		);
		// add the title parameter to the URL
		if ($this->hasAttribute ( 'title' ))
			$params ['title'] = str_replace ( ' ', '-', $this->title );
		if ($this->hasAttribute ( 'name' ))
			$params ['name'] = str_replace ( ' ', '-', $this->name );
		return Yii::app ()->createAbsoluteUrl ( '/' . $controllerID . '/' . $action, $params );
	}
	public function linkify($title = null, $controller = null, $action = 'view') {
		if ($title == null)
			$title = ( string ) $this;
		return CHtml::link ( $title, $this->getUrl ( $action, $controller ) );
	}
	public function render($title = null, $controller = null, $action = 'view') {
		if ($title == null)
			$title = ( string ) $this;
		$image_link = CHtml::image ( $this->getUrl ( 'thumbnail' ), $title, array (
				'width' => '120',
				'height' => '90' 
		) );
		echo CHtml::link ( $image_link, $this->getUrl ( $action, $controller ) );
	}
	public static function getModels() {
		$models = array ();
		$files = scandir ( Yii::getPathOfAlias ( 'application.models' ) );
		foreach ( $files as $file ) {
			if ($file [0] !== '.' && CFileHelper::getExtension ( $file ) === 'php') {
				$fileClassName = substr ( $file, 0, strpos ( $file, '.' ) );
				if (class_exists ( $fileClassName ) && is_subclass_of ( $fileClassName, 'ActiveRecord' )) {
					$fileClass = new ReflectionClass ( $fileClassName );
					if (! $fileClass->isAbstract ())
						$models [] = $fileClassName;
				}
			}
		}
		return $models;
	}
	public function getDataProvider($criteria = null, $pagination = null) {
		if ((is_array ( $criteria )) || ($criteria instanceof CDbCriteria))
			$this->cache ( 1000 )->getDbCriteria ()->mergeWith ( $criteria );
		$pagination = CMap::mergeArray ( array (
				'pageSize' => 20 
		), ( array ) $pagination );
		return new CActiveDataProvider ( get_class ( $this ), array (
				'criteria' => $this->getDbCriteria (),
				'pagination' => $pagination 
		) );
	}
	public function getRelatedDataProvider($relation, $config = array()) {
		$relations = $this->relations ();
		if (! isset ( $relations [$relation] )) {
			throw new CDbException ( Yii::t ( 'yii', '{class} does not have relation "{name}".', array (
					'{class}' => get_class ( $this ),
					'{name}' => $relation 
			) ) );
		}
		
		$c = array ();
		
		$criteria = isset ( $config ["criteria"] ) ? $config ["criteria"] : null;
		
		list ( $type, $relatedModel, $foreignKey ) = $relations [$relation];
		
		if (isset ( $relations [$relation] ["through"] )) {
			$through = $relations [$relation] ["through"];
			unset ( $relations [$relation] ["through"] );
			
			if ($criteria === null || is_array ( $criteria )) {
				if (is_array ( $criteria )) {
					$conf = $criteria;
				} else {
					$conf = array_slice ( $relations [$relation], 3, null, true );
				}
				$conf ["class"] = "CDbCriteria";
				$criteria = Yii::createComponent ( $conf );
			}
			
			list ( $throughType, $throughModel, $throughForeignKey ) = $relations [$through];
			$m = CActiveRecord::model ( $throughModel );
			$t = $m->tableName ();
			
			$pk = $m->getTableSchema ()->primaryKey;
			if (is_array ( $pk )) {
				$pk = $pk [0];
				$criteria->join = "JOIN {$t} AS {$through} ON {$through}.{$pk} = t.{$foreignKey} ";
			} else {
				$criteria->join = "JOIN {$t} AS {$through} ON {$through}.{$foreignKey} = t.{$m->getTableSchema()->primaryKey} ";
			}
			$criteria->join .= "JOIN {$this->tableName()} ON {$this->tableName()}.{$this->getTableSchema()->primaryKey} = {$through}.{$throughForeignKey}";
			
			$criteria->compare ( "{$through}.{$throughForeignKey}", $this->{$this->getTableSchema ()->primaryKey} );
		} else {
			if ($criteria === null || is_array ( $criteria )) {
				if (is_array ( $criteria )) {
					$conf = $criteria;
				} else {
					$conf = array_slice ( $relations [$relation], 3, null, true );
				}
				$conf ["class"] = "CDbCriteria";
				$criteria = Yii::createComponent ( $conf );
			}
			$criteria->compare ( "t." . $foreignKey, $this->{$this->getTableSchema ()->primaryKey} );
		}
		
		$config ['criteria'] = $criteria;
		
		return new CActiveDataProvider ( $relatedModel, $config );
	}
	public function scopes() {
		return array (
				'my' => array (
						'condition' => 'user_id =' . Yii::app ()->user->id 
				),
				'latest' => array (
						'order' => 'create_time DESC ' 
				),
				'active' => array (
						'condition' => 'state_id = 1' 
				) ,
				// scope related with user

				//'active' => array('condition' => 'state_id=' . User::STATUS_ACTIVE),
				//'inactive' => array('condition' => 'state_id=' . User::STATUS_INACTIVE),
				//'banned' => array('condition' => 'state_id=' . User::STATUS_BANNED),

				'basicUsers' => array('condition' => 'role_id =' . User::ROLE_USER),
				'busUsers' => array('condition' => 'role_id =' . User::ROLE_BUSINESS_USER),
				'newUsers' => array('condition' => 'create_time >= "' . date('Y-m-d',strtotime('-10 days',time())).' "'),
		);
	}
	public function defaultScope() {
		if ($this->hasAttribute ( 'id' ))
			return array (
					'order' => 'id DESC ' 
			);
		else if ($this->hasAttribute ( 'create_time' ))
			return array (
					'order' => 'create_time DESC ' 
			);
		
		return array ();
	}
	public function isAllowed()
	{
		$class = get_class($this);
		if($class == 'User') {
			if ( $this->hasAttribute('id'))	return ( $this->id == Yii::app()->user->id);
			
		}
		if (Yii::app()->user->isAdmin ) return true;
		if ( $this->hasAttribute('create_user_id'))	return ( $this->create_user_id == Yii::app()->user->id);
		return false;
	}
	/* public function isAllowed() {
		if (Yii::app ()->user->isAdmin)
			return true;
		if ($this->hasAttribute ( 'create_user_id' ) && ($this->create_user_id == Yii::app ()->user->id))
			return true;
		if ($this->hasAttribute ( 'user_id' ) && ($this->user_id == Yii::app ()->user->id))
			return true;
		if ($this->hasAttribute ( 'manager_id' ) && ($this->manager_id == Yii::app ()->user->id))
			return true;
		$this->addError ( 'id', "isAllowed failed" );
		return false;
	} */
	public static function deleteTemp($type_id) {
		$criteria = new CDbCriteria;
		$criteria->addCondition('create_user_id ='.Yii::app()->user->id);
		$criteria->addCondition('type_id ='.$type_id);
		
		$tempfiles = TempFile::model()->findAll($criteria);
		
		if($tempfiles)
		{
			foreach($tempfiles as $temp)
			{
				$file = Yii::app()->basePath .'/..' . UPLOAD_PATH_USER.$temp->image_path;
				if(file_exists($file))
				{
					unlink($file);
				}
				$temp->delete();
			}
		}
	}
	public function isDeleteAllow() {
		if (Yii::app ()->user->isExec)
			return true;
		
		return false;
	}
	public static function string2array($tags) {
		return preg_split ( '/\s*,\s*/', trim ( $tags ), - 1, PREG_SPLIT_NO_EMPTY );
	}
	public static function array2string($tags) {
		return implode ( ', ', $tags );
	}
	public function saveUploadedFile($model, $attribute, $directory = null) {
		$uploaded_file = CUploadedFile::getInstance ( $model, $attribute );
		if (isset ( $uploaded_file )) {
			$directory = $directory ? $directory . '/' : '';
			$path = UPLOAD_PATH . $directory;
			
			if (! file_exists ( $path ))
				@mkdirs ( $path, 0777, true );
			
			$filename = $path . get_class ( $model ) . '-' . time () . '-' . $attribute . '.' . $uploaded_file->getExtensionName ();
			if (file_exists ( $filename ))
				unlink ( $filename );
			
			$uploaded_file->saveAs ( $filename );
			$model->$attribute = basename ( $filename );
			return true;
		}
	}
	
	public function captiliseWord($params, $attribute) {
		if (is_string ( $params )) {
			$this->$params = strtolower ( $this->$params );
			$this->$params = ucfirst ( $this->$params );
		}
	}
	public function sendMail($to, $from, $subject, $view) {
		Email::sendEmail ( $to, $from, $subject, $view, $this );
		/*
		 * Yii::import ( 'ext-prod.yii-mail.YiiMailMessage' );
		 * $message = new YiiMailMessage ();
		 * $message->view = $view;
		 * $message->setSubject ( '[ProMIS.ONE]' . $subject );
		 * $message->setBody ( array (
		 * 'model' => $this
		 * ), 'text/html' );
		 * $message->addTo ( $to );
		 * $message->addFrom ( $from );
		 * return self::sendEmailLoadShared ( $message );
		 */
	}
	/*
	 * public static function sendEmailLoadShared($message, $use_id = 1) {
	 * if (YII_ENV == 'dev') {
	 * $message->body . PHP_EOL . '<br/>';
	 * }
	 * try {
	 *
	 * $result = Yii::app ()->mail->send ( $message );
	 * } catch ( Exception $e ) {
	 * echo $e->getMessage ();
	 *
	 * return false;
	 * }
	 * return true;
	 * }
	 */
	
	/**
	 * Converts a string to a valid UNIX filename.
	 *
	 * @param $string The
	 *        	filename to be converted
	 * @return $string The filename converted
	 */
	public static function convertToFilename($string) {
		// Replace spaces with underscores and makes the string lowercase
		$string = str_replace ( " ", "_", $string );
		
		$string = str_replace ( "..", ".", $string );
		$string = strtolower ( $string );
		
		// Match any character that is not in our whitelist
		preg_match_all ( "/[^0-9^a-z^_^.]/", $string, $matches );
		
		// Loop through the matches with foreach
		foreach ( $matches [0] as $value ) {
			$string = str_replace ( $value, "", $string );
		}
		return $string;
	}
}