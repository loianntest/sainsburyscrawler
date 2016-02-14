<?php
namespace SainsburysCrawler\Crawler;
use \DOMNodeList;

/**
 * Every class that provide a DOMNodeList
 * representing the product list should implement
 * this class
 *
 * Interface ProductListProvider
 * @package SainsburysCrawler\Crawler
 */
interface ProductListProvider
{
    /**
     * Return a DOMNodeList with the products dom nodes
     *
     * @return  DOMNodeList
     */
    public function productDomList();
}