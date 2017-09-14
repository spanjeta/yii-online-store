 <?php
class m170628_201055_product_image_var_id extends CDbMigration
{
    public function safeUp()
    {
                                    $this->execute("ALTER TABLE `tbl_product_image` ADD `var_id` INT NOT NULL AFTER `product_id`;");
                

    }


    public function safeDown()
    {

        echo "m170628_201055_product_image_var_id migrating down by doing nothing....\n";

    }

}