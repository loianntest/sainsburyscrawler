<?php
use SainsburysCrawler\Crawler\ProductDescriptionCrawler;

class ProductDescriptionCrawlerTest extends  PHPUnit_Framework_TestCase
{

    /**
     * @var DOMDocument
     */
    protected $domDocument;

    /**
     * @var ProductDescriptionCrawler
     */
    protected $productDescriptionCrawler;

    /**
     * @var ProductDescriptionQuery;
     */
    protected $descriptionQueryMock;

    /**
     * Setup vars and mock
     */
    public function setUp() {
        $this->domDocument = new DOMDocument();
        $this->domDocument->loadHTMLFile(__DIR__.'/../Fixtures/ProductDescriptionDummyMarkup.html');

        $this->descriptionQueryMock = $this->getMock('SainsburysCrawler\Query\ProductDescriptionQuery');
        $this->descriptionQueryMock->expects($this->any())->method("xpathQuery")->willReturn("//p");

        $this->productDescriptionCrawler = new ProductDescriptionCrawler(
            $this->domDocument,
            $this->descriptionQueryMock
        );
    }

    /**
     * test get description method
     */
    public function testGetter() {
        $this->assertEquals($this->productDescriptionCrawler->getDescription(), 'description');
    }
}