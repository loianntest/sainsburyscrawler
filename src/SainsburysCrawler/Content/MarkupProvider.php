<?php

namespace SainsburysCrawler\Content;

/**
 * Provide a markup
 *
 * Interface MarkupProvider
 * @package SainsburysCrawler\Content
 */
interface MarkupProvider
{
    /**Get the markup from source
     *
     * @throws DocumentNotFoundException;
     * @return string
     */
    public function getMarkup($source);
}