<?php
use SainsburysCrawler\Product\ProductCollection;
use SainsburysCrawler\Product\Product;

class ProductCollectionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var ProductCollection;
     */
    protected $productCollection;

    /**
     * @var Product
     */
    protected $productMock1;

    /**
     * @var Product
     */
    protected $productMock2;

    /**
     * prepare the test
     */
    public function setUp() {
        $this->productCollection = new ProductCollection();
        $this->productMock1 = $this->getMock('SainsburysCrawler\Product\Product');
        $this->productMock1->expects($this->any())->method('getPrice')->willReturn(1);

        $this->productMock2 = $this->getMock('SainsburysCrawler\Product\Product');
        $this->productMock2->expects($this->any())->method('getPrice')->willReturn(2);
    }

    /**
     * Test add method
     */
    public function testAddAndTotal() {
        $this->productCollection->add($this->productMock1);
        $this->productCollection->add($this->productMock2);

        $this->assertEquals($this->productCollection->get(0), $this->productMock1);
        $this->assertEquals($this->productCollection->get(1), $this->productMock2);
        $this->assertEquals($this->productCollection->getTotal(),3);
    }
}