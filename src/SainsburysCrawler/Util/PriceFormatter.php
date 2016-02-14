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


namespace SainsburysCrawler\Util;


class PriceFormatter
{
    /**
     * Return a formatted price from
     *
     * @param $price
     * @return mixed
     */
    public static function format($price) {
        $tmp = str_replace('&pound','',$price);
        return str_replace('/unit','',$tmp);
    }
}