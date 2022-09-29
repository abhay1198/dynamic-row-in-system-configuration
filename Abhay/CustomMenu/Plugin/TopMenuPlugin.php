<?php

/**
 * @package     Abhay/CustomMenu
 * @version     1.0.0
 * @author      Abhay
 * @copyright   Copyright © 2021. All Rights Reserved.
 */
namespace Abhay\CustomMenu\Plugin;

class TopMenuPlugin
{
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Abhay\CustomMenu\Helper\Data $helper
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->helper = $helper;
    }

    public function afterGetHtml(\Magento\Theme\Block\Html\Topmenu $topmenu,$html)
    {
        $storeUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_LINK);
        $html = $this->getMenu($html,$storeUrl);
        return $html;
    }

    protected function getMenu($html,$storeUrl)
    {
        if($this->helper->isEnabled())
        {
            $menuData = $this->helper->getMenuData();
            foreach($menuData as $value)
            {
                $url = $value['link'];
                $html .= "<li class=\"level0 nav-5 active level-top parent ui-menu-item\">";
                $html .= "<a href=\"".$url."\" class=\"level-top ui-corner-all\">
                    <span class=\"ui-menu-icon ui-icon ui-icon-carat-1-e\"></span>
                    <span>".$value['custom_menu']."</span></a>";
                $html .= "</li>";
            }
        }
        return $html;
    }
}
