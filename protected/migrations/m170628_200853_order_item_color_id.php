 <?php
class m170628_200853_order_item_color_id extends CDbMigration
{
    public function safeUp()
    {
       $this->execute("ALTER TABLE `tbl_order_item` ADD `color_id` INT NOT NULL AFTER `quantity`, ADD `size_id` INT NOT NULL AFTER `color_id`;");
                

    }


    public function safeDown()
    {

        echo "m170628_200853_order_item_color_id migrating down by doing nothing....\n";

    }

}