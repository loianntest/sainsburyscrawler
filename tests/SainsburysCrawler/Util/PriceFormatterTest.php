<?php
use SainsburysCrawler\Util\PriceFormatter;

class PriceFormatterTest extends PHPUnit_Framework_TestCase
{
    public function testFormat() {
        $this->assertEquals(PriceFormatter::format('&pound1/unit'),'1');
    }

}