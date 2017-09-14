<?php
class m170626_163318_Message extends CDbMigration
{
	public function safeUp()
	{
		$this->execute("CREATE TABLE Message
(
    id INTEGER,
    language VARCHAR(16),
    translation TEXT,
    PRIMARY KEY (id, language),
    CONSTRAINT FK_Message_SourceMessage FOREIGN KEY (id)
         REFERENCES SourceMessage (id) ON DELETE CASCADE ON UPDATE RESTRICT
);");
		
		
	}
	
	
	public function safeDown()
	{
		
		echo "m170626_163318_Message migrating down by doing nothing....\n";
		
	}
	
}