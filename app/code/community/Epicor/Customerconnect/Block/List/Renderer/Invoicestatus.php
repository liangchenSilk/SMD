<?php

/**
 * Invoice status display, converts an erp invoice status code to mapped invoice status
 *
 * @author Gareth.James
 */
class Epicor_Customerconnect_Block_List_Renderer_Invoicestatus extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {

    public function render(Varien_Object $row) {
        $helper = Mage::helper('customerconnect/messaging');

        $index = $this->getColumn()->getIndex();
        return $helper->getInvoiceStatusDescription($row->getData($index));
    }

}
