<?php

namespace SeniverseApi;

/**
 * @method array search(string $q, int $limit = 50, int $offset = 50)
 */
class Location extends ApiClient
{
    /**
     * 城市搜索
     * 
     * 根据城市ID、中文、英文、拼音、IP、经纬度搜索匹配的城市。
     * 
     * @param  string $q
     * @param  int    $limit
     * @param  int    $offset
     * @return array
     * 
     * @see https://docs.seniverse.com/api/fct/search.html
     */
    public function search(string $q, int $limit = 50, int $offset = 50): array
    {
        return ApiClient::get('location/search.json', [
            'q' => $q,
            'limit' => $limit,
            'offset' => $offset
        ]);
    }
}