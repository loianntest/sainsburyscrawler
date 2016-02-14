<?php

use SainsburysCrawler\Content\FileSizeHolder;

class FileSizeHolderTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var FileSizeHolder
     */
    protected $fileSizeHolder;

    /**
     * Setup env
     */
    public function setUp() {
        $this->fileSizeHolder = new FileSizeHolder();
    }

    /**
     * test filesize setter and getter
     */
    public function testSetterGetter() {
        $this->fileSizeHolder->storeFileSize('key', 10);
        $val = $this->fileSizeHolder->getFileSize('key');
        $this->assertEquals($val, 10);
    }

    /**
     * if a key does not exists filesize should be null
     */
    public function testGetterWithNonExistentKey() {
        $val = $this->fileSizeHolder->getFileSize('unavailableFileSizeKey');
        $this->assertNull($val);
    }
}