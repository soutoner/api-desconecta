<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UserAttendsEventMigration_100
 */
class UserAttendsEventMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('User_attends_Event', array(
                'columns' => array(
                    new Column(
                        'user_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'event_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'user_id'
                        )
                    ),
                    new Column(
                        'geo_attended',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'default' => "0",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'event_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('user_id', 'event_id'), null),
                    new Index('fk_User_has_Event_Event1_idx', array('event_id'), null),
                    new Index('fk_User_has_Event_User1_idx', array('user_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_User_has_Event_Event1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Event',
                            'columns' => array('event_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_User_has_Event_User1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'User',
                            'columns' => array('user_id'),
                            'referencedColumns' => array('id')
                        )
                    )
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
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