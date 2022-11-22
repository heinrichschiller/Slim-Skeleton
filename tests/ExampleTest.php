<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @covers ExampleTest
     */
    public function testFirstExample()
    {
        $this->assertEquals('My Slim-Skeleton', 'My Slim-Skeleton');
    }

    /**
     * @covers ExampleTest
     */
    public function testSecondExample()
    {
        $this->assertNotEquals('Official Slim-Skeleton', 'My Slim-Skeleton');
    }
}
