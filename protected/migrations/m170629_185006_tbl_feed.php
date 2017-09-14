 <?php
class m170629_185006_tbl_feed extends CDbMigration
{
    public function safeUp()
    {
  $this->execute("DROP TABLE IF EXISTS `tbl_feed`;
CREATE TABLE IF NOT EXISTS `tbl_feed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci ,
  `state_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `model_type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_feed_create_user` (`create_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
                

    }


    public function safeDown()
    {

        echo "m170629_185006_tbl_feed migrating down by doing nothing....\n";

    }

}