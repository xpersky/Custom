<?php

namespace Custom\Weather\Block\Page\Footer;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Weather extends Template
{
    protected $_entryFactory;

    public function __construct(
        Context $context,
        array $data = []) 
    {
        parent::__construct($context, $data);
    }

    public function getHtml()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tablename = $resource->getTableName('weather_updates');
        $query = "SELECT * from $tablename order by timestamp DESC limit 1";
        $data = $connection->fetchAll($query);
        $html = '';
        $temp = $data[0]['temperature'];
        $html .= "<span style=\"margin-right:1rem;\">$temp &#x2103;</span>";
        $icon = $data[0]['icon'];
        $url = "http://openweathermap.org/img/w/" . $icon . ".png";
        $html .= "<span style=\"margin-right:1rem;\"><img style=\"width:20px;\" src=\"$url\" alt=\"icon\"></span>";
        $desc = $data[0]['description'];
        $html .= "<span style=\"margin-right:1rem;\">$desc</span>";
        $pressure = $data[0]['pressure'];
        $html .= "<span style=\"margin-right:1rem;\">$pressure hPa</span>";
        return $html;
    }

    public function getWeather()
    {
        return __($this->getHtml());
    }
}