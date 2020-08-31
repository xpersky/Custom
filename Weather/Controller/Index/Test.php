<?php

namespace Custom\Weather\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_curl;
    protected $_entryFactory;
    const BASE_URL = 'http://api.openweathermap.org/data/2.5/weather?q=Lublin,pl&appid=7f86606b65ec59096f883a9b092cbb90&lang=pl&units=metric';

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Custom\Weather\Model\EntryFactory $entryFactory)
	{
        $this->_pageFactory = $pageFactory;
        $this->_curl = $curl;
        $this->_entryFactory = $entryFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $tablename = $resource->getTableName('weather_updates');
        $query = "SELECT * from $tablename order by timestamp DESC limit 1";
        $data = $connection->fetchAll($query);
        $html = '';
        $temp = $data[0]['temperature'];
        $html .= "<span>$temp &#x2103;</span>";
        $icon = $data[0]['icon'];
        $url = "http://openweathermap.org/img/w/" . $icon . ".png";
        $html .= "<span><img src=\"$url\" alt=\"icon\"></span>";
        $desc = $data[0]['description'];
        $html .= "<span>$desc</span>";
        $pressure = $data[0]['pressure'];
        $html .= "<span>$pressure hPa</span>";
        echo $html;
		exit;
	}
}