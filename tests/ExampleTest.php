<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testFirstExample()
    {
        $this->assertEquals('My Slim-Skeleton', 'My Slim-Skeleton');
    }

    public function testSecondExample()
    {
        $this->assertNotEquals('Official Slim-Skeleton', 'My Slim-Skeleton');
    }
}
