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
 * @package     Blackbird_ContentManager
 * @copyright  Copyright (c) 2006-2015 X.commerce, Inc. (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * ContentManager Product Flat resource model
 *
 * @category    Mage
 * @package     Blackbird_ContentManager
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Blackbird_ContentManager_Model_Resource_Content_Flat extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Store scope Id
     *
     * @var int
     */
    protected $_storeId;

    /**
     * Store flag which defines if ContentManager Product Flat Data has been initialized
     *
     * @var array
     */
    protected $_isBuilt                  = array();

    /**
     * Init connection and resource table
     *
     */
    protected function _construct()
    {
        $this->_init('contentmanager/content_flat', 'entity_id');
        $this->_storeId = (int)Mage::app()->getStore()->getId();
    }

    /**
     * Retrieve store for resource model
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_storeId;
    }

    /**
     * Set store for resource model
     *
     * @param mixed $store
     * @return Blackbird_ContentManager_Model_Resource_Product_Flat
     */
    public function setStoreId($store)
    {
        if (is_int($store)) {
            $this->_storeId = $store;
        } else {
            $this->_storeId = (int)Mage::app()->getStore($store)->getId();
        }
        return $this;
    }

    /**
     * Retrieve Flat Table name
     *
     * @param mixed $store
     * @return string
     */
    public function getFlatTableName($store = null)
    {
        if ($store === null) {
            $store = $this->getStoreId();
        }
        return $this->getTable(array('contentmanager/content_flat', $store));
    }

    /**
     * Retrieve entity type id
     *
     * @return int
     */
    public function getTypeId()
    {
        return Mage::getSingleton('contentmanager/config')
            ->getEntityType(Blackbird_ContentManager_Model_Product::ENTITY)
            ->getEntityTypeId();
    }

    /**
     * Retrieve attribute columns for collection select
     *
     * @param string $attributeCode
     * @return array|null
     */
    public function getAttributeForSelect($attributeCode)
    {
        $describe = $this->_getWriteAdapter()->describeTable($this->getFlatTableName());
        if (!isset($describe[$attributeCode])) {
            return null;
        }
        $columns = array($attributeCode => $attributeCode);

        $attributeIndex = sprintf('%s_value', $attributeCode);
        if (isset($describe[$attributeIndex])) {
            $columns[$attributeIndex] = $attributeIndex;
        }

        return $columns;
    }

    /**
     * Retrieve Attribute Sort column name
     *
     * @param string $attributeCode
     * @return string
     */
    public function getAttributeSortColumn($attributeCode)
    {
        $describe = $this->_getWriteAdapter()->describeTable($this->getFlatTableName());
        if (!isset($describe[$attributeCode])) {
            return null;
        }
        $attributeIndex = sprintf('%s_value', $attributeCode);
        if (isset($describe[$attributeIndex])) {
            return $attributeIndex;
        }
        return $attributeCode;
    }

    /**
     * Retrieve Flat Table columns list
     *
     * @return array
     */
    public function getAllTableColumns()
    {
        $describe = $this->_getWriteAdapter()->describeTable($this->getFlatTableName());
        return array_keys($describe);
    }

    /**
     * Check whether the attribute is a real field in entity table
     * Rewrited for EAV Collection
     *
     * @param integer|string|Mage_Eav_Model_Entity_Attribute_Abstract $attribute
     * @return bool
     */
    public function isAttributeStatic($attribute)
    {
        $attributeCode = null;
        if ($attribute instanceof Mage_Eav_Model_Entity_Attribute_Interface) {
            $attributeCode = $attribute->getAttributeCode();
        } elseif (is_string($attribute)) {
            $attributeCode = $attribute;
        } elseif (is_numeric($attribute)) {
            $attributeCode = $this->getAttribute($attribute)
                ->getAttributeCode();
        }

        if ($attributeCode) {
            $columns = $this->getAllTableColumns();
            if (in_array($attributeCode, $columns)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve entity id field name in entity table
     * Rewrited for EAV collection compatible
     *
     * @return string
     */
    public function getEntityIdField()
    {
        return $this->getIdFieldName();
    }

    /**
     * Retrieve attribute instance
     * Special for non static flat table
     *
     * @param mixed $attribute
     * @return Mage_Eav_Model_Entity_Attribute_Abstract
     */
    public function getAttribute($attribute)
    {
        return Mage::getSingleton('contentmanager/config')
            ->getAttribute(Blackbird_ContentManager_Model_Product::ENTITY, $attribute);
    }

    /**
     * Retrieve main resource table name
     *
     * @return string
     */
    public function getMainTable()
    {
        return $this->getFlatTableName($this->getStoreId());
    }

    /**
     * Check if ContentManager Product Flat Data has been initialized
     *
     * @param bool|int|\Mage_Core_Model_Store|null $storeView Store(id) for which the value is checked
     * @return bool
     */
    public function isBuilt($storeView = null)
    {
        if ($storeView === null) {
            $storeId = Mage::app()->getAnyStoreView()->getId();
        } elseif (is_int($storeView)) {
            $storeId = $storeView;
        } else {
            $storeId = Mage::app()->getStore($storeView)->getId();
        }

        if (!isset($this->_isBuilt[$storeId])) {
            $select = $this->_getReadAdapter()->select()
                ->from($this->getFlatTableName($storeId), 'entity_id')
                ->limit(1);
            try {
                $this->_isBuilt[$storeId] = (bool)$this->_getReadAdapter()->fetchOne($select);
            } catch (Exception $e) {
                $this->_isBuilt[$storeId] = false;
            }
        }
        return $this->_isBuilt[$storeId];
    }   

}
