<?php
namespace Test\QuickOrder\Controller\Index;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Test\QuickOrder\Model\OrderFactory;

class Save extends Action
{
    protected $orderFactory;
    protected $resultJsonFactory;
    protected $productRepository;

    public function __construct(
        Context $context,
        OrderFactory $orderFactory,
        JsonFactory $resultJsonFactory,
        ProductRepositoryInterface $productRepository
    ) {
        $this->orderFactory = $orderFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->productRepository = $productRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $params = $this->getRequest()->getParams();
        if (isset($params['phone']) && isset($params['sku'])) {
            try {
                $product = $this->productRepository->get($params['sku']);
                if(!$product) {
                    return $resultJson->setData(['error' => 1, 'message' => __('Product not found by SKU')]);
                }
                $order = $this->orderFactory->create();
                $order->setData([
                    'phone' => $params['phone'],
                    'sku' => $params['sku'],
                ]);
                $order->save();

                return $resultJson->setData(['success' => 1, 'message' => __('Order has been saved successfully.')]);
            } catch (\Exception $e) {
                return $resultJson->setData(['error' => 1, 'message' => __('An error occurred while saving the order.'.$e->getMessage())]);
            }
        }

        return $resultJson->setData(['message' => __('Invalid data provided.')]);
    }
}
