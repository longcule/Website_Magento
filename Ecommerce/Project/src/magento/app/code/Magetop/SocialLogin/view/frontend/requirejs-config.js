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

var config = {
    paths: {
        socialProvider: 'Magetop_SocialLogin/js/provider',
        socialPopupForm: 'Magetop_SocialLogin/js/popup'
    },
    map: {
        '*': {
            'Magento_Checkout/js/proceed-to-checkout': 'Magetop_SocialLogin/js/proceed-to-checkout'
        }
    }
};
