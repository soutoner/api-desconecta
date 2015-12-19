<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PhotoMigration_100
 */
class PhotoMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable(
            'Photo', array(
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
                'uri',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'id'
                        )
            ),
            new Column(
                'desc',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'uri'
                        )
            ),
            new Column(
                'event_id',
                array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'desc'
                        )
            ),
            new Column(
                'created_at',
                array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'event_id'
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
            new Index('fk_Photo_Event1_idx', array('event_id'), null)
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
