<?php
namespace SainsburysCrawler\Content;

/**
 * OOOOOPS! nothing found
 *
 * Class DocumentNotFoundException
 * @package SainsburysCrawler\Content
 */
class DocumentNotFoundException extends \LogicException
{
    /**
     * @param string $source
     */
    public function __construct($source) {
        parent::__construct($source . " not found");
    }
}