<?php

namespace SeniverseApi\Tests;

use SeniverseApi\ApiClient;
use SeniverseApi\Life;
use PHPUnit\Framework\TestCase;

class NoKeyTest extends TestCase
{
    private $life;

    public function testNoPublicKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Seniverse: public key not set');
        $life = new Life([
            'uid' => '',
            'key' => '',
            'language' => 'zh-Hans'
        ]);
        $results = $life->suggestion('WTW3SJ5ZBJUY');
    }

    public function testNoPrivateKey()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Seniverse: private key not set');
        $life = new Life;
        $life->setUid($_ENV['SENIVERSE_UID']);
        $results = $life->suggestion('WTW3SJ5ZBJUY');
    }

    public function testWithKey()
    {
        $life = new Life;
        $life->setKey($_ENV['SENIVERSE_KEY']);
        $results = $life->suggestion('WTW3SJ5ZBJUY');
        $this->assertIsArray($results);
    }
}