<?php

use SainsburysCrawler\Content\DomDocumentFactory;

class DomDocumentFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DomDocumentFactory;
     */
    protected $domDocumentFactory;

    protected $markupProviderMock;

    const MARKUP = '<html><body></body></html>';
    public function setUp() {
        $this->markupProviderMock = $this->getMockBuilder('SainsburysCrawler\Content\MarkupDownloader')
                                    ->disableOriginalConstructor()
                                    ->getMock();

        $this->markupProviderMock->method('getMarkup')->willReturn(self::MARKUP);

        $this->domDocumentFactory = new DomDocumentFactory($this->markupProviderMock);
    }

    /**
     * Test if the dom document created with factory is the one that we expect
     */
    public function testCreate() {
        $domDoc = $this->domDocumentFactory->create("thisIsASource");
        $docMarkup = $domDoc->C14N(true, false);
        $this->assertEquals($docMarkup, self::MARKUP);
    }
}