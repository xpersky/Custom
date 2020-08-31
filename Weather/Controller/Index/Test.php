<?php

namespace Custom\Weather\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_curl;
    protected $_entryFactory;
    const BASE_URL = 'http://api.openweathermap.org/data/2.5/weather?q=Lublin,pl&appid=7f86606b65ec59096f883a9b092cbb90&lang=en&units=metric';

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

        $url = self::BASE_URL;
        $this->_curl->get($url);

        $response = $this->_curl->getBody();
        $response = json_decode($response);

        $model = $this->_entryFactory->create();
        $model->addData([
            'description' => $response->weather[0]->description,
            'icon' => $response->weather[0]->icon,
            'temperature' => $response->main->temp,
            'pressure' => $response->main->pressure,
            'timestamp' => time()
        ]);
        $model->save();
        echo 'ok';
		exit;
	}
}