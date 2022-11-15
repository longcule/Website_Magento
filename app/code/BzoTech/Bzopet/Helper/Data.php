<?php

namespace BzoTech\Bzopet\Helper;

use Magento\Store\Model\StoreManagerInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Theme\Block\Html\Header\Logo
     */
    protected $_logo;

    public function __construct(
        StoreManagerInterface $storeManagerInterface,
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Theme\Block\Html\Header\Logo $logo
    )
    {
        $this->_storeManager = $storeManagerInterface;
        $this->_logo         = $logo;
        parent::__construct($context);
    }

    public function getStoreId()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getStoreCode()
    {
        return $this->_storeManager->getStore()->getCode();
    }

    public function getUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getUrlStatic()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_STATIC);
    }

    public function getLocale()
    {
        return $this->scopeConfig->getValue(
            'general/locale/code',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getMediaUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getThemeConfig($name)
    {
        return $this->scopeConfig->getValue(
            'bzopet/' . $name,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return bool
     */
    public function isHomePage()
    {
        return $this->_logo->isHomePage();
    }
}