<?php
use \SainsburysCrawler\Product\Product;

class ProductTest extends PHPUnit_Framework_TestCase
{
    /**
     * test setters and getters
     */
    public function testGettersSetters() {
        $product = new Product();
        $product->setFileSize(1);
        $product->setPrice('price');
        $product->setLink('link');
        $product->setDescription('description');
        $product->setTitle('title');

        $this->assertEquals($product->getTitle(),'title');
        $this->assertEquals($product->getDescription(),'description');
        $this->assertEquals($product->getLink(),'link');
        $this->assertEquals($product->getPrice(),'price');
        $this->assertEquals($product->getFileSize(),1);
    }
}