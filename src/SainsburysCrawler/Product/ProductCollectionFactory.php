<?php
namespace SainsburysCrawler\Product;


use SainsburysCrawler\Content\DocumentNotFoundException;
use SainsburysCrawler\Content\DomDocumentFactory;
use SainsburysCrawler\Content\FileSizeProvider;
use SainsburysCrawler\Content\MarkupProvider;
use SainsburysCrawler\Crawler\ListCrawler;
use SainsburysCrawler\Query\ProductListQuery;
use SainsburysCrawler\Crawler\ProductDescriptionCrawler;
use SainsburysCrawler\Query\ProductDescriptionQuery;
use SainsburysCrawler\Crawler\ProductCrawler;
use SainsburysCrawler\Query\ProductAnchorQuery;
use SainsburysCrawler\Query\ProductPriceQuery;


class ProductCollectionFactory
{
    /**
     * @var FileSizeProvider
     */
    protected $fileSizeProvider;

    /**
     * @var MarkupProvider
     */
    protected $markupProvider;

    /**
     * @param FileSizeProvider $fileSizeProvider
     * @param MarkupProvider $markupProvider
     */
    public function __construct(FileSizeProvider $fileSizeProvider,  MarkupProvider $markupProvider) {
        $this->fileSizeProvider = $fileSizeProvider;
        $this->markupProvider = $markupProvider;
    }

    /**
     * Build a product collection from a markup source path
     *
     * @param $pageSource
     * @return ProductCollection
     * @throws DocumentNotFoundException
     */
    public function fromHtml($pageSource) {

        $productCollection = new ProductCollection();

        $domDocumentFactory = new DomDocumentFactory($this->markupProvider);
        $productFactory = new ProductFactory();

        //Build the dom of the list page
        //if any exception occurs here, let the main method handle it
         $productListPageDom = $domDocumentFactory->create($pageSource);

        $listCrawler = new ListCrawler(new ProductListQuery(), $productListPageDom);
        $productDomList = $listCrawler->productDomList() ;

        //Loop over the products dom elements
        foreach ($productDomList as $product) {

            $productCrawler = new ProductCrawler(
                $productListPageDom,
                $product,
                new ProductAnchorQuery(),
                new ProductPriceQuery()
            );

            try {
                //if a product source is unavailable, just go to the next product,
                //we don't want to stop the entire process due to a broken link
                $descriptionDom = $domDocumentFactory->create($productCrawler->getLink());
                $descriptionCrawler = new ProductDescriptionCrawler($descriptionDom, new ProductDescriptionQuery());

                //Build the product with the info provided by Crawlers and the file size provider
                $product = $productFactory->create($productCrawler, $descriptionCrawler, $this->fileSizeProvider);

                //add it to the collection
                $productCollection->add($product);
            } catch (DocumentNotFoundException $e) {
                //ignore exception
            }
        }

        return $productCollection;

    }
}