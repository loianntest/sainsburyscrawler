<?php

namespace SainsburysCrawler\Crawler;

/**
 * Every class which provide title and price of a product should
 * implement this interface
 *
 * Interface ProductDetailProvider
 * @package SainsburysCrawler\Crawler
 */
interface ProductDetailProvider
{
    /**
     * Provide the title of a product
     * @return string
     */
    public function getTitle();

    /**
     * Provide the price of a product
     * @return mixed
     */
    public function getPrice();

    /**
     * Provide the url of the description page
     * @return string
     */
    public function getLink();
}