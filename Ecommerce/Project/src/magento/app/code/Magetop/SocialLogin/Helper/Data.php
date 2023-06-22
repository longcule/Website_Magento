<?php
/**
 * Magetop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magetop.com license that is
 * available through the world-wide-web at this URL:
 * https://www.magetop.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category  Magetop
 * @package   Magetop_SocialLogin
 * @copyright Copyright (c) Magetop (https://www.magetop.com/)
 * @license   https://www.magetop.com/LICENSE.txt
 */

namespace Magetop\SocialLogin\Helper;

use Magento\Framework\App\RequestInterface;
use Magetop\SocialLogin\Helper\AbstractData as AbstractHelper;

/**
 * Class Data
 *
 * @package Magetop\SocialLogin\Helper
 */
class Data extends AbstractHelper
{
    const CONFIG_MODULE_PATH = 'sociallogin';

    /**
     * @param RequestInterface $request
     * @param $formId
     *
     * @return string
     */
    public function captchaResolve(RequestInterface $request, $formId)
    {
        $captchaParams = $request->getPost(\Magento\Captcha\Helper\Data::INPUT_NAME_FIELD_VALUE);

        return isset($captchaParams[$formId]) ? $captchaParams[$formId] : '';
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function canSendPassword($storeId = null)
    {
        return $this->getConfigGeneral('send_password', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getPopupEffect($storeId = null)
    {
        return $this->getConfigGeneral('popup_effect', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getStyleManagement($storeId = null)
    {
        $style = $this->getConfigGeneral('style_management', $storeId);
        if ($style === 'custom') {
            return $this->getCustomColor($storeId);
        }

        return $style;
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getCustomColor($storeId = null)
    {
        return $this->getConfigGeneral('custom_color', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getCustomCss($storeId = null)
    {
        return $this->getConfigGeneral('custom_css', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function requiredMoreInfo($storeId = null)
    {
        return $this->getConfigGeneral('require_more_info', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getFieldCanShow($storeId = null)
    {
        return $this->getConfigGeneral('information_require', $storeId);
    }

    /**
     * @return mixed
     */
    public function isSecure()
    {
        return $this->getConfigValue('web/secure/use_in_frontend');
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function isReplaceAuthModal($storeId = null)
    {
        return $this->getPopupLogin() && $this->getConfigGeneral('authentication_popup', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getPopupLogin($storeId = null)
    {
        return $this->getConfigGeneral('popup_login', $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function isCheckMode($storeId = null)
    {
        return $this->getConfigGeneral('check_mode', $storeId);
    }
}
