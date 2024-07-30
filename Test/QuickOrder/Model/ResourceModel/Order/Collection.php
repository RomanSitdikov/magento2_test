<?php
namespace Test\QuickOrder\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'order_id';
	protected $_eventPrefix = 'test_quickorder_order_collection';
	protected $_eventObject = 'order_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init(\Test\QuickOrder\Model\Order::class, \Test\QuickOrder\Model\ResourceModel\Order::class);
	}

}
