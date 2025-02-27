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
 * @package     Mage_XmlConnect
 * @copyright  Copyright (c) 2006-2017 X.commerce, Inc. and affiliates (http://www.magento.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml airmail queue grid block action item renderer
 *
 * @category    Mage
 * @package     Mage_XmlConnect
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_XmlConnect_Block_Adminhtml_Queue_Grid_Renderer_Status
    extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * Render grid row
     *
     * @param Varien_Object $row
     * @return string
     */
    public function render(Varien_Object $row)
    {
        $str = '';
        if (is_numeric($row->getStatus())) {
            switch ($row->getStatus()) {
                case Mage_XmlConnect_Model_Queue::STATUS_IN_QUEUE:
                    $str = $this->__('In Queue');
                    break;
                case Mage_XmlConnect_Model_Queue::STATUS_CANCELED:
                    $str = $this->__('Cancelled');
                    break;
                case Mage_XmlConnect_Model_Queue::STATUS_COMPLETED:
                    $str = $this->__('Completed');
                    break;
                case Mage_XmlConnect_Model_Queue::STATUS_DELETED:
                    $str = $this->__('Deleted');
                    break;
            }
        }

        if ($str === '') {
            $str = $this->__('Undefined');
        }

        return $this->escapeHtml($str);
     }
}
