<?php

namespace Test\QuickOrder\Block\Adminhtml\Order\Renderer;

use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\DataObject;
use Magento\Framework\UrlInterface;

class Sku extends AbstractRenderer
{
    protected $urlBuilder;
    protected $productRepository;

    public function __construct(
        \Magento\Backend\Block\Context $context,
        UrlInterface $urlBuilder,
        ProductRepositoryInterface $productRepository,
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->productRepository = $productRepository;
        parent::__construct($context, $data);
    }

    public function render(DataObject $row)
    {
        try {
            $sku = $row->getData($this->getColumn()->getIndex());
            $product = $this->productRepository->get($sku);
            $productId = $product->getId();
            $url = $this->urlBuilder->getUrl('catalog/product/edit', ['id' =>  $productId]);
            return sprintf('<a href="%s" target="_blank">%s</a>', $url, $sku);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            return __('Product not found');
        } catch (\Exception $e) {
            // Log unexpected exceptions for further investigation
            $this->_logger->error(__('Error retrieving product: %1', $e->getMessage()));
            return __('Error loading product');
        }
    }
}
