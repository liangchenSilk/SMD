<?php

class Epicor_Comm_Adminhtml_Epicorcomm_System_VariableController extends Epicor_Comm_Controller_Adminhtml_Abstract
{
    /**
     * Initialize Layout and set breadcrumbs
     *
     * @return Mage_Adminhtml_System_VariableController
     */
    protected function _initLayout()
    {
        $this->loadLayout()
            ->_setActiveMenu('system/variable')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Custom Variables'), Mage::helper('adminhtml')->__('Custom Variables'));
        return $this;
    }

    /**
     * Initialize Variable object
     *
     * @return Mage_Core_Model_Variable
     */
    protected function _initVariable()
    {
        $this->_title($this->__('System'))->_title($this->__('Custom Variables'));

        $variableId = $this->getRequest()->getParam('variable_id', null);
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        /* @var $emailVariable Mage_Core_Model_Variable */
        $variable = Mage::getModel('core/variable');
        if ($variableId) {
            $variable->setStoreId($storeId)
                ->load($variableId);
        }
        Mage::register('current_variable', $variable);
        return $variable;
    }

    /**
     * Index Action
     *
     */
//    public function indexAction()
//    {
//        $this->_title($this->__('System'))->_title($this->__('Custom Variables'));
//
//        $this->_initLayout()
//            ->_addContent($this->getLayout()->createBlock('adminhtml/system_variable'))
//            ->renderLayout();
//    }

    /**
     * New Action (forward to edit action)
     *
     */
//    public function newAction()
//    {
//        $this->_forward('edit');
//    }
//
//    /**
//     * Edit Action
//     *
//     */
//    public function editAction()
//    {
//        $variable = $this->_initVariable();
//
//        $this->_title($variable->getId() ? $variable->getCode() : $this->__('New Variable'));
//
//        $this->_initLayout()
//            ->_addContent($this->getLayout()->createBlock('adminhtml/system_variable_edit'))
//            ->_addJs($this->getLayout()->createBlock('core/template', '', array(
//                'template' => 'system/variable/js.phtml'
//            )))
//            ->renderLayout();
//    }

    /**
     * Validate Action
     *
     */
//    public function validateAction()
//    {
//        $response = new Varien_Object(array('error' => false));
//        $variable = $this->_initVariable();
//        $variable->addData($this->getRequest()->getPost('variable'));
//        $result = $variable->validate();
//        if ($result !== true && is_string($result)) {
//            $this->_getSession()->addError($result);
//            $this->_initLayoutMessages('adminhtml/session');
//            $response->setError(true);
//            $response->setMessage($this->getLayout()->getMessagesBlock()->getGroupedHtml());
//        }
//        $this->getResponse()->setBody($response->toJson());
//    }
//
//    /**
//     * Save Action
//     *
//     */
//    public function saveAction()
//    {
//        $variable = $this->_initVariable();
//        $data = $this->getRequest()->getPost('variable');
//        $back = $this->getRequest()->getParam('back', false);
//        if ($data) {
//            $data['variable_id'] = $variable->getId();
//            $variable->setData($data);
//            try {
//                $variable->save();
//                $this->_getSession()->addSuccess(
//                    Mage::helper('adminhtml')->__('The custom variable has been saved.')
//                );
//                if ($back) {
//                    $this->_redirect('*/*/edit', array('_current' => true, 'variable_id' => $variable->getId()));
//                } else {
//                    $this->_redirect('*/*/', array());
//                }
//                return;
//            } catch (Exception $e) {
//                $this->_getSession()->addError($e->getMessage());
//                $this->_redirect('*/*/edit', array('_current' => true, ));
//                return;
//            }
//        }
//        $this->_redirect('*/*/', array());
//        return;
//    }
//
//    /**
//     * Delete Action
//     *
//     */
//    public function deleteAction()
//    {
//        $variable = $this->_initVariable();
//        if ($variable->getId()) {
//            try {
//                $variable->delete();
//                $this->_getSession()->addSuccess(
//                    Mage::helper('adminhtml')->__('The custom variable has been deleted.')
//                );
//            } catch (Exception $e) {
//                $this->_getSession()->addError($e->getMessage());
//                $this->_redirect('*/*/edit', array('_current' => true, ));
//                return;
//            }
//        }
//        $this->_redirect('*/*/', array());
//        return;
//    }

    /**
     * WYSIWYG Plugin Action
     *
     */
    public function wysiwygPluginAction()
    {
        $remotelinksVariables = Mage::getModel('epicor_comm/remotelinks_variables')->toOptionArray(true);
        $variables = array($remotelinksVariables);
        $this->getResponse()->setBody(Zend_Json::encode($variables));
    }

    /**
     * Check current user permission
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('system/variable');
    }
}
