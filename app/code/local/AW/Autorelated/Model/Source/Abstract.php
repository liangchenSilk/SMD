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

abstract class AW_Autorelated_Model_Source_Abstract
{
    abstract public function toOptionArray();

    /**
     * Returns array(value => ..., label => ...) for option with given value
     * @param string $value
     * @return array
     */
    public function getOption($value)
    {
        $_options = $this->toOptionArray();

        foreach ($_options as $_option)
            if ($_option['value'] == $value)
                return $_option;

        return FALSE;
    }

    /**
     * Get label for option with given value
     * @param string $value
     * @return string
     */
    public function getOptionLabel($value)
    {
        $_option = $this->getOption($value);
        if (!$_option)
            return FALSE;
        return $_option['label'];
    }

    /**
     * Returns associative array $value => $label
     * @return array
     */
    public function toShortOptionArray()
    {
        $_options = array();
        foreach ($this->toOptionArray() as $option)
            $_options[$option['value']] = $option['label'];
        return $_options;
    }

    protected function _getHelper($ext = '')
    {
        return Mage::helper('awautorelated' . ($ext ? '/' . $ext : ''));
    }
}