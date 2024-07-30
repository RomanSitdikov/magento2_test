<?php
namespace Test\QuickOrder\Model;
class Order extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'test_quickorder_order';

    protected $_cacheTag = 'test_quickorder_order';

    protected $_eventPrefix = 'test_quickorder_order';

    protected function _construct()
    {
        $this->_init('Test\QuickOrder\Model\ResourceModel\Order');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
