<?php
namespace Tests;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function test_example_test()
    {
        $res = 'ok';
        $this->assertEquals('ok', $res);
    }
}
