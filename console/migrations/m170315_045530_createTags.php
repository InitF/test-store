<?php

use yii\db\Migration;

class m170315_045530_createTags extends Migration
{
    public function up()
    {
        $this->createTable('tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)
        ]);
    }

    public function down()
    {
        $this->dropTable('tags');
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
