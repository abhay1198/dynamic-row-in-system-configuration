<?php
/**
 * @package     Abhay/CustomMenu
 * @version     1.0.0
 * @author      Abhay
 * @copyright   Copyright © 2021. All Rights Reserved.
 */

namespace Abhay\CustomMenu\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_CUSTOM_MENU_GENERAL_ENABLE = 'custom_menu/general/enable';
    const CONFIG_CUSTOM_MENU_GENERAL_RANGES = 'custom_menu/general/ranges';
    protected $serialize;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Serialize\Serializer\Json $serialize
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->serialize = $serialize;
        parent::__construct($context);
    }

    public function isEnabled()
    {
        return (bool)$this->scopeConfig->getValue(self::CONFIG_CUSTOM_MENU_GENERAL_ENABLE);
    }

    public function getStoreid()
    {
        return $this->storeManager->getStore()->getId();
    }

    public function getMenuData()
    {
        $customMenuConfig = $this->scopeConfig->getValue(self::CONFIG_CUSTOM_MENU_GENERAL_RANGES,ScopeInterface::SCOPE_STORE,$this->getStoreid());
        if($customMenuConfig == '' || $customMenuConfig == null)
            return;

        $unserializedata = $this->serialize->unserialize($customMenuConfig);

        $customMenuDataArray = array();
        
        foreach($unserializedata as $key => $row)
        {
            $customMenuDataArray[] = [
                'custom_menu' => $row['from_qty'],
                'link' => $row['to_qty']
            ]; 
        }
        return $customMenuDataArray;
    }
}