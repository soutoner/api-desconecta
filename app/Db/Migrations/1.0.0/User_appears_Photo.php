<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UserAppearsPhotoMigration_100
 */
class UserAppearsPhotoMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable(
            'User_appears_Photo', array(
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
                'photo_id',
                array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'user_id'
                        )
            ),
            new Column(
                'created_at',
                array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'photo_id'
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
            new Index('PRIMARY', array('user_id', 'photo_id'), null),
            new Index('user_id-photo_id-UNIQUE', array('user_id', 'photo_id'), null),
            new Index('fk_User_has_Photo_Photo1_idx', array('photo_id'), null),
            new Index('fk_User_has_Photo_User1_idx', array('user_id'), null)
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
