<?php
class CronController extends Controller
{
	

		public function actionIndex()
		{
			echo 'There is nothing for you to see here!!';
		}
 
	public static function actionMailing()
	{
		$model=Mailing::model()->find();
		if(count($model)>0){

			/* if($model->type ==55757) {
				$modelE = Event::model()->findByPk($model->content);
			} */

			// if queue is done then set empty array
			if($model->queue =='done') { 
				$queue = array(); 
			}else{ 
				$queue = explode(', ',$model->queue); 
			}
//			var_dump($queue);
			if(isset($model->sent)) { $sent = explode(', ',$model->sent); }else{ $sent = array(); }
			
			if(count($queue)>0) {
				if(count($queue)>=1) { 
					$c=1; 
				}else{ 
					$c=count($queue); 
				} //set the counter to left email counts
				for($i=0; $i<$c; $i++){
					$toemail = $queue[$i];
				
					if($model->type_id == Mailing::TYPE_NEWSLETTER) {
						
						$modelmail = Mailing::model()->findByAttributes(
								array(
									'state_id' => Mailing::STATE_QUEUE 		
								));
						
						$to = $toemail;
						$from = 'outlet@outlet.co.mz';
						$subject = $modelmail->subject;
						$view = "newletter";
						$mail_data = array (
								'model' => $modelmail
						);
						User::sendEmails ( $to, $from, $subject, $view, $mail_data );
						
						
					//	$modelB = EventBooking::model()->with(array('user'=>array('condition'=>"email='$to'")))->find(array('condition'=>"event_id=$model->content"));
					//	$message->view = 'newletter';
					//	$message->setBody(array('model'=>$modelE,'modelB'=>$modelB), 'text/html');
					}/* else{
						$message->view = 'mailing';
						$message->setBody(array('content'=>$model->content), 'text/html');
					} */
				//	$message->setSubject($model->subject);
				//	$message->addTo($to);
					/* if($model->type ==55755 || $model->type ==55757) {
						$message->from = array('events@thegoldennetwork.co.uk'=>'The Golden Network');
					}else{
						$message->from = array('info@thegoldennetwork.co.uk'=>'The Golden Network');
					}
					Yii::app()->mail->send($message); */
					$sent[] = $toemail;
					unset($queue[$i]);
				}
				$model->state_id = Mailing::STATE_INPROGRESS;
			}else{
				$model->state_id = Mailing::STATE_COMPLETED;
				$model->finishedOn = date('Y-m-d H:i:s');				
			}
			
			
			$requeue = array_values($queue);
			if(count($requeue)>0) { 
				$model->queue = implode(', ',$requeue); 
			}else{ 
				$model->queue = 'done'; 
			}
			$model->sent = implode(', ',$sent);
			if($model->save()) {
				echo 'saved';
			}
			// var_dump($requeue);
		}else{
			echo 'No emails to send!';	
		}
	}
	

  

}
