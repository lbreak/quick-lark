<?php

namespace lbreak\QuickLark\app;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use lbreak\QuickLark\helper\ArrayHelper;

class BaseApp
{
    protected $params;

    /**
     * @var \lbreak\QuickLark\Client
     */
    protected $client;

    /**
     * BaseApp constructor.
     * @param array $params
     * @throws Exception
     */
    public function __construct($params = [])
    {
        if (empty($params['app_id'])) {
            throw new Exception("app id is empty");
        }

        if (empty($params['app_secret'])) {
            throw new Exception("app secret is empty");
        }
        $this->params = ArrayHelper::extruct($params, ['app_id', 'app_secret']);

        $this->client = $params['client'] ?? null;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getBaseHeader(): array
    {
        if (($this->client->access_token_expire - time()) < 1800) {
            $this->client->getAccessToken();
        }
        return ['Content-Type' => 'application/json; charset=utf-8', 'Authorization' => 'Bearer ' . $this->client->access_token];
    }

    /**
     * @param $uri
     * @param $options
     * @return array
     * @throws Exception
     */
    public function httpPost($uri, array $options = []): array
    {
        $headers = $this->getBaseHeader();
        if (isset($options['headers'])) {
            $headers = array_merge($options['headers'], $headers);
        }
        $options['headers'] = $headers;
        $response = $this->client->http_client->post($uri, $options);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getReasonPhrase());
        }
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

    /**
     * @param $uri
     * @param $options
     * @return array
     * @throws Exception
     */
    public function httpGet($uri, array $options = []): array
    {
        $headers = $this->getBaseHeader();
        if (isset($options['headers'])) {
            $headers = array_merge($options['headers'], $headers);
        }
        $options['headers'] = $headers;
        $response = $this->client->http_client->get($uri, $options);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getReasonPhrase());
        }
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $options
     * @return array
     * @throws Exception|GuzzleException
     */
    public function httpRequest($method, $uri, array $options = []): array
    {
        $headers = $this->getBaseHeader();
        if (isset($options['headers'])) {
            $headers = array_merge($options['headers'], $headers);
        }
        $options['headers'] = $headers;
        $response = $this->client->http_client->request($method, $uri, $options);
        if ($response->getStatusCode() != 200) {
            throw new Exception($response->getReasonPhrase());
        }
        $body = $response->getBody()->getContents();
        return json_decode($body, true);
    }
}