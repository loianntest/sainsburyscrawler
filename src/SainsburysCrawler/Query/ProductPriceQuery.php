<?php
namespace SainsburysCrawler\Query;


class ProductPriceQuery implements XPathQueryProvider
{

    /**
     * Provide an xpath query to be used in crawlers
     * that provide the product price
     *
     * @return mixed
     */
    public function xpathQuery()
    {
        return ".//p[@class='pricePerUnit']";
    }
}