<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Autorelated
 * @version    2.5.0
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */

class AW_Autorelated_Model_Blocks_Category_Rule extends AW_Autorelated_Model_Blocks_Rule
{
    public function getConditionsInstance()
    {
        return Mage::getModel('awautorelated/catalogrule_rule_condition_combine');
    }

    public function _resetConditions($conditions = null)
    {
        parent::_resetConditions($conditions);
        $this->getConditions($conditions)
            ->setId('related_conditions')
            ->setPrefix('related');
        return $this;
    }
}