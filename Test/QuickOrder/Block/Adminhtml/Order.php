<?php
namespace Test\QuickOrder\Block\Adminhtml;

class Order extends \Magento\Backend\Block\Widget\Grid\Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_order';
        $this->_blockGroup = 'Test_QuickOrder';
        $this->_headerText = __('Orders');

    }
}
