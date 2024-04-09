<?php
namespace PowerReviews\ReviewDisplay\Block;

class ReviewDisplay extends \Magento\Framework\View\Element\Template
{
    public const SEARCH_RESULTS_CATEGORY_PAGE_SNIPPET = 'powerreviews_reviewdisplay/
        on_off_sections/search_results_category_page_snippet';

    /**
     * PowerReviews
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * PowerReviews
     *
     * @param Context $context
     * @param ScopeConfigInterface $scopeConfig
     * @param Data $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    /**
     * Get Search Result Category Snippet
     *
     * @param Value $value
     */
    public function getSearchResultsCategoryPageSnippet($value = '')
    {
        return $this->scopeConfig->getValue(
            self::SEARCH_RESULTS_CATEGORY_PAGE_SNIPPET,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
