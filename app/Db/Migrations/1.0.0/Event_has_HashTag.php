<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Mvc\Model\Migration;

/**
 * Class EventHasHashtagMigration_100
 */
class EventHasHashtagMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable(
            'Event_has_HashTag', array(
            'columns' => array(
            new Column(
                'event_id',
                array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'first' => true
                        )
            ),
            new Column(
                'hashTag_id',
                array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'event_id'
                        )
            ),
            new Column(
                'created_at',
                array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'hashTag_id'
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
            new Index('PRIMARY', array('event_id', 'hashTag_id'), null),
            new Index('event_id-hashTag_id-UNIQUE', array('event_id', 'hashTag_id'), null),
            new Index('fk_Event_has_HashTag_HashTag1_idx', array('hashTag_id'), null),
            new Index('fk_Event_has_HashTag_Event1_idx', array('event_id'), null)
            ),
            'options' => array(
            'TABLE_TYPE' => 'BASE TABLE',
            'AUTO_INCREMENT' => '',
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
