<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UserBelongsGuestlistMigration_100
 */
class UserBelongsGuestlistMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('User_belongs_GuestList', array(
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
                        'guestList_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'user_id'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('user_id', 'guestList_id'), null),
                    new Index('fk_User_has_GuestList_GuestList1_idx', array('guestList_id'), null),
                    new Index('fk_User_has_GuestList_User1_idx', array('user_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_User_has_GuestList_GuestList1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'GuestList',
                            'columns' => array('guestList_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_User_has_GuestList_User1',
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