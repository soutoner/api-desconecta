<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProductMigration_100
 */
class ProductMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Product', array(
                'columns' => array(
                    new Column(
                        'id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'autoIncrement' => true,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'name',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'icon',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'name'
                        )
                    ),
                    new Column(
                        'created_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'icon'
                        )
                    ),
                    new Column(
                        'updated_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'created_at'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('id'), null),
                    new Index('id_UNIQUE', array('id'), null),
                    new Index('name_UNIQUE', array('name'), null)
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'utf8_unicode_ci'
                ),
            )
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        self::$_connection->insertAsDict('Product', [
            'name' => 'consumicion',
            'icon' => 'images/consumicion',
        ]);
        self::$_connection->insertAsDict('Product',[
            'name' => 'entrada',
            'icon' => 'images/entrada',
        ]);
        self::$_connection->insertAsDict('Product',[
            'name' => 'cerveza',
            'icon' => 'images/cerveza',
        ]);
        self::$_connection->insertAsDict('Product',[
            'name' => 'chupito',
            'icon' => 'images/chupito',
        ]);
        self::$_connection->insertAsDict('Product',[
            'name' => 'tinto',
            'icon' => 'images/tinto',
        ]);
        self::$_connection->insertAsDict('Product',[
            'name' => 'mojito',
            'icon' => 'images/mojito',
        ]);
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
