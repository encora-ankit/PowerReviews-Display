<?php
    /**
     * Rewrite Product ListProduct Block
     * @category    PowerReviews
     * @package     PowerReviews_ReviewDisplay
     * @author      Michal Walkowiak
     */

namespace PowerReviews\ReviewDisplay\Block;

class Beacon extends \Magento\Sales\Block\Order\Totals
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    /**
     * @var \Magento\Sales\Model\OrderFactory
     */
    protected $_orderFactory;
    /**
     * Session
     *
     * @param CheckoutSession $checkoutSession
     * @param CustomerSession $customerSession
     * @param OrderFactory $orderFactory
     * @param Context $context
     * @param Registry $registry
     * @param Data $data
     */
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->customerSession = $customerSession;
        $this->_orderFactory = $orderFactory;
        parent::__construct($context, $registry, $data);
    }
    /**
     * Options getOrder
     *
     * @return array
     */
    public function getOrder()
    {
        return $this->_orderFactory->create()
                    ->loadByIncrementId($this->checkoutSession->getLastRealOrderId());
    }
    /**
     * Options getCustomerId
     *
     * @return array
     */
    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }
}
