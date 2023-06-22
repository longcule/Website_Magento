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

namespace Magetop\SocialLogin\Model\System\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Class Popup
 *
 * @package Magetop\SocialLogin\Model\System\Config\Source
 */
class Popup implements ArrayInterface
{
    const POPUP_LOGIN = 'popup_login';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '', 'label' => __('None')],
            ['value' => self::POPUP_LOGIN, 'label' => __('Popup Login')]
        ];
    }
}
