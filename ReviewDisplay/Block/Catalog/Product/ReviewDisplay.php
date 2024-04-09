<?php
/**
 * @author Michal Walkowiak
 * @copyright Copyright (c) 2017 PowerReviews (http://www.powerreviews.com)
 * @package PowerReviews_ReviewDisplay
 */
namespace PowerReviews\ReviewDisplay\Block\Catalog\Product;

class ReviewDisplay extends \Magento\Framework\View\Element\Template
{

    /**
     * Object Manager Interface
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * @var \PowerReviews\ReviewDisplay\ViewModel\Product
     *
     * @param Context $context
     * @param Product $viewModel
     * @param ObjectManagerInterface $objectManager
     * @param Data $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \PowerReviews\ReviewDisplay\ViewModel\Product $viewModel,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_viewModel = $viewModel;
        $this->_objectManager = $objectManager;
    }
    /**
     * Get Base URL
     */
    public function getBaseUrl()
    {
        return $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)->getStore()->getBaseUrl();
    }
    /**
     * Get APT KEY
     */
    public function getApiKey()
    {
        return $this->_viewModel->getApiKey();
    }
    /**
     * Get LOCAL
     */
    public function getLocale()
    {
        return $this->_viewModel->getLocale() ? $this->_viewModel->getLocale() : 'en_US';
    }
    /**
     * Get MERCHANTID ID
     */
    public function getMerchantId()
    {
        return $this->_viewModel->getMerchantId();
    }
    /**
     * Get MERCHANTID GROUP ID
     */
    public function getMerchantGroupId()
    {
        return $this->_viewModel->getMerchantGroupId();
    }
    /**
     * Get Product Page Review SNIPPET
     */
    public function getProductPageReviewSnippet()
    {
        return $this->_viewModel->getProductPageReviewSnippet();
    }
    /**
     * Get Product Page Review Display
     */
    public function getProductPageReviewDisplay()
    {
        return $this->_viewModel->getProductPageReviewDisplay();
    }
    /**
     * Get Product Page QUESTION SNIPPET
     */
    public function getProductPageQuestionSnippet()
    {
        return $this->_viewModel->getProductPageQuestionSnippet();
    }
    /**
     * Get Product Page QUESTION Dispaly
     */
    public function getProductPageQuestionDisplay()
    {
        return $this->_viewModel->getProductPageQuestionDisplay();
    }
    /**
     * Get Product Stock Status
     */
    public function getProductStockStatus()
    {
        $StockState = $this->_objectManager->get(\Magento\CatalogInventory\Api\StockStateInterface::class);
        $product = $this->getCurrentProduct();
        $stockState = $StockState->getStockQty($product->getId(), $product->getStore()->getWebsiteId());

        return $stockState > 0 ? '1' : '0';
    }
    /**
     * Get Current Product
     */
    public function getCurrentProduct()
    {
        $registry = $this->_objectManager->get(\Magento\Framework\Registry::class);

        return $registry->registry('current_product');
    }
    /**
     * Get Current Category
     */
    public function getCurrentCategory()
    {
        $registry = $this->_objectManager->get(\Magento\Framework\Registry::class);
        $category = $registry->registry('current_category');

        return $registry->registry('current_category');
    }
    /**
     * Get HTML
     */
    protected function _toHtml()
    {
        if ($this->_viewModel->getEnable()) {
            // return '<div>Our widget code here</div>';
            return parent::_toHtml();
        } else {
            return '';
        }
    }
    /**
     * Get Collection
     */
    public function getCollection()
    {
        $model = $this->_objectManager->create(PowerReviews\ReviewDisplay\Model\ReviewDisplay::class);
        $collection = $model->getCollection();

        return $collection;
    }
}
