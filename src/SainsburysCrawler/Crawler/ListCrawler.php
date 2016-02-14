<?php
namespace SainsburysCrawler\Crawler;

use \DOMDocument;
use \DOMXPath;
use SainsburysCrawler\Query\XPathQueryProvider;

/**
 * Scan a dom document finding any product div
 *
 * Class ListCrawler
 */
class ListCrawler implements ProductListProvider
{

    /**
     * @var DomDocument
     */
    protected $listDom;
    /**
     * @var XPathQueryProvider
     */
    protected $queryProvider;
    /**
     * Default constructor
     * @param DOMDocument $listDom the dom document to search products within
     */
    public function __construct(XPathQueryProvider $queryProvider,  $listDom) {
        $this->listDom = $listDom;
        $this->queryProvider = $queryProvider;
    }

    /**
     * Return an array of products dom nodes
     */
    public function productDomList() {
        $domXpath = new DOMXPath($this->listDom);
        return $domXpath->query($this->queryProvider->xpathQuery());
    }
}