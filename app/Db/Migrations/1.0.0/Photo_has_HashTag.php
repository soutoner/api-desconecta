<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PhotoHasHashtagMigration_100
 */
class PhotoHasHashtagMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Photo_has_HashTag', array(
                'columns' => array(
                    new Column(
                        'photo_id',
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
                            'after' => 'photo_id'
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
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'created_at'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('photo_id', 'hashTag_id'), null),
                    new Index('photo_id-hashTag_id-UNIQUE', array('photo_id', 'hashTag_id'), null),
                    new Index('fk_Photo_has_HashTag_HashTag1_idx', array('hashTag_id'), null),
                    new Index('fk_Photo_has_HashTag_Photo1_idx', array('photo_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_Photo_has_HashTag_HashTag1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'HashTag',
                            'columns' => array('hashTag_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Photo_has_HashTag_Photo1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Photo',
                            'columns' => array('photo_id'),
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
