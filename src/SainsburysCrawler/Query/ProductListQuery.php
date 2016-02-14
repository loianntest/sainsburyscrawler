<?php
namespace SainsburysCrawler\Query;

/**
 * Class ProductListQuery
 * Provide a query to get the dom product list
 * @package SainsburysCrawler\Query
 */
class ProductListQuery implements XPathQueryProvider
{

    /**
     * Provide an xpath query to be used in crawlers
     *
     * @return mixed
     */
    public function xpathQuery()
    {
        return "//div[@class='product ']";
    }
}