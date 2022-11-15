<?php

namespace BzoTech\Bzopet\Model\Config\Source;

class ListProductStyles implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'product-1', 'label' => __('Product Style 1')],
            ['value' => 'product-2', 'label' => __('Product Style 2')],
        ];
    }
}