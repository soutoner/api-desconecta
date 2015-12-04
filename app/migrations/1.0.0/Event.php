<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class EventMigration_100
 */
class EventMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Event', array(
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
                        'desc',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255,
                            'after' => 'name'
                        )
                    ),
                    new Column(
                        'photo_cover',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'desc'
                        )
                    ),
                    new Column(
                        'start_date',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'photo_cover'
                        )
                    ),
                    new Column(
                        'end_date',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'start_date'
                        )
                    ),
                    new Column(
                        'flyer',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'end_date'
                        )
                    ),
                    new Column(
                        'local_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'flyer'
                        )
                    ),
                    new Column(
                        'guestList_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'size' => 10,
                            'after' => 'local_id'
                        )
                    ),
                    new Column(
                        'scheduling_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'size' => 10,
                            'after' => 'guestList_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('id'), null),
                    new Index('id_UNIQUE', array('id'), null),
                    new Index('fk_Event_Local1_idx', array('local_id'), null),
                    new Index('fk_Event_GuestList1_idx', array('guestList_id'), null),
                    new Index('fk_Event_Scheduling1_idx', array('scheduling_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_Event_GuestList1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'GuestList',
                            'columns' => array('guestList_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Event_Local1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Local',
                            'columns' => array('local_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Event_Scheduling1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Scheduling',
                            'columns' => array('scheduling_id'),
                            'referencedColumns' => array('id')
                        )
                    )
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '1',
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
