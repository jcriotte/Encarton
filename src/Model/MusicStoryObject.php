<?php

namespace App\Model;

/**
 * Music Story Object Class
 */
class MusicStoryObject extends MusicStoryApi
{

    /**
     * Object name
     * @var string 
     */
    private $_object_name;

    /**
     * Constructor
     * @param array $api_result Parsed result
     * @param string $name Object name
     * @param array $keys Consumer keys and token keys values
     */
    public function __construct($api_result, $name, $keys)
    {
        foreach ($keys as $key => $val) {
            $this->setKey($key, $val);
        }
        $this->_object_name = $name;
        foreach ($api_result as $key => $val) {
            if ($key != 'version' && $key != 'code') {
                $this->{$key} = $val;
            }
        }
    }

    /**
     * Router to getConnector method
     * @param string $method Method name
     * @param array $args Arguments
     * @return MusicStoryObjects
     */
    public function __call($method, $args)
    {
        if (strpos($method, 'get') !== false) {
            return $this->getConnector(str_replace('get', '', $method), count($args) ? $args[0] : array(), isset($args[1]) ? $args[1] : null, isset($args[2]) ? $args[2] : null);
        } else {
            $this->getError(__function__, self::E_UNKNOWN_METHOD);
        }
    }

    /**
     * Get connector result
     * @param string $connector Connector name
     * @param array $filters Search filters
     * @param int $page Page number (optional)
     * @param int $count Items per page (optional)
     * @return MusicStoryObjects
     */
    public function getConnector($connector, $filters, $page = false, $count = false)
    {
        if ($page) {
            $filters['page'] = (string) $page;
        }
        if ($count) {
            $filters['pageCount'] = (string) $count;
        }
        $url = $this->url_api . strtolower($this->_object_name) . '/' . $this->id . '/' . strtolower($connector);
        $url = $this->setFormat($url, 'json');
        $params = array_merge($filters, array('oauth_consumer_key' => $this->ConsumerKey, 'oauth_token' => $this->AccessToken));
        $signature = $this->sign($url, $params);
        $signed_url = $url . '?' . $this->normalize_params($filters, false) . '&oauth_consumer_key=' . $this->ConsumerKey . '&oauth_token=' . $this->AccessToken . '&oauth_signature=' . $this->rawurlencode_rfc3986($signature);
        $result = $this->request($signed_url, true);
        if ($connector == 'biographies') {
            $connector = 'biography';
        } else if (substr($connector, strlen($connector) - 1, 1) == 's') {
            $connector = substr($connector, 0, strlen($connector) - 1);
        }
        return $this->constructResult($result, $connector, true);
    }
}
