<?php
/**
 * @package     Abhay/CustomMenu
 * @version     1.0.0
 * @author      Abhay
 * @copyright   Copyright © 2021. All Rights Reserved.
 */
namespace Abhay\CustomMenu\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Ranges
 */
class Ranges extends AbstractFieldArray
{
    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('from_qty', ['label' => __('Menu Name'), 'class' => 'required-entry']);
        $this->addColumn('to_qty', ['label' => __('Link'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
