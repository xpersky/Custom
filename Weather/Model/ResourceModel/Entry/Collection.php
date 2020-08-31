<?php
namespace Custom\Weather\Model\ResourceModel\Entry;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'weather_updates_collection';
	protected $_eventObject = 'entry_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Custom\Weather\Model\Entry', 'Custom\Weather\Model\ResourceModel\Entry');
	}

}
