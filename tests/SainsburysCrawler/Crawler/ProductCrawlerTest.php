<?php

use SainsburysCrawler\Query\ProductAnchorQuery;
use SainsburysCrawler\Query\ProductPriceQuery;
use SainsburysCrawler\Crawler\ProductCrawler;

class ProductCrawlerTest extends PHPUnit_Framework_TestCase
{

    /** @var  DOMDOcument */
    protected $domDocument;

    /**
     * @var DOMElement
     */
    protected $productDom;
    /**
     * @var ProductAnchorQuery
     */
    protected $anchorQueryMock;

    /**
     * @var ProductPriceQuery
     */
    protected $priceQueryMock;

    /** @var  ProductCrawler */
    protected $productCrawler;

    public function setUp() {
        $this->domDocument = new DOMDocument();
        $this->domDocument->loadHTMLFile(__DIR__.'/../Fixtures/ProductDummyMarkup.html');

        $domXpath = new DOMXPath($this->domDocument);
        $nodes = $domXpath->query("//div[@class='product']");
        $this->productDom = $nodes->item(0);


        $this->anchorQueryMock = $this->getMock('SainsburysCrawler\Query\ProductAnchorQuery');
        $this->anchorQueryMock->expects($this->any())->method("xpathQuery")->willReturn("//a");

        $this->priceQueryMock = $this->getMock('SainsburysCrawler\Query\ProductPriceQuery');
        $this->priceQueryMock->expects($this->any())->method("xpathQuery")->willReturn("//p");

        $this->productCrawler = new ProductCrawler(
            $this->domDocument,
            $this->productDom,
            $this->anchorQueryMock,
            $this->priceQueryMock
        );
    }

    /**
     * Test crawler getters against dummy content
     */
    public function testCrawlerGetters() {
        $this->assertEquals($this->productCrawler->getTitle(), "title");
        $this->assertEquals($this->productCrawler->getLink(), "link");
        $this->assertEquals($this->productCrawler->getPrice(), "price");
    }
}