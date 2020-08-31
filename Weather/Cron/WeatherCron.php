<?php

namespace Custom\Weather\Cron;

use \Psr\Log\LoggerInterface;
use \Custom\Weather\Model\EntryFactory;
use \Magento\Framework\HTTP\Client\Curl;

class WeatherCron {

  protected $logger;

  protected $_entryFactory;

  protected $_curl;

  const BASE_URL = 'http://api.openweathermap.org/data/2.5/weather?q=Lublin,pl&appid=7f86606b65ec59096f883a9b092cbb90&lang=en&units=metric';

  public function __construct(
      LoggerInterface $logger,
      \Custom\Weather\Model\EntryFactory $entryFactory,
      \Magento\Framework\HTTP\Client\Curl $curl
      ) {

    $this->logger = $logger;
    $this->_entryFactory = $entryFactory;
    $this->_curl = $curl;

  }

  /**

    * Write to system.log

    *

    * @return void

  */

  public function execute() {
    
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

    $this->logger->info('Weather updated');

  }

}