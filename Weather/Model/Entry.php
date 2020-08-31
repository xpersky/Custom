<?php

namespace Custom\Weather\Model;

class Entry extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'weather_updates';

	protected $_cacheTag = 'weather_updates';

	protected $_eventPrefix = 'weather_updates';

	protected function _construct()
	{
		$this->_init('Custom\Weather\Model\ResourceModel\Entry');
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