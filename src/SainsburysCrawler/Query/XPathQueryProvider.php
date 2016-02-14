<?php
namespace SainsburysCrawler\Query;


interface XPathQueryProvider
{
    /**
     * Provide an xpath query to be used in crawlers
     *
     * @return mixed
     */
    public function xpathQuery();

}