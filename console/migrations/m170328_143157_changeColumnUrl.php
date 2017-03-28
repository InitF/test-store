<?php

use yii\db\Migration;

class m170328_143157_changeColumnUrl extends Migration
{
    public function up()
    {
        $this->renameColumn('products', 'image_url', 'image_name');
    }

    public function down()
    {
        $this->renameColumn('products', 'image_name', 'image_url');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
