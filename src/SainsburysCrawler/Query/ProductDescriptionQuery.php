<?php
/*
 *
 * This file is part of the SainsburysCrawler package.
 *
 * (c) Lorenzo Iannone <lorenzo@fluentphp.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */


namespace SainsburysCrawler\Query;


class ProductDescriptionQuery implements XPathQueryProvider
{

    /**
     * Provide an xpath query to be used in crawlers
     *
     * @return mixed
     */
    public function xpathQuery()
    {
        return "//div[@class='productText']//p";

    }
}