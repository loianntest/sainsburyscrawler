<?php

namespace SainsburysCrawler\Crawler;

/**
 * Interface ProductDescriptionProvider
 * @package SainsburysCrawler\Crawler
 */
interface ProductDescriptionProvider
{
    /**
     * Get a product descrition
     *
     * @return string
     */
    public function getDescription();
}