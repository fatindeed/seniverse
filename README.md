# PHP Client for Seniverse API

![PHP Version](https://img.shields.io/packagist/php-v/fatindeed/seniverse-api.svg) [![Packagist Version](https://img.shields.io/packagist/v/fatindeed/seniverse-api.svg)](https://packagist.org/packages/fatindeed/seniverse-api) ![Downloads](https://img.shields.io/packagist/dm/fatindeed/seniverse-api.svg) ![License](https://img.shields.io/packagist/l/fatindeed/seniverse-api.svg) [![Build Status](https://travis-ci.org/fatindeed/seniverse-api.svg?branch=master)](https://travis-ci.org/fatindeed/seniverse-api)

## Seniverse 账号注册

[注册页面](https://www.seniverse.com/signup)

### 开始

```sh
composer require fatindeed/seniverse-api
```

配置环境变量（如.env）：

```bash
SENIVERSE_UID="your public key"
SENIVERSE_KEY="your private key"
```

或者也可以在使用时直接传入：

```php
$weather = new SeniverseApi\Weather([
    'uid' => 'your public key',
    'key' => 'your private key'
]);
```

[查看你的API密钥](https://docs.seniverse.com/api/start/key.html)

### 城市搜索

```php
$location = new SeniverseApi\Location;
$result = $location->search('WTW3SJ5ZBJUY');
```

### 天气实况

```php
$weather = new SeniverseApi\Weather;
$result = $weather->now('WTW3SJ5ZBJUY');
```

### 逐日天气预报

```php
$weather = new SeniverseApi\Weather;
$result = $weather->daily('WTW3SJ5ZBJUY');
```

### 生活指数

```php
$life = new SeniverseApi\Life;
$result = $life->suggestion('WTW3SJ5ZBJUY');
```

## FAQs

1.  [免费用户可以调用哪些数据](https://docs.seniverse.com/product/other/other.html#_1-%E5%85%8D%E8%B4%B9%E7%94%A8%E6%88%B7%E5%8F%AF%E4%BB%A5%E8%B0%83%E7%94%A8%E5%93%AA%E4%BA%9B%E6%95%B0%E6%8D%AE)
    - 国内 370 个地级市
    - 天气实况（2 项)
    - 3 天天气预报
    - 生活指数（基础 6 项)

2.  [城市列表](https://docs.seniverse.com/product/other/city.html)

## References

- [PHP Demo](https://github.com/seniverse/seniverse-api-demos/tree/master/php)