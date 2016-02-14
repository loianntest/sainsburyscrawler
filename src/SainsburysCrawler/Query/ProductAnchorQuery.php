<?php
namespace SainsburysCrawler\Query;


class ProductAnchorQuery implements XPathQueryProvider
{

    /**
     * Provide an xpath query to be used in crawlers
     * who want to get a product title
     *
     * @return mixed
     */
    public function xpathQuery()
    {
        return './/div/div/h3/a';
    }
}