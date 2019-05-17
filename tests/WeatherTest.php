<?php

namespace SeniverseApi\Tests;

use SeniverseApi\ApiClient;
use SeniverseApi\Weather;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function testNow()
    {
        $weather = new Weather;
        $results = $weather->now('WTW3SJ5ZBJUY');
        $first = current($results);
        $this->assertObjectHasAttribute('location', $first);
        $this->assertObjectHasAttribute('now', $first);
        $this->assertObjectHasAttribute('last_update', $first);
    }

    public function testDaily()
    {
        $weather = new Weather;
        $weather->setUnit('f');
        $results = $weather->daily('WTW3SJ5ZBJUY');
        $first = current($results);
        $this->assertObjectHasAttribute('location', $first);
        $this->assertObjectHasAttribute('daily', $first);
        $this->assertObjectHasAttribute('last_update', $first);
        $this->assertCount(3, $first->daily);
        $today = current($first->daily);
        $this->assertEquals($today->date, date('Y-m-d'));
    }
}