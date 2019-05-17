<?php

namespace SeniverseApi;

/**
 * @method array suggestion(string $location)
 */
class Life extends ApiClient
{
    /**
     * 生活指数
     * 
     * 获取指定城市的基本、交通、生活、运动、健康5大类共27项生活指数，仅支持中国城市。
     * 付费用户可获取全部数据; 免费用户只返回6项基本类生活指数，且只有brief，没有details。
     * 
     * @param  string $location
     * @return array
     * 
     * @see https://docs.seniverse.com/api/life/suggestion.html
     */
    public function suggestion(string $location): array
    {
        return ApiClient::get('life/suggestion.json', [
            'location' => $location
        ]);
    }
}