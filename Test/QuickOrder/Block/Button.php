<?php
namespace Test\QuickOrder\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;

class Button extends Template
{
    protected $productRepository;
    protected $registry;

    public function __construct(
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        Registry $registry,
        array $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    public function getProductId(){
        return $this->getProduct()->getId();
    }

    public function getProductSku()
    {
        $product = $this->getProduct();
        return $product ? $product->getSku() : null;
    }

    public function getProduct()
    {
        return $this->registry->registry('current_product');
    }
}
