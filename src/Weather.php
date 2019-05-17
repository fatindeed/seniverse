<?php

namespace SeniverseApi;

/**
 * @method void setUnit(string $unit)
 * @method array now(string $location)
 * @method array daily(string $location, int $start = 0, int $days = 3)
 */
class Weather extends ApiClient
{
    /**
     * 单位 unit
     * 
     * @var string
     * 
     * @see https://docs.seniverse.com/api/start/common.html#%E5%8D%95%E4%BD%8D-unit
     */
    private $unit = 'c';

    /**
     * 设置单位
     * 
     * @param  string $unit
     * @return void
     */
    public function setUnit(string $unit)
    {
        $this->unit = $unit;
    }

    /**
     * 天气实况
     * 
     * 获取指定城市的天气实况。
     * 付费用户可获取全部数据，免费用户只返回天气现象文字、代码和气温3项数据。
     * 注：中国城市暂不支持云量和露点温度。
     * 
     * @param  string $location
     * @return array
     * 
     * @see https://docs.seniverse.com/api/weather/now.html
     */
    public function now(string $location): array
    {
        return ApiClient::get('weather/now.json', [
            'location' => $location,
            'unit' => $this->unit
        ]);
    }

    /**
     * 逐日天气预报和昨日天气
     * 
     * 获取指定城市未来最多 15 天每天的白天和夜间预报，以及昨日的历史天气。
     * 付费用户可获取全部数据，免费用户只返回 3 天天气预报。
     * 
     * @param  string $location
     * @param  int  $start
     * @param  int  $days
     * @return array
     * 
     * @see https://docs.seniverse.com/api/weather/daily.html
     */
    public function daily(string $location, int $start = 0, int $days = 3): array
    {
        return ApiClient::get('weather/daily.json', [
            'location' => $location,
            'start' => $start,
            'days' => $days,
            'unit' => $this->unit
        ]);
    }
}