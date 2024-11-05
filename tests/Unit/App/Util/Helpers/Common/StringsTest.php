<?php

namespace App\Tests\Unit\App\Util\Helpers\Common;

use PHPUnit\Framework\TestCase;

class StringsTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSortingStrings(): void
    {
        $array = [
            'abc',
            'aaa',
        ];

        $result = sortAlphabetically($array);
        $this->assertNotEmpty($result);
        $this->assertNotEquals(
            array_values($array),
            array_values($result)
        );

        $expected = [
            'aaa',
            'abc',
        ];
        $this->assertEquals(
            array_values($expected),
            array_values($result)
        );
    }
}


