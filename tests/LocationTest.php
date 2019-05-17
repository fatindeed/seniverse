<?php

namespace SeniverseApi\Tests;

use SeniverseApi\ApiClient;
use SeniverseApi\Location;
use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testSearch()
    {
        $location = new Location;
        $results = $location->search('WTW3SJ5ZBJUY');
        $first = current($results);
        $this->assertObjectHasAttribute('id', $first);
        $this->assertObjectHasAttribute('name', $first);
        $this->assertObjectHasAttribute('country', $first);
        $this->assertObjectHasAttribute('path', $first);
        $this->assertObjectHasAttribute('timezone', $first);
    }
}