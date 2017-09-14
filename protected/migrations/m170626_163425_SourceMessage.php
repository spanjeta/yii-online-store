<?php
class m170626_163425_SourceMessage extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TABLE SourceMessage
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    category VARCHAR(32),
    message TEXT
);");
		
		
	}
	
	
	public function safeDown()
	{
		
		echo "m170626_163425_SourceMessage migrating down by doing nothing....\n";
		
	}
	
}