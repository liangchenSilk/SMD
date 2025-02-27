<?php
//<?php
//
///**
// * @method string getTitle()
// * @method void setTitle(string $title)
// * @method int getColumnCount()
// * @method void setColumnCount(int $count)
// * @method bool getOnRight()
// * @method void setOnRight(bool $bool)
// * @method bool getOnLeft()
// * @method void setOnLeft(bool $bool)
// */
class Epicor_Supplierconnect_Block_Customer_Account_Password extends Mage_Core_Block_Template {
//
//    /**
//     *  @var Varien_Object 
//     */
//    protected $_infoData = array();
//
//    public function _construct() {
//        parent::_construct();
//        $this->setTemplate('supplierconnect/customer/account/info.phtml');
//        $this->setColumnCount(3);
//    }
//
//    /**
//     * 
//     * @return Epicor_Supplierconnect_Helper_Data
//     */
//    public function getHelper($type = null) {
//        return Mage::helper('supplierconnect');
//    }
//
//}

     public function _construct() {        
//    public function initForm()
    {
          parent::_construct();
//        $this->setTemplate('supplierconnect/customer/account/info.phtml');
//        $this->setColumnCount(3);
     }
//        $form = new Varien_Data_Form();
//        $form->setHtmlIdPrefix('_account');
//        $form->setFieldNameSuffix('account');
//
//        $customer = Mage::registry('current_customer');
//
//        /** @var $customerForm Mage_Customer_Model_Form */
//        $customerForm = Mage::getModel('customer/form');
//        $customerForm->setEntity($customer)
//            ->setFormCode('adminhtml_customer')
//            ->initDefaultValues();
//
//        $fieldset = $form->addFieldset('base_fieldset', array(
//            'legend' => Mage::helper('customer')->__('Account Information')
//        ));
//
//        $attributes = $customerForm->getAttributes();
//        foreach ($attributes as $attribute) {
//            /* @var $attribute Mage_Eav_Model_Entity_Attribute */
//            $attribute->setFrontendLabel(Mage::helper('customer')->__($attribute->getFrontend()->getLabel()));
//            $attribute->unsIsVisible();
//        }
//
//        $disableAutoGroupChangeAttributeName = 'disable_auto_group_change';
//        $this->_setFieldset($attributes, $fieldset, array($disableAutoGroupChangeAttributeName));
//
//        $form->getElement('group_id')->setRenderer($this->getLayout()
//            ->createBlock('adminhtml/customer_edit_renderer_attribute_group')
//            ->setDisableAutoGroupChangeAttribute($customerForm->getAttribute($disableAutoGroupChangeAttributeName))
//            ->setDisableAutoGroupChangeAttributeValue($customer->getData($disableAutoGroupChangeAttributeName)));
//
//        if ($customer->getId()) {
//            $form->getElement('website_id')->setDisabled('disabled');
//            $form->getElement('created_in')->setDisabled('disabled');
//        } else {
//            $fieldset->removeField('created_in');
//            $form->getElement('website_id')->addClass('validate-website-has-store');
//
//            $websites = array();
//            foreach (Mage::app()->getWebsites(true) as $website) {
//                $websites[$website->getId()] = !is_null($website->getDefaultStore());
//            }
//            $prefix = $form->getHtmlIdPrefix();
//
//            $form->getElement('website_id')->setAfterElementHtml(
//                '<script type="text/javascript">'
//                . "
//                var {$prefix}_websites = " . Mage::helper('core')->jsonEncode($websites) .";
//                Validation.add(
//                    'validate-website-has-store',
//                    '" . Mage::helper('customer')->__('Please select a website which contains store view') . "',
//                    function(v, elem){
//                        return {$prefix}_websites[elem.value] == true;
//                    }
//                );
//                Element.observe('{$prefix}website_id', 'change', function(){
//                    Validation.validate($('{$prefix}website_id'))
//                }.bind($('{$prefix}website_id')));
//                "
//                . '</script>'
//            );
//        }
//        $renderer = $this->getLayout()->createBlock('adminhtml/store_switcher_form_renderer_fieldset_element');
//        $form->getElement('website_id')->setRenderer($renderer);
//
////        if (Mage::app()->isSingleStoreMode()) {
////            $fieldset->removeField('website_id');
////            $fieldset->addField('website_id', 'hidden', array(
////                'name'      => 'website_id'
////            ));
////            $customer->setWebsiteId(Mage::app()->getStore(true)->getWebsiteId());
////        }
//
//        $customerStoreId = null;
//        if ($customer->getId()) {
//            $customerStoreId = Mage::app()->getWebsite($customer->getWebsiteId())->getDefaultStore()->getId();
//        }
//
//        $prefixElement = $form->getElement('prefix');
//        if ($prefixElement) {
//            $prefixOptions = $this->helper('customer')->getNamePrefixOptions($customerStoreId);
//            if (!empty($prefixOptions)) {
//                $fieldset->removeField($prefixElement->getId());
//                $prefixField = $fieldset->addField($prefixElement->getId(),
//                    'select',
//                    $prefixElement->getData(),
//                    $form->getElement('group_id')->getId()
//                );
//                $prefixField->setValues($prefixOptions);
//                if ($customer->getId()) {
//                    $prefixField->addElementValues($customer->getPrefix());
//                }
//
//            }
//        }
//
//        $suffixElement = $form->getElement('suffix');
//        if ($suffixElement) {
//            $suffixOptions = $this->helper('customer')->getNameSuffixOptions($customerStoreId);
//            if (!empty($suffixOptions)) {
//                $fieldset->removeField($suffixElement->getId());
//                $suffixField = $fieldset->addField($suffixElement->getId(),
//                    'select',
//                    $suffixElement->getData(),
//                    $form->getElement('lastname')->getId()
//                );
//                $suffixField->setValues($suffixOptions);
//                if ($customer->getId()) {
//                    $suffixField->addElementValues($customer->getSuffix());
//                }
//            }
//        }
//
//        if ($customer->getId()) {
//            if (!$customer->isReadonly()) {
//                // Add password management fieldset
//                $newFieldset = $form->addFieldset(
//                    'password_fieldset',
//                    array('legend' => Mage::helper('customer')->__('Password Management'))
//                );
//                // New customer password
//                $field = $newFieldset->addField('new_password', 'text',
//                    array(
//                        'label' => Mage::helper('customer')->__('New Password'),
//                        'name'  => 'new_password',
//                        'class' => 'validate-new-password'
//                    )
//                );
//                $field->setRenderer($this->getLayout()->createBlock('adminhtml/customer_edit_renderer_newpass'));
//
//                // Prepare customer confirmation control (only for existing customers)
//                $confirmationKey = $customer->getConfirmation();
//                if ($confirmationKey || $customer->isConfirmationRequired()) {
//                    $confirmationAttribute = $customer->getAttribute('confirmation');
//                    if (!$confirmationKey) {
//                        $confirmationKey = $customer->getRandomConfirmationKey();
//                    }
//                    $element = $fieldset->addField('confirmation', 'select', array(
//                        'name'  => 'confirmation',
//                        'label' => Mage::helper('customer')->__($confirmationAttribute->getFrontendLabel()),
//                    ))->setEntityAttribute($confirmationAttribute)
//                        ->setValues(array('' => 'Confirmed', $confirmationKey => 'Not confirmed'));
//
//                    // Prepare send welcome email checkbox if customer is not confirmed
//                    // no need to add it, if website ID is empty
//                    if ($customer->getConfirmation() && $customer->getWebsiteId()) {
//                        $fieldset->addField('sendemail', 'checkbox', array(
//                            'name'  => 'sendemail',
//                            'label' => Mage::helper('customer')->__('Send Welcome Email after Confirmation')
//                        ));
//                        $customer->setData('sendemail', '1');
//                    }
//                }
//            }
//        } else {
//            $newFieldset = $form->addFieldset(
//                'password_fieldset',
//                array('legend'=>Mage::helper('customer')->__('Password Management'))
//            );
//            $field = $newFieldset->addField('password', 'text',
//                array(
//                    'label' => Mage::helper('customer')->__('Password'),
//                    'class' => 'input-text required-entry validate-password',
//                    'name'  => 'password',
//                    'required' => true
//                )
//            );
//            $field->setRenderer($this->getLayout()->createBlock('adminhtml/customer_edit_renderer_newpass'));
//
//            // Prepare send welcome email checkbox
//            $fieldset->addField('sendemail', 'checkbox', array(
//                'label' => Mage::helper('customer')->__('Send Welcome Email'),
//                'name'  => 'sendemail',
//                'id'    => 'sendemail',
//            ));
//            $customer->setData('sendemail', '1');
//            if (!Mage::app()->isSingleStoreMode()) {
//                $fieldset->addField('sendemail_store_id', 'select', array(
//                    'label' => $this->helper('customer')->__('Send From'),
//                    'name' => 'sendemail_store_id',
//                    'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm()
//                ));
//            }
//        }
//
//        // Make sendemail and sendmail_store_id disabled if website_id has empty value
//        $isSingleMode = Mage::app()->isSingleStoreMode();
//        $sendEmailId = $isSingleMode ? 'sendemail' : 'sendemail_store_id';
//        $sendEmail = $form->getElement($sendEmailId);
//
//        $prefix = $form->getHtmlIdPrefix();
//        if ($sendEmail) {
//            $_disableStoreField = '';
//            if (!$isSingleMode) {
//                $_disableStoreField = "$('{$prefix}sendemail_store_id').disabled=(''==this.value || '0'==this.value);";
//            }
//            $sendEmail->setAfterElementHtml(
//                '<script type="text/javascript">'
//                . "
//                $('{$prefix}website_id').disableSendemail = function() {
//                    $('{$prefix}sendemail').disabled = ('' == this.value || '0' == this.value);".
//                    $_disableStoreField
//                ."}.bind($('{$prefix}website_id'));
//                Event.observe('{$prefix}website_id', 'change', $('{$prefix}website_id').disableSendemail);
//                $('{$prefix}website_id').disableSendemail();
//                "
//                . '</script>'
//            );
//        }
//
//        if ($customer->isReadonly()) {
//            foreach ($customer->getAttributes() as $attribute) {
//                $element = $form->getElement($attribute->getAttributeCode());
//                if ($element) {
//                    $element->setReadonly(true, true);
//                }
//            }
//        }
//
//        $form->setValues($customer->getData());
//        $this->setForm($form);
//        return $this;
    }
}