<?php 

namespace Custom\Weather\Setup;

use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface{
    public function install(SchemaSetupInterface $setup,ModuleContextInterface $context){
        $setup->startSetup();
        $conn = $setup->getConnection();
        $tableName = $setup->getTable('weather_updates');
        if($conn->isTableExists($tableName) != true){
            $table = $conn->newTable($tableName)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity'=>true,'unsigned'=>true,'nullable'=>false,'primary'=>true]
                    )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable'=>false,'default'=>'']
                    )
                ->addColumn(
                    'icon',
                    Table::TYPE_TEXT,
                    255,
                    ['nullbale'=>false,'default'=>'']
                    )
                ->addColumn(
                    'temperature',
                    Table::TYPE_TEXT,
                    10,
                    ['nullbale'=>false,'default'=>'']
                    )
                ->addColumn(
                    'pressure',
                    Table::TYPE_TEXT,
                    10,
                    ['nullbale'=>false,'default'=>'']
                    )
                ->addColumn(
                    'timestamp',
                    Table::TYPE_TIMESTAMP,
                    10,
                    ['nullbale'=>false,'default'=>'']
                    )
                ->setOption('charset','utf8');
            $conn->createTable($table);
        }
        $setup->endSetup();
    }
}
