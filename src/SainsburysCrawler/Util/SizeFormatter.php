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


class SizeFormatter
{
    public static function format($size) {
        return  round($size/1024, 2).'Kb';
    }
}