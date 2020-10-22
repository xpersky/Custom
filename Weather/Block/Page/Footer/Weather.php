<?php

namespace Custom\Weather\Block\Page\Footer;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Weather extends Template
{
    protected $_entryFactory;
    protected $WeatherData;

    public function __construct(
        Context $context,
        array $data = []) 
    {
        parent::__construct($context, $data);
        $this->getData();
    }
    
    public function getData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tablename = $resource->getTableName('weather_updates');
        $query = "SELECT * from $tablename order by timestamp DESC limit 1";
        $data = $connection->fetchAll($query);
        $this->WeatherData = $data[0];
    }

    public function getTemperature()
    {
        return __($this->WeatherData['temperature']);
    }
    
    public function getIcon()
    {
        return __('http://openweathermap.org/img/w/'.$this->WeatherData['icon'].'.png');
    }
    
    public function getDescription()
    {
        return __($this->WeatherData['description']);
    }
    
    public function getPressure()
    {
        return __($this->WeatherData['pressure']);
    }
}
