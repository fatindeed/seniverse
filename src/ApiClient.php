<?php

namespace SeniverseApi;

use GuzzleHttp\Client;

/**
 * @method static void config(array $config)
 * @method static void setUid(string $key)
 * @method static void setKey(string $key)
 * @method static array get(string $path, array $query_data)
 */
class ApiClient
{
    /**
     * Guzzle Http Client
     * 
     * @var \GuzzleHttp\Client
     */
    private static $_client;

    /**
     * Config data
     * 
     * @var array
     */
    private static $config = [];

    /**
     * Construct
     * 
     * @param  array $config
     * @return void
     */
    public function __construct(array $config = [])
    {
        $this->config($config);
    }

    /**
     * Set config
     * 
     * @param  array $config
     * @return void
     */
    public function config(array $config): void
    {
        if (count($config) > 0) {
            self::$config = array_merge(self::$config, $config);
        } else {
            if (!isset(self::$config['uid']) && isset($_ENV['SENIVERSE_UID'])) {
                self::$config['uid'] = $_ENV['SENIVERSE_UID'];
            }
            if (!isset(self::$config['key']) && isset($_ENV['SENIVERSE_KEY'])) {
                self::$config['key'] = $_ENV['SENIVERSE_KEY'];
            }
        }
    }

    /**
     * Set public key
     * 
     * @param  string $key
     * @return void
     */
    public function setUid(string $key): void
    {
        self::$config['uid'] = $key;
    }

    /**
     * Set private key
     * 
     * @param  string $key
     * @return void
     */
    public function setKey(string $key): void
    {
        self::$config['key'] = $key;
    }

    /**
     * Get request
     * 
     * @param array $config
     * @return \stdClass
     */
    protected function get(string $path, array $query_data): array
    {
        if (isset(self::$config['language'])) {
            $query_data['language'] = self::$config['language'];
        }
        $sig_data = self::sign();
        $response = self::http()->get($path, [
            'query' => array_merge($query_data, $sig_data)
        ]);
        $data = json_decode((string) $response->getBody());
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Failed to parse JSON from response'); // @codeCoverageIgnore
        }
        if (!isset($data->results)) {
            throw new \RuntimeException('No result in JSON response'); // @codeCoverageIgnore
        }
        return $data->results;
    }

    private static function http(): Client
    {
        if (!isset(self::$_client)) {
            self::$_client = new Client([
                'base_uri' => 'https://api.seniverse.com/v3/',
                'connect_timeout' => 5,
                'timeout' => 10
            ]);
        }
        return self::$_client;
    }

    private static function sign(): array
    {
        if (empty(self::$config['uid'])) {
            throw new \InvalidArgumentException('Seniverse: public key not set');
        }
        if (empty(self::$config['key'])) {
            throw new \InvalidArgumentException('Seniverse: private key not set');
        }
        $sig_data = [
            'ts' => time(),
            'ttl' => 30,
            'uid' => self::$config['uid']
        ];
        $sig_data['sig'] = base64_encode(hash_hmac('sha1', http_build_query($sig_data), self::$config['key'], true));
        return $sig_data;
    }
}