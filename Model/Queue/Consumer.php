<?php
declare(strict_types=1);
namespace Loop\MiniTracker\Model\Queue;

use Loop\MiniTracker\Api\Data\RequestInfoInterface;
use Loop\MiniTracker\Model\Logger\Logger;
use Loop\MiniTracker\Helper\Data;
use Loop\MiniTracker\Model\TrackingInfoFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\MessageQueue\PublisherInterface;

class Consumer
{
    /**
     * @var Logger
     */
    protected $logger;
    /**
     * @var Data
     */
    protected $data;
    /**
     * @var Curl
     */
    protected $curl;
    /**
     * @var TrackingInfoFactory
     */
    protected $trackingInfoFactory;

    /**
     * @var SerializerInterface
     */
    protected $serializer;
    /**
     * @var PublisherInterface
     */
    protected $publisher;

    public function __construct(
        Logger              $logger,
        Data                $data,
        Curl                $curl,
        TrackingInfoFactory $trackingInfoFactory,
        SerializerInterface $serializer,
        PublisherInterface $publisher
    )
    {
        $this->logger = $logger;
        $this->data = $data;
        $this->curl = $curl;
        $this->trackingInfoFactory = $trackingInfoFactory;
        $this->serializer = $serializer;
        $this->publisher = $publisher;
    }

    /**
     * code to send request to tracking services
     * @param RequestInfoInterface $requestInfo
     * @return void
     * @throws NotFoundException
     * @throws \Exception
     */
    public function process(RequestInfoInterface $requestInfo){
        try{
            if($this->data->isEnabled()){
                $this->logger->info("Procesing request for sku ". $requestInfo->getSku());
                $url = $this->data->getTrackingHost();
                $timeout = (int)$this->data->getCurlTimeout();
                $params = json_encode(["sku"=>$requestInfo->getSku(),"price" => $requestInfo->getPrice()]);
                $this->curl->addHeader("Content-Type", "application/json");
                $this->curl->setOption(CURLOPT_ENCODING, "");
                $this->curl->setOption(CURLOPT_MAXREDIRS, 10);
                $this->curl->setOption(CURLOPT_RETURNTRANSFER, true);
                $this->curl->setTimeout($timeout);
                $this->curl->post($url,$params);
                $response = json_decode($this->curl->getBody(),true);

                $this->logger->info("Response ".print_r($response,true));
                if($this->curl->getStatus() == 200 && array_key_exists("code",$response)){
                    $this->addNewTracking($response,$requestInfo);
                }else{
                    $this->logger->critical("Response for sku ".$requestInfo->getSku()." - ".$response["message"]);
                    // requeue message
                    $this->publisher->publish("tracking.request",$requestInfo);
                }
            }
        }catch (Exception $ex){
            $this->logger->critical("Exception while consuming tracking ".$ex->getMessage());
            throw new \Exception("Exception in tracking consumer".$ex->getMessage());
        }
    }

    /**
     * @param $result
     * @param RequestInfoInterface $requestInfo
     * @return void
     * @throws \Exception
     */
    public function addNewTracking($result, RequestInfoInterface $requestInfo){
        /** @var TrackingInfo $trackingInfo */
        $trackingInfo = $this->trackingInfoFactory->create();
        $trackingInfo->setSku($requestInfo->getSku());
        $trackingInfo->setQuoteId($requestInfo->getQuoteId());
        $trackingInfo->setTrackingMessage($result["message"]);
        $trackingInfo->setTrackingCode($result["code"]);
        $trackingInfo->setCreatedAt(date("Y-m-d H:i:s"));
        $trackingInfo->save();
    }
}