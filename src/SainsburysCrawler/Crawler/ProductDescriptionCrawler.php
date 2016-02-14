<?php

namespace SainsburysCrawler\Crawler;


use SainsburysCrawler\Query\XPathQueryProvider;
use \DOMXPath;

class ProductDescriptionCrawler implements  ProductDescriptionProvider
{

    /**
     * @var DOMDocument
     */
    protected $domDocument;

    /**
     * @var XPathQueryProvider
     */
    protected $descriptionQuery;

    /**
     * Default constructor
     *
     * @param \DOMDocument $domDocument
     * @param XPathQueryProvider $descriptionQuery
     */
    public function __construct(\DOMDocument $domDocument, XPathQueryProvider $descriptionQuery) {
        $this->domDocument = $domDocument;
        $this->descriptionQuery = $descriptionQuery;
    }

    /**
     * Get a product descrition
     *
     * @return string
     */
    public function getDescription() {

        $xpath = new DOMXPath($this->domDocument);

        $nodeList = $xpath->query($this->descriptionQuery->xpathQuery());
        if ($nodeList->item(0)) {
            return $nodeList->item(0)->nodeValue;
        }
        return null;

    }
}