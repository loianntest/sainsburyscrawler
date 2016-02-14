<?php

use SainsburysCrawler\Query\ProductAnchorQuery;

/**
 * testing query is trivial, i include the following as example
 */

class ProductAnchorQueryTest extends PHPUnit_Framework_TestCase
{
    public function testXpathQuery() {
        $q = new ProductAnchorQuery();
        $this->assertEquals($q->xpathQuery(), './/div/div/h3/a');
    }

}