<?php
namespace PowerReviews\ReviewDisplay\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class SalesOrderPlaceAfter implements ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * @var \Magento\Framework\App\ResponseFactory
     */
    protected $_responseFactory;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $_url;
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $curlClient;
    /**
     * @param \PowerReviews\ReviewDisplay\ViewModel\Product $viewModel
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param \Magento\Framework\App\ResponseFactory $responseFactory
     * @param \Magento\Framework\UrlInterface $url
     * @param \Magento\Framework\HTTP\Client\Curl $curl
     */
    public function __construct(
        \PowerReviews\ReviewDisplay\ViewModel\Product $viewModel,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Framework\HTTP\Client\Curl $curl
    ) {
        $this->_viewModel = $viewModel;
        $this->_objectManager = $objectManager;
        $this->_responseFactory = $responseFactory;
        $this->_url = $url;
        $this->curlClient = $curl;
    }

    /**
     * This is the method that fires when the event runs.
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();

        $this->_makeBeaconRequest($order);

        $event = $observer->getEvent();
        $redirectUrl= $this->_url->getUrl('checkout/onepage/success/');
        $this->_responseFactory->create()->setRedirect($redirectUrl)->sendResponse();
    }
    /**
     * This is the method that fires when the event runs.
     *
     * @param Order $order
     */
    private function _makeBeaconRequest($order)
    {
        $url = 'http://t.powerreviews.com/t/v1.gif';

            $helper = $this->_viewModel;

            $ts = time();

            $orderData = $order->getData();
            $orderItems = $order->getAllVisibleItems();

            $params = [
            'e' => 'c',
                'id' => $ts,
                't' => $ts,
                'uid' => $orderData['customer_email'],
            'mgid' => $helper->getMerchantGroupId(),
            'mid' => $helper->getMerchantId(),
            'mgid' => $helper->getMerchantGroupId(),
            'p' => $this->_getStoreUrl(),
            'l' => $helper->getLocale(),
            'oid' => $orderData['increment_id'],
            'ue' => $orderData['customer_email'],
            'uf' => $orderData['customer_firstname'],
            'ul' => $orderData['customer_lastname'],
            'os' => $orderData['base_subtotal'],
            'on' => $orderData['total_qty_ordered'],
            'oi' => $this->_getOrderItemList($orderItems)
            ];

            $paramString = http_build_query($params);

             //open connection
            $ch = curlClient();

            //set the url, number of POST vars, POST data
            curlClient($ch, CURLOPT_URL, $url . '?' . $paramString);
            curlClient($ch, CURLOPT_FOLLOWLOCATION, true); // for redirects

            //execute beacon request
            $result = curlClient($ch);

            $lastUrl = curlClient($ch, CURLINFO_EFFECTIVE_URL); // get last effective URL

            //close connection
            curlClient($ch);
    }
    /**
     * Get Store Url
     */
    private function _getStoreUrl()
    {
        return $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface:class')->getStore()->getBaseUrl();
    }
    /**
     * Get Order Items List
     *
     * @param OrderItems $orderItems
     */
    private function _getOrderItemList($orderItems)
    {
        $stringifiedItems = [];

        foreach ($orderItems as $item) {
            $productId = $item->getProductId();
            $itemData = $item->getData();

            $stringifiedItems[] = implode(',', [
                $productId,
                $itemData['quote_item_id'],
                $itemData['name'],
                $itemData['qty_ordered'],
                $itemData['price']
            ]);
        }

        return implode(';', $stringifiedItems);
    }
}
