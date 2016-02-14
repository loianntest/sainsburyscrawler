<?php

namespace SainsburysCrawler\Crawler;
use \DOMDocument;
use \DOMXPath;
use \DOMElement;
use \DOMNode;
use SainsburysCrawler\Query\XPathQueryProvider;
use SainsburysCrawler\Util\PriceFormatter;

class ProductCrawler implements ProductDetailProvider
{

    /**
     * @var DOMDocument
     */
    protected $domDocument;

    /**
     * @var DOMElement
     */
    protected $productDomElement;

    /**
     * @var XPathQueryProvider
     */
    protected $productQuery;

    /**
     * @var DOMNode the anchor with title and link
     */
    protected $anchor = false;

    /**
     * Class default constructor
     *
     * @param DOMElement $productDomElement a product dom node
     * @param XPathQueryProvider $productAnchorQuery
     */
    public function __construct(DOMDocument $domDocument,
                                DOMElement $productDomElement,
                                XPathQueryProvider $productAnchorQuery,
                                XPathQueryProvider $pricePriceQuery) {

        $this->productDomElement = $productDomElement;
        $this->productAnchorQuery = $productAnchorQuery;
        $this->productPriceQuery = $pricePriceQuery;
        $this->domDocument = $domDocument;
    }

    /**
     * Lazy load of anchor
     * @return \DOMNodeList|the
     */
    protected function getAnchor() {
        $xpath = new DOMXPath($this->domDocument);
        if ($this->anchor === false) {
            $this->anchor = $xpath->query($this->productAnchorQuery->xpathQuery(), $this->productDomElement)->item(0);
        }
        return  $this->anchor;
    }

    /**
     * Provide the product title
     * @return string
     */
    public function getTitle() {
        if ($this->getAnchor() != null) {
            return trim($this->getAnchor()->nodeValue);
        }
        return null;
    }

    /**
     * Provide the product link
     */
    public function getLink()
    {
        if ($this->getAnchor() != null) {
            return trim($this->getAnchor()->attributes->getNamedItem('href')->nodeValue);
        }
        return null;
    }

    /**
     * Provide the product price
     */
    public function getPrice() {
        $xpath = new DOMXPath($this->domDocument);
        $priceP = $xpath->query($this->productPriceQuery->xpathQuery(),  $this->productDomElement)->item(0);
        if ($priceP) {
            //we can do it with xpath 2.0, now i'll go to the fast way
            // or we can define php function to execute with DOMXpath
            return trim($priceP->nodeValue);
        }
        return null;

    }
}