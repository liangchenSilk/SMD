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
 * @package     Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml customers group page content block
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Adminhtml_Block_Customer_Group extends Mage_Adminhtml_Block_Widget_Grid_Container//Mage_Adminhtml_Block_Template
{

    /**
     * Modify header & button labels
     *
     */
    public function __construct()
    {
        $this->_controller = 'customer_group';
        $this->_headerText = Mage::helper('customer')->__('Customer Groups');
        $this->_addButtonLabel = Mage::helper('customer')->__('Add New Customer Group');
        parent::__construct();
    }

    /**
     * Redefine header css class
     *
     * @return string
     */
    public function getHeaderCssClass() {
        return 'icon-head head-customer-groups';
    }
}
