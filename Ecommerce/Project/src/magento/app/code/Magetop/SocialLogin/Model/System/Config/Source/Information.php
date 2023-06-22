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
 * Class Information
 *
 * @package Magetop\SocialLogin\Model\System\Config\Source
 */
class Information implements ArrayInterface
{
    const INFO_EMAIL = 'email';
    const INFOR_NAME = 'name';
    const INFOR_PW   = 'password';

    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::INFO_EMAIL, 'label' => __('Email')],
            ['value' => self::INFOR_NAME, 'label' => __('Name')],
            ['value' => self::INFOR_PW, 'label' => __('Password')]
        ];
    }
}
