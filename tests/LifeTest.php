<?php

namespace SeniverseApi\Tests;

use SeniverseApi\ApiClient;
use SeniverseApi\Life;
use PHPUnit\Framework\TestCase;

class LifeTest extends TestCase
{
    public function testSuggestion()
    {
        $life = new Life;
        $results = $life->suggestion('WTW3SJ5ZBJUY');
        $first = current($results);
        $this->assertObjectHasAttribute('location', $first);
        $this->assertObjectHasAttribute('suggestion', $first);
        $this->assertObjectHasAttribute('last_update', $first);
    }
}