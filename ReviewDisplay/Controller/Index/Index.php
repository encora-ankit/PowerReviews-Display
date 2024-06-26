<?php

/**
 * Copyright © 2017 PowerReviews. All rights reserved.
 */

namespace PowerReviews\ReviewDisplay\Controller\Index;

/**
 * Responsible for loading page content.
 *
 * This is a basic controller that only loads the corresponding layout file.
 *
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    protected $resultPageFactory;
    /**
     * Result Page Factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    /**
     * Load the page defined in view/frontend/layout/samplenewpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
