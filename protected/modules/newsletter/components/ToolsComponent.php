<?php
class ToolsComponent extends CApplicationComponent {
 
	public function getdetails($arrParams) {
		$emaildetails = array();
		$event = EventTemplate::model()->find('event=:eventtype',array(':eventtype' => $arrParams['eventtype']));
		if(!empty($event)) {
		$eventid = $event['id'];

          $mapping = EventNewsletterTemplate::model()->find('eventid=:event_id',array(':event_id' => $eventid));
          if(!empty($mapping)) {
              $newsletterid = $mapping['newsletterid'];

              $template = NewsletterTemplate::model()->find('id=:news_id And status=:Status',array(':news_id' => $newsletterid , ':Status' => 'Y'));

              if(!empty($template)) {
                  $subject = $template['title'];
                  $view = $template['message'];

                  foreach($arrParams['replacement'] as $strKey => $strValue) {
                    $view = str_replace($strKey, $strValue, $view);
                  }
              }
              else {
                    return $emaildetails;
              }
              $emaildetails = array('subject' => $subject,
                                    'view' => $view);
              return $emaildetails;
          }
          else {
            return $emaildetails;
          }
        }
        else {
          return $emaildetails;
        }
	}

}

?>