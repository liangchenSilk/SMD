<?php

class Epicor_Customerconnect_Block_Adminhtml_Config_Form_Field_Crqs_Options
        extends Mage_Core_Block_Html_Select
{

    public function setInputName($value)
    {
        return $this->setName($value);
    }

    public function setColumnName($value)
    {
        return $this->setExtraParams('rel="#{options}" style="width:80px"');
    }

    public function _toHtml()
    {
        if (!$this->getOptions()) {
            $this->addOption('', $this->__('None'));
            $this->addOption('customerconnect/erp_mapping_erpquotestatus', $this->__('Erp Quote Status'));
        }
        return parent::_toHtml();
    }

}
