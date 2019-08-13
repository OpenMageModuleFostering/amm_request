<?php

$installer = $this;

$installer->startSetup();

//echo $installer->getTable('amm_request'); die();

$table = $installer->getConnection()->newTable($installer->getTable('amm_request'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true,
        ), 'ID')
    ->addColumn('id_customer', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
        ), 'ID Customer')
    ->addColumn('theme', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => false,
        ), 'Theme')
    ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
        ), 'Message')
    ->addColumn('answer', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
        ), 'Answer')
    ->addColumn('dcreate', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        ), 'Dcreate')
    ->addColumn('danswer', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        ), 'Danswer')
    ->addColumn('flag_new_message', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
        ), 'Flag message')
    ->addColumn('flag_new_answer', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => true,
        ), 'Flag answer')
    ->setComment('amm_request table');
$installer->getConnection()->createTable($table);

$installer->endSetup();