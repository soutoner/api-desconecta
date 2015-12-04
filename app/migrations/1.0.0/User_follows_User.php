<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UserFollowsUserMigration_100
 */
class UserFollowsUserMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('User_follows_User', array(
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
                        'follower_id',
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
                    new Index('PRIMARY', array('user_id', 'follower_id'), null),
                    new Index('user_id-follower_id-UNIQUE', array('user_id', 'follower_id'), null),
                    new Index('fk_User_has_Follower_User_idx', array('follower_id'), null),
                    new Index('fk_User_has_User_User_idx', array('user_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_User_has_Follower_User',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'User',
                            'columns' => array('follower_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_User_has_User_User',
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
