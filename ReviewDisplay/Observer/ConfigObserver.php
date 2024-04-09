<?php
namespace PowerReviews\ReviewDisplay\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\HTTP\Client\Curl;

class ConfigObserver implements ObserverInterface
{
    /**
    * @var \Psr\Log\LoggerInterface
    */
    protected $_logger;

    /**
    * @var \PowerReviews\ReviewDisplay\ViewModel\Product
    */
    protected $_viewModel;

  /**
   * @var \Magento\Framework\ObjectManagerInterface
   */
    protected $_objectManager;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;
    /**
     * @var Curl
     */
    protected $curl;
    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \PowerReviews\ReviewDisplay\ViewModel\Product $viewModel
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \PowerReviews\ReviewDisplay\ViewModel\Product $viewModel,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Curl $curl,
    ) {
         $this->_logger = $logger;
         $this->_viewModel = $viewModel;
         $this->_objectManager = $objectManager;
         $this->curl = $curl;
    }

    /**
     * This is the method that fires when the event runs.
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $this->_updateWrapperUrl();
    }
    /**
     * This is the method Update Wrapper URL.
     */
    private function _updateWrapperUrl()
    {
        $url = $this->_buildUrl();
        $this->_logger->info('SharedServicesWrapperUrl: ' . $url);

        $data = [
        "merchant_group_id" => $this->_viewModel->getMerchantGroupId(),
        "wrapper_url" => $url
        ];

        $dataJson = json_encode($data);

        //$ch = Curl();

        $apiUrl = 'https://portal.powerreviews.com/api/v1/merchant_group/wrapper_url';

        $this->curl->setOption(CURLOPT_URL, $apiUrl);
        $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->curl->setOption(CURLOPT_CUSTOMREQUEST, "PUT");

        $this->curl->setOption(CURLOPT_POSTFIELDS, http_build_query($data));

        $response = $this->curl->getBody();

        $this->_logger->info('SharedServicesWrapperUrlResponse: ', (array)json_decode($response, true));
        //$this->curl;

        //Curl($ch);
    }
    /**
     * This is the method Build URL.
     */
    private function _buildUrl()
    {
        $queryParams = [
        'pr_page_id' => '___PAGE_ID___',
        'pr_page_id_variant' => '___VARIANT___',
        'appName' => 'ryp'
        ];

        $url = $this->_getStoreUrl() . 'pages/write-a-review?' . http_build_query($queryParams);

        return $url;
    }
    /**
     * Get Store URL.
     */
    private function _getStoreUrl()
    {
        return $this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)->getStore()->getBaseUrl();
    }
}
