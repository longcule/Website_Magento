<?php
/**
 * Magetop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magetop.com license that is
 * available through the world-wide-web at this URL:
 * https://www.magetop.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category  Magetop
 * @package   Magetop_SocialLoginPro
 * @copyright Copyright (c) Magetop (https://www.magetop.com/)
 * @license   https://www.magetop.com/LICENSE.txt
 */

namespace Magetop\SocialLogin\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

/**
 * Class UpgradeSchema
 *
 * @package Magetop\SocialLogin\Setup
 */
class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $connection = $installer->getConnection();
        $tableName = $setup->getTable('magetop_social_customer');
        if (version_compare($context->getVersion(), '1.2.0', '<')) {
            if ($connection->tableColumnExists($tableName, 'social_created_at') === false) {
                $connection->addColumn(
                    $tableName,
                    'social_created_at',
                    [
                        'type' => Table::TYPE_TIMESTAMP,
                        'comment' => 'Social Created At',
                    ]
                );
            }
            if ($connection->tableColumnExists($tableName, 'user_id') === false) {
                $connection->addColumn(
                    $tableName,
                    'user_id',
                    [
                        'type' => Table::TYPE_INTEGER,
                        'nullable' => true,
                        'unsigned' => true,
                        'comment' => 'User Id',
                    ]
                );
                $connection->addForeignKey(
                    $installer->getFkName('magetop_social_customer', 'user_id', 'admin_user', 'user_id'),
                    $tableName,
                    'user_id',
                    $installer->getTable('admin_user'),
                    'user_id',
                    Table::ACTION_CASCADE
                );
            }
            if ($connection->tableColumnExists($tableName, 'status') === false) {
                $connection->addColumn(
                    $tableName,
                    'status',
                    [
                        'type' => Table::TYPE_TEXT,
                        'nullable' => true,
                        'length' => 255,
                        'comment' => 'Status',
                    ]
                );
            }
        }
        $installer->endSetup();
    }
}
