<?php
use SainsburysCrawler\Util\SizeFormatter;

class SizeFormatterTest extends PHPUnit_Framework_TestCase
{

    public function testFormat() {
        $this->assertEquals(SizeFormatter::format(1024),'1Kb');
    }
}