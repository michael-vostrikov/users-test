<?php

use yii\db\Schema;

class m180126_134106_create_tables extends yii\db\Migration
{
    public function up()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'surname' => $this->string(100)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'birth_date' => $this->string(100)->notNull(),
            'gender' => $this->getDb()->getSchema()->createColumnSchemaBuilder('TINYINT(1)')->notNull(),
        ]);


        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'profile_id' => $this->integer()->notNull(),
            'name' => $this->string(100)->notNull(),
            'address' => $this->string(100)->notNull(),
        ]);

        $this->createIndex('address-profile', '{{%address}}', 'profile_id', false);


        $this->addForeignKey('address-profile', '{{%address}}', 'profile_id', '{{%profile}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('address-profile', '{{%address}}');

        $this->dropTable('{{%address}}');
        $this->dropTable('{{%profile}}');
    }
}
