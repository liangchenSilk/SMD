<?php

/**
 * Customer Orders list Grid config
 * 
 * Note: columns for this grid are configured in the Magento Admin: Configuration > Customer Connect 
 * 
 * @category   Epicor
 * @package    Epicor_Supplierconnect
 * @author     Epicor Websales Team
 */
class Epicor_Customerconnect_Block_Customer_Dashboard_Orders_Grid extends Epicor_Common_Block_Generic_List_Search
{

    public function __construct()
    {
        parent::__construct();

        $this->setId('customerconnect_5recent_orders');
        $this->setDefaultSort('order_number');
        $this->setDefaultDir('desc');
        $this->setMessageBase('customerconnect');
        $this->setMessageType('cuos');
        $this->setIdColumn('order_number');
        $this->setUseAjax(true);
        $this->setFilterVisibility(false);
        $this->setPagerVisibility(false);
        $this->setCacheDisabled(true);
        $this->setMaxResults(5);

        $this->initColumns();
    }

    public function getRowUrl($row)
    {

        $url = null;
        $accessHelper = Mage::helper('epicor_common/access');
        /* @var $helper Epicor_Common_Helper_Access */
        if ($accessHelper->customerHasAccess('Epicor_Customerconnect', 'Orders', 'details', '', 'Access')) {
            $helper = Mage::helper('customerconnect');
            /* @var $helper Epicor_Customerconnect_Helper_Data */
            $erp_account_number = $helper->getErpAccountNumber();
            $order_requested = $helper->urlEncode($helper->encrypt($erp_account_number . ']:[' . $row->getId()));
            $url = Mage::getUrl('*/orders/details', array('order' => $order_requested, 'back' => $helper->urlEncode(Mage::getUrl('*/*/*', $this->getRequest()->getParams()))));
        }

        return $url;
    }

    protected function _toHtml()
    {
        $html = parent::_toHtml();

        $html = '<p><a class="view_all" href="' . Mage::getUrl('*/orders/') . '">' . $this->__('View All') . '</a></p>' . $html;

        return $html;
    }

    protected function initColumns()
    {
        parent::initColumns();

        $columns = $this->getCustomColumns();

        if (Mage::helper('epicor_lists/frontend_contract')->contractsDisabled()) {
            unset($columns['contracts_contract_code']);
        }

        $helper = Mage::helper('epicor_common/access');
        /* @var $helper Epicor_Common_Helper_Access */

        if ($helper->customerHasAccess('Epicor_Customerconnect', 'Orders', 'reorder', '', 'Access')) {
            if (Mage::getStoreConfig('sales/reorder/allow')) {
                $columns['reorder'] = array(
                    'header' => Mage::helper('epicor_comm')->__('Reorder'),
                    'type' => 'text',
                    'renderer' => new Epicor_Customerconnect_Block_Customer_Dashboard_Orders_Renderer_Reorder(),
                );
            }
        }

        $this->setCustomColumns($columns);
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/grid/orderssearch');
    }

}
