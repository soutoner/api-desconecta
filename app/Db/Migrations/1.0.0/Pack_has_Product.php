<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class PackHasProductMigration_100
 */
class PackHasProductMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('Pack_has_Product', array(
                'columns' => array(
                    new Column(
                        'pack_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'first' => true
                        )
                    ),
                    new Column(
                        'product_id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'unsigned' => true,
                            'notNull' => true,
                            'size' => 10,
                            'after' => 'pack_id'
                        )
                    ),
                    new Column(
                        'created_at',
                        array(
                            'type' => Column::TYPE_TIMESTAMP,
                            'default' => "CURRENT_TIMESTAMP",
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'product_id'
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
                    new Index('PRIMARY', array('pack_id', 'product_id'), null),
                    new Index('pack_id-product_id-UNIQUE', array('pack_id', 'product_id'), null),
                    new Index('fk_Pack_has_Product_Product1_idx', array('product_id'), null),
                    new Index('fk_Pack_has_Product_Pack1_idx', array('pack_id'), null)
                ),
                'references' => array(
                    new Reference(
                        'fk_Pack_has_Product_Pack1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Pack',
                            'columns' => array('pack_id'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'fk_Pack_has_Product_Product1',
                        array(
                            'referencedSchema' => 'desconecta_dev',
                            'referencedTable' => 'Product',
                            'columns' => array('product_id'),
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
