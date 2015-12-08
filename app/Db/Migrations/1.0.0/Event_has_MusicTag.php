<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class EventHasMusictagMigration_100
 */
class EventHasMusictagMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Event_has_MusicTag', array(
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
                        'musicTag_id',
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
                            'after' => 'musicTag_id'
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
                    new Index('PRIMARY', array('event_id', 'musicTag_id'), null),
                    new Index('event_id-musicTag_id-UNIQUE', array('event_id', 'musicTag_id'), null),
                    new Index('fk_Event_has_MusicTag_MusicTag1_idx', array('musicTag_id'), null),
                    new Index('fk_Event_has_MusicTag_Event1_idx', array('event_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_Event_has_MusicTag_Event1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Event',
                            'columns' => array('event_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Event_has_MusicTag_MusicTag1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'MusicTag',
                            'columns' => array('musicTag_id'),
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
