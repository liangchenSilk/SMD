<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    Mage
 * @package     Mage_Bundle
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


$installer = $this;
/* @var $installer Mage_Catalog_Model_Resource_Eav_Mysql4_Setup */

$installer->startSetup();
$installer->run("
CREATE TABLE `{$installer->getTable('bundle/price_index')}` (
  `entity_id` int(10) unsigned NOT NULL,
  `website_id` smallint(5) unsigned NOT NULL,
  `customer_group_id` smallint(3) unsigned NOT NULL,
  `min_price` decimal(12,4) NOT NULL,
  `max_price` decimal(12,4) NOT NULL,
  PRIMARY KEY  (`entity_id`,`website_id`,`customer_group_id`),
  KEY `IDX_WEBSITE` (`website_id`),
  KEY `IDX_CUSTOMER_GROUP` (`customer_group_id`),
  CONSTRAINT `CATALOG_PRODUCT_BUNDLE_PRICE_INDEX_CUSTOMER_GROUP` FOREIGN KEY (`customer_group_id`) REFERENCES `{$installer->getTable('customer/customer_group')}` (`customer_group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `CATALOG_PRODUCT_BUNDLE_PRICE_INDEX_PRODUCT_ENTITY` FOREIGN KEY (`entity_id`) REFERENCES `{$installer->getTable('catalog/product')}` (`entity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `CATALOG_PRODUCT_BUNDLE_PRICE_INDEX_WEBSITE` FOREIGN KEY (`website_id`) REFERENCES `{$installer->getTable('core/website')}` (`website_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();
