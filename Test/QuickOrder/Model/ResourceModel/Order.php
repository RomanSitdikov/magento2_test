<?php
namespace Test\QuickOrder\Model\ResourceModel;


class Order extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('test_quickorder', 'order_id');
    }

}
