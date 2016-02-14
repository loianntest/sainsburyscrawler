<?php
namespace SainsburysCrawler\Content;
use DOMDocument;

/**
 * Class DomDocumentFactory
 * @package SainsburysCrawler\Content
 */
class DomDocumentFactory
{

    /**
     * Default constructor
     * @param MarkupProvider $markupProvider
     */
    public function __construct(MarkupProvider $markupProvider) {
        $this->markupProvider = $markupProvider;
    }

    /**
     * Build a DOMDocument from a markup provider
     *
     * @param $source
     * @return DOMDocument
     * @throws DocumentNotFoundException;
     */
    public function create($source) {
        $markup = $this->markupProvider->getMarkup($source);
        $domDocument = new DOMDocument();
        $domDocument->formatOutput=false;
        $domDocument->preserveWhiteSpace=false;
        @$domDocument->loadHTML($markup, LIBXML_HTML_NODEFDTD);
        return $domDocument;
    }
}