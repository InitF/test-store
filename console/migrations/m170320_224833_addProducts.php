<?php

use yii\db\Migration;

class m170320_224833_addProducts extends Migration
{
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(45)->notNull(),
            'image_url' => $this->string(100)->defaultValue(NULL),
            'tree_id' => $this->bigInteger(),
            'is_hidden' => $this->boolean()->notNull()->defaultValue(false),
        ]);

        $this->createTable('product_tags', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull()
        ]);

        $this->createIndex('idx-products-tree_id', 'products', 'tree_id');
        $this->addForeignKey(
            'fk-products-tree_id',
            'products',
            'tree_id',
            'tree',
            'id',
            'NO ACTION',
            'NO ACTION'
        );

        $this->createIndex('idx-product_tags-product_id', 'product_tags', 'product_id');
        $this->createIndex('idx-product_tags-tag_id', 'product_tags', 'tag_id');
        $this->addForeignKey(
            'fk-product_tags-product_id',
            'product_tags',
            'product_id',
            'products',
            'id',
            'CASCADE',
            'NO ACTION'
        );
        $this->addForeignKey(
            'fk-product_tags-tag_id',
            'product_tags',
            'tag_id',
            'tags',
            'id',
            'CASCADE',
            'NO ACTION'
        );
    }

    public function down()
    {
        $this->dropForeignKey('fk-products-tree_id', 'products');
        $this->dropIndex('idx-products-tree_id', 'products');

        $this->dropForeignKey('fk-product_tags-product_id', 'product_tags');
        $this->dropForeignKey('fk-product_tags-tag_id', 'product_tags');
        $this->dropIndex('idx-product_tags-product_id', 'product_tags');
        $this->dropIndex('idx-product_tags-tag_id', 'product_tags');

        $this->dropTable('products');
        $this->dropTable('products_tags');
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
