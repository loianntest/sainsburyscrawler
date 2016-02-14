<?php

use SainsburysCrawler\Content\MarkupDownloader;
use SainsburysCrawler\Content\FileSizeHolder;


class MarkupDowloaderTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var MarkupDownloader
     */
    protected $markupDownloader;

    /**
     * @var FileSizeHolder
     */
    protected $fileSizeHolderMock;

    protected $source;

    /**
     * Setup mocks and variables
     */
    public function setUp() {
        $this->fileSizeHolderMock =  $this->getMock('SainsburysCrawler\Content\FileSizeHolder', ['storeFileSize']);
        $this->markupDownloader = new MarkupDownloader($this->fileSizeHolderMock);
        $this->source = __DIR__ . '/../Fixtures/dummycontent.txt';
    }

    /**
     * Test result of getMarkup
     */
    public function testGetMarkupWithResult() {

        //was the storeFileSize called with right par
        //ameters?
        $this->fileSizeHolderMock->expects($this->once())->method('storeFileSize')->with($this->source, strlen('dummy'));

        //Is it the right content?
        $content = $this->markupDownloader->getMarkup($this->source);
        $this->assertEquals($content, 'dummy');
    }

    /**
    * @expectedException SainsburysCrawler\Content\DocumentNotFoundException
    */
    public function testGetMarkupSourceNotFound() {
        $content = $this->markupDownloader->getMarkup('unavailableSource');
    }
}