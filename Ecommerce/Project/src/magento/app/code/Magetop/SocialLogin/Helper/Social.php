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

use Magento\Framework\Exception\LocalizedException;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magetop\SocialLogin\Helper\Data as HelperData;
use Magetop\SocialLogin\Model\Providers\Amazon;
use Magetop\SocialLogin\Model\Providers\GitHub;
use Magetop\SocialLogin\Model\Providers\Instagram;
use Magetop\SocialLogin\Model\Providers\Vkontakte;
use Magetop\SocialLogin\Model\Providers\Zalo;

/**
 * Class Social
 *
 * @package Magetop\SocialLogin\Helper
 */
class Social extends HelperData
{
    /**
     * @var mixed
     */
    protected $_type;

    /**
     * @param null $type
     *
     * @return null
     */
    public function setType($type)
    {
        $listTypes = $this->getSocialTypes();
        if (!$type || !array_key_exists($type, $listTypes)) {
            return null;
        }

        $this->_type = $type;

        return $listTypes[$type];
    }

    /**
     * @return array
     */
    public function getSocialTypes()
    {
        $socialTypes = $this->getSocialTypesArray();
        uksort(
            $socialTypes,
            function ($a, $b) {
                $sortA = $this->getConfigValue("sociallogin/{$a}/sort_order") ?: 0;
                $sortB = $this->getConfigValue("sociallogin/{$b}/sort_order") ?: 0;
                if ($sortA === $sortB) {
                    return 0;
                }

                return ($sortA < $sortB) ? -1 : 1;
            }
        );

        return $socialTypes;
    }

    /**
     * @param $type
     *
     * @return array
     */
    public function getSocialConfig($type)
    {
        $apiData = [
            'Facebook'  => ['trustForwarded' => false, 'scope' => 'email, public_profile'],
            'Twitter'   => ['includeEmail' => true],
            'LinkedIn'  => ['fields' => ['id', 'first-name', 'last-name', 'email-address']],
            'Vkontakte' => ['wrapper' => ['class' => Vkontakte::class]],
            'Instagram' => ['wrapper' => ['class' => Instagram::class]],
            'Github'    => ['wrapper' => ['class' => GitHub::class]],
            'Amazon'    => ['wrapper' => ['class' => Amazon::class]],
            'Google'    => ['scope' => 'profile email'],
            'Yahoo'     => ['scope' => 'profile'],
            'Zalo'      => ['wrapper' => ['class' => Zalo::class], 'scope' => 'access_profile']
        ];

        if ($type && array_key_exists($type, $apiData)) {
            return $apiData[$type];
        }

        return [];
    }

    /**
     * @return array|null
     */
    public function getAuthenticateParams($type)
    {
        return null;
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function isEnabled($storeId = null)
    {
        return $this->getConfigValue("sociallogin/{$this->_type}/is_enabled", $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return array|mixed
     */
    public function isSignInAsAdmin($storeId = null)
    {
        return $this->getConfigValue("sociallogin/{$this->_type}/admin", $storeId);
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getAppId($storeId = null)
    {
        $appId = trim($this->getConfigValue("sociallogin/{$this->_type}/app_id", $storeId));

        return $appId;
    }

    /**
     * @param null $storeId
     *
     * @return mixed
     */
    public function getAppSecret($storeId = null)
    {
        $appSecret = trim($this->getConfigValue("sociallogin/{$this->_type}/app_secret", $storeId));

        return $appSecret;
    }

    /**
     * @param $type
     *
     * @return mixed|string
     * @throws LocalizedException
     */
    public function getAuthUrl($type)
    {
        $authUrl = $this->getBaseAuthUrl();

        $type = $this->setType($type);
        switch ($type) {
            case 'Facebook':
                $param = 'hauth_done=' . $type;
                break;
            case 'Live':
                $param = 'live.php';
                break;
            case 'Yahoo':
            case 'Twitter':
            case 'Zalo':
                return $authUrl;
            default:
                $param = 'hauth.done=' . $type;
        }
        if ($type === 'Live') {
            return $authUrl . $param;
        }

        return $authUrl . ($param ? (strpos($authUrl, '?') ? '&' : '?') . $param : '');
    }

    /**
     * @return string
     * @throws LocalizedException
     */
    public function getBaseAuthUrl($area = null)
    {
        $storeId = $this->getScopeUrl();

        /**
         * @var Store $store
         */
        $store = $this->storeManager->getStore($storeId);

        return $this->_getUrl(
            'sociallogin/social/callback',
            [
                '_nosid'  => true,
                '_scope'  => $storeId,
                '_secure' => true
            ]
        );
    }

    /**
     * @return int
     * @throws LocalizedException
     */
    protected function getScopeUrl()
    {
        $scope = $this->_request->getParam(ScopeInterface::SCOPE_STORE) ?: $this->storeManager->getStore()->getId();

        if ($website = $this->_request->getParam(ScopeInterface::SCOPE_WEBSITE)) {
            $scope = $this->storeManager->getWebsite($website)->getDefaultStore()->getId();
        }

        return $scope;
    }

    /**
     * @return array
     */
    public function getSocialTypesArray()
    {
        return [
            'facebook'   => 'Facebook',
            'google'     => 'Google',
            'twitter'    => 'Twitter',
            'amazon'     => 'Amazon',
            'linkedin'   => 'LinkedIn',
            'yahoo'      => 'Yahoo',
            'foursquare' => 'Foursquare',
            'vkontakte'  => 'Vkontakte',
            'instagram'  => 'Instagram',
            'github'     => 'Github',
            'live'       => 'Live',
            'zalo'       => 'Zalo'
        ];
    }
}
