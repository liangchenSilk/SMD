<?php
/**
 * Blackbird ContentManager Module
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 *
 * @category	Blackbird
 * @package		Blackbird_ContentManager
 * @copyright	Copyright (c) 2014 Blackbird Content Manager (http://black.bird.eu)
 * @author		Blackbird Team
 * @license		http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @version		
 */

class Blackbird_ContentManager_Model_Observer_Search {
    
    public function beforeLoadLayout(Varien_Event_Observer $observer)
    {
        if(Mage::app()->getRequest()->getRouteName() == 'catalogsearch' && Mage::app()->getRequest()->getControllerName() == 'result' && Mage::app()->getRequest()->getActionName() == 'index')
        {
            $layout = $observer->getEvent()->getLayout();
            $layout->getUpdate()->addHandle('contentmanager_search_result');            
        }
    }
    
}