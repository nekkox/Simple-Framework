<?php

namespace App\Xml;

use App\Xml\HttpClient;
use App\Xml\ILogger;
use App\Xml\InvalidArgumentException;
use SimpleXMLElement;

class Transaction
{
    private ILogger $logger;
    private HttpClient $client;
    private array $data;
    private ?string $response = null;

    public function __construct(ILogger $logger, HttpClient $client, array $data)
    {
        $this->logger = $logger;
        $this->client = $client;
        $this->data = $data;
    }

    public function prepareXMLRequest(): string
    {
        if (!isset($this->data['userId'])) {
            throw new InvalidArgumentException('Missing userId');
        }
        if (!isset($this->data['items']) || !is_array($this->data['items'])) {
            throw new InvalidArgumentException('Missing items');
        }

        $requestXML = new SimpleXMLElement("<request></request>");
        var_dump($requestXML->asXML());
        $requestXML->addAttribute('userId', $this->data['userId']);
        var_dump($requestXML->children());
        $itemsXML = $requestXML->addChild('items');

var_dump($itemsXML->asXML());
        foreach ($this->data['items'] as $item) {

            $itemXML = $itemsXML->addChild('item');
            $itemXML->addAttribute('id', (string) $item['id']);
            $itemXML->addAttribute('quantity', (string) $item['quantity']);
        }

        return $requestXML->asXML();
    }

    public function getData(){
        return $this->data;
    }
    public function sendRequest(): ?string
    {
        $xmlRequest = $this->prepareXMLRequest();
        $this->client->setRequest($xmlRequest);
        $this->logger->log($xmlRequest, ILogger::PRIORITY_INFO);
        $this->response = $this->client->send();
        return $this->response;
    }

    public function wasSent(): bool
    {
        return $this->response !== null && $this->response !== '';
    }
}