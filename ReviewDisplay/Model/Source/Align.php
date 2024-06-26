<?php
/**
 * @author Michal Walkowiak
 * @copyright Copyright (c) 2017 PowerReviews (http://www.powerreviews.com)
 * @package PowerReviews_ReviewDisplay
 */
namespace PowerReviews\ReviewDisplay\Model\Source;

class Align implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'left', 'label' => __('Left Position')],
            ['value' => 'center', 'label' => __('Center Position')],
        ];
    }
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return ['left' => __('Left Position'),
                'center' => __('Center Position')
        ];
    }
}
