<?php
use SainsburysCrawler\Product\ProductCollectionFactory;
use SainsburysCrawler\Content\FileSizeHolder;
use SainsburysCrawler\Content\MarkupDownloader;

class ProductColletcionFactoryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ProductCollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var FileSizeProvider
     */
    protected $fileSizeProviderMock;

    /**
     * @var MarkupDownloader
     */
    protected $downloaderMock;

    public function setUp() {

        $this->fileSizeProviderMock = $this->getMock("SainsburysCrawler\Content\FileSizeHolder");
        $this->fileSizeProviderMock->expects($this->any())->method("getFileSize")->willReturn("1024");

        $this->downloaderMock = $this->getMockBuilder("SainsburysCrawler\Content\MarkupDownloader")
                                ->disableOriginalConstructor()
                                ->getMock();
        $this->downloaderMock->expects($this->at(0))->method("getMarkup")->willReturn(file_get_contents((__DIR__.'/../Fixtures/collection_list.html')));
        $this->downloaderMock->expects($this->at(1))->method("getMarkup")->willReturn(file_get_contents((__DIR__.'/../Fixtures/collection_description.html')));



       $this->productCollectionFactory = new ProductCollectionFactory(
           $this->fileSizeProviderMock,
           $this->downloaderMock
        );
    }

    /**
     * test a sample collection factory
     */
    public function testCreate() {
        $pc = $this->productCollectionFactory->fromHtml('list');
        $product = $pc->get(0);
        $this->assertEquals($product->getTitle(),'title');
        $this->assertEquals($product->getDescription(),'Avocados');
        $this->assertEquals($product->getLink(),'link');
        $this->assertEquals($product->getPrice(),'3.50');
    }

    /**
     * test its json serialization
     */
    public function testJson() {
        $pc = $this->productCollectionFactory->fromHtml('list');
        $this->assertEquals(json_encode($pc),'{"results":[{"title":"title","unit_price":"3.50","description":"Avocados","size":"1Kb"}],"total":3.5}');
    }

}