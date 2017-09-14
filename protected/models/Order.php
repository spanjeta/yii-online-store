<?php

/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */
 
/**
 * @property integer $id
 * @property integer $create_user_id
 * @property integer $ship_address_id
 * @property integer $bil_address_id
 * @property string $amount
 * @property string $order_email
 * @property string $phone_no
 * @property integer $paid
 * @property integer $payment_id
 * @property integer $type_id
 * @property integer $state_id
 * @property string $ship_time
 * @property string $create_time
 * @property string $update_time
 */
Yii::import('application.models._base.BaseOrder');
class Order extends BaseOrder
{
	public $sum;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
	
	public static function getCurrentState($order_id) {
		$criteria = new CDbCriteria ();
		$criteria->compare ( 'id', $order_id );
		//$criteria->compare ( 'create_user_id', Yii::app()->user->id );
		$model = self::model ()->find ( $criteria );
		if(!empty($model))
			$state = $model->state_id;
		else 
			$state = 'Not Start';
		return $state;
	}
	public static function getMonthlyPrice($month, $year) {
		$total = 0;
		$criteria = new CDbCriteria ();
		$criteria->select = '*, SUM(`amount`) as sum';
		$criteria->compare ( 'MONTH(`create_time`)', $month );
		$criteria->compare ( 'YEAR(`create_time`)', $year );
		$criteria->group = 'amount';
		
		$models = self::model ()->findAll ( $criteria );
		if ($models != null) {
			foreach ( $models as $model ) {
				$total += $model->sum;
			}
		}
		
		return round ( $total );
	}
	public function getTotal(){
		$total = 0;
		$models = OrderItem::model()->findAllByAttributes(array(
				'order_id' => $this->id
		));
		foreach ($models as $model){
			$total += $model->amount;
		}
		return $total;
	}
}