<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class EventHasPackMigration_100
 */
class EventHasPackMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Event_has_Pack', array(
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
                        'pack_id',
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
                            'after' => 'pack_id'
                        )
                    ),
                    new Column(
                        'updated_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'created_at'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('event_id', 'pack_id'), null),
                    new Index('fk_Event_has_Pack_Pack1_idx', array('pack_id'), null),
                    new Index('fk_Event_has_Pack_Event1_idx', array('event_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_Event_has_Pack_Event1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Event',
                            'columns' => array('event_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Event_has_Pack_Pack1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Pack',
                            'columns' => array('pack_id'),
                            'referencedColumns' => array('id')
                        )
                    )
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
