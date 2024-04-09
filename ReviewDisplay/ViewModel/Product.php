<?php
/**
 * @author Michal Walkowiak
 * @copyright Copyright (c) 2017 PowerReviews (http://www.powerreviews.com)
 * @package PowerReviews_ReviewDisplay
 */
namespace PowerReviews\ReviewDisplay\ViewModel;
 
use Magento\Framework\View\Element\Block\ArgumentInterface;
 
class Product implements ArgumentInterface
{
    /**
     * PowerReviews
     *
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    public const ENABLE      = 'powerreviews_reviewdisplay/general/enable';
    public const MERCHANT_ID = 'powerreviews_reviewdisplay/general/merchant_id';
    public const MERCHANT_GROUP_ID  = 'powerreviews_reviewdisplay/general/merchant_group_id';
    public const API_KEY  = 'powerreviews_reviewdisplay/general/api_key';
    public const LOCALE  = 'powerreviews_reviewdisplay/general/locale';

    public const PRODUCT_PAGE_REVIEW_SNIPPET = 'powerreviews_reviewdisplay/on_off_sections/product_page_review_snippet';
    public const PRODUCT_PAGE_REVIEW_DISPLAY = 'powerreviews_reviewdisplay/on_off_sections/product_page_review_display';
    public const SEARCH_RESULTS_CATEGORY_PAGE_SNIPPET =
    'powerreviews_reviewdisplay/on_off_sections/search_results_category_page_snippet';
    public const PRODUCT_PAGE_QUESTION_SNIPPET =
    'powerreviews_reviewdisplay/on_off_sections/product_page_question_snippet';
    public const PRODUCT_PAGE_QUESTION_DISPLAY =
    'powerreviews_reviewdisplay/on_off_sections/product_page_question_display';
    public const CATALOG_REVIEW_ACTIVE = 'catalog/review/active';
    /**
     * PowerReviews
     *
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        $this->_scopeConfig = $context->getScopeConfig();
    }
    /**
     * Enable
     */
    public function getEnable()
    {
        return $this->_scopeConfig->getValue(self::ENABLE, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }
    /**
     * Get Mercheant ID
     */
    public function getMerchantId()
    {
        return $this->_scopeConfig->getValue(self::MERCHANT_ID, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }
    /**
     * Get Mercheant Group ID
     */
    public function getMerchantGroupId()
    {
        return $this->_scopeConfig->getValue(self::MERCHANT_GROUP_ID, \Magento\Store\Model\ScopeInterface::
            SCOPE_WEBSITE);
    }
    /**
     * Get APT KEY
     */
    public function getApiKey()
    {
        return $this->_scopeConfig->getValue(self::API_KEY, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }
    /**
     * Local
     */
    public function getLocale()
    {
        return $this->_scopeConfig->getValue(self::LOCALE, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }
    /**
     * Get Product Page Review Snippet
     */
    public function getProductPageReviewSnippet()
    {
        return $this->_scopeConfig->getValue(self::PRODUCT_PAGE_REVIEW_SNIPPET, \Magento\Store\Model\ScopeInterface::
            SCOPE_WEBSITE);
    }
    /**
     * Get Product Page Review Dispaly
     */
    public function getProductPageReviewDisplay()
    {
        return $this->_scopeConfig->getValue(self::PRODUCT_PAGE_REVIEW_DISPLAY, \Magento\Store\Model\ScopeInterface::
            SCOPE_WEBSITE);
    }
    /**
     * Get Search Result Category Snippet
     */
    public function getSearchResultsCategoryPageSnippet()
    {
        return $this->_scopeConfig->getValue(self::
            SEARCH_RESULTS_CATEGORY_PAGE_SNIPPET, \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE);
    }
    /**
     * Get Product Page Questions Snippet
     */
    public function getProductPageQuestionSnippet()
    {
        return $this->_scopeConfig->getValue(self::PRODUCT_PAGE_QUESTION_SNIPPET, \Magento\Store\Model\ScopeInterface::
            SCOPE_WEBSITE);
    }
    /**
     * Get Product Page Questions Dispaly
     */
    public function getProductPageQuestionDisplay()
    {
        return $this->_scopeConfig->getValue(self::PRODUCT_PAGE_QUESTION_DISPLAY, \Magento\Store\Model\ScopeInterface::
            SCOPE_WEBSITE);
    }

    /**
     * Check Magento Default Review Enable/Disable
     */
    public function getMagentoDefaultReview()
    {
        return $this->_scopeConfig->getValue(
            self::CATALOG_REVIEW_ACTIVE,
            \Magento\Store\Model\ScopeInterface::SCOPE_WEBSITE
        );
    }
}
