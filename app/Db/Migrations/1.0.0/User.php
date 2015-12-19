<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UserMigration_100
 */
class UserMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable(
            'User', array(
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
                'surname',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'name'
                        )
            ),
            new Column(
                'email',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'surname'
                        )
            ),
            new Column(
                'profile_picture',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'default' => "Default_picture_url",
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'email'
                        )
            ),
            new Column(
                'date_birth',
                array(
                            'type' => Column::TYPE_DATE,
                            'size' => 1,
                            'after' => 'profile_picture'
                        )
            ),
            new Column(
                'gender',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'date_birth'
                        )
            ),
            new Column(
                'location',
                array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'gender'
                        )
            ),
            new Column(
                'rrpp_id',
                array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'size' => 10,
                            'after' => 'from'
                        )
            ),
            new Column(
                'created_at',
                array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'rrpp_id'
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
            new Index('email_UNIQUE', array('email'), null),
            new Index('fk_User_RRPP1_idx', array('rrpp_id'), null)
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
