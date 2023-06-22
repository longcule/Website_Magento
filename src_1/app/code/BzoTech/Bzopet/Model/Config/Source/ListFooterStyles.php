<?php

namespace BzoTech\Bzopet\Model\Config\Source;

class ListFooterStyles implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'footer-1', 'label' => __('Footer Style 1')],
            ['value' => 'footer-2', 'label' => __('Footer Style 2')],
        ];
    }
}