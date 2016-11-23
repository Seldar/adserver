<?php
/**
 * Created by PhpStorm.
 * User: Ulukut
 * Date: 18.11.2016
 * Time: 15:42
 *
 * @author Volkan Ulukut <arthan@gmail.com>
 */

namespace Adserver\Tests;

use PHPUnit_Extensions_Database_DataSet_AbstractDataSet;
use PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData;
use PHPUnit_Extensions_Database_DataSet_DefaultTable;
use PHPUnit_Extensions_Database_DataSet_DefaultTableIterator;
use InvalidArgumentException;


class DbUnitArrayDataSet extends PHPUnit_Extensions_Database_DataSet_AbstractDataSet
{
    /**
     * @var array
     */
    protected $tables = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data AS $tableName => $rows) {
            $columns = [];
            if (isset($rows[0])) {
                $columns = array_keys($rows[0]);
            }

            $metaData = new PHPUnit_Extensions_Database_DataSet_DefaultTableMetaData($tableName, $columns);
            $table = new PHPUnit_Extensions_Database_DataSet_DefaultTable($metaData);

            foreach ($rows AS $row) {
                $table->addRow($row);
            }
            $this->tables[$tableName] = $table;
        }
    }

    protected function createIterator($reverse = false)
    {
        return new PHPUnit_Extensions_Database_DataSet_DefaultTableIterator($this->tables, $reverse);
    }
    
}