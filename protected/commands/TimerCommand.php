<?php
/**
 * Company: ToXSL Technologies Pvt. Ltd. < www.toxsl.com >
 * Author : Shiv Charan Panjeta < shiv@toxsl.com >
 */


class TimerCommand extends CConsoleCommand {
	
	public $forever = false;
	/**
	 * Executes the command.
	 * 
	 * @param
	 *        	array command line parameters for this command.
	 */
	public static function log($string) {
		echo $string;
		Yii::log ( $string, CLogger::LEVEL_WARNING, 'Timer' );
	}
	public function run($args) {
		do {
			$t1 = time();
			
			self::log( RssFeed::timerSync() );
			
			$t = time()- $t1;
			
			self::log ("Time taken in Timer Execution ".$t);
			
			if ( $this->forever ) sleep(1);
		}
		while ( $this->forever );
	}
	/**
	 * Provides the command description.
	 * This method may be overridden to return the actual command description.
	 * 
	 * @return string the command description. Defaults to 'Usage: php entry-script.php command-name'.
	 */
	public function getHelp() {
		return 'Usage: how to use this command';
	}
	
	/**
	 * Dumps a variable or the object itself in terms of a string.
	 *
	 * @param
	 *        	mixed variable to be dumped
	 */
	protected function dump($var = 'dump-the-object', $highlight = true) {
		if ($var === 'dump-the-object') {
			return CVarDumper::dumpAsString ( $this, $depth = 15, $highlight );
		} else {
			return CVarDumper::dumpAsString ( $var, $depth = 15, $highlight );
		}
	}
}
