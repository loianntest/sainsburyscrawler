<?php

use SainsburysCrawler\Content\FileSizeHolder;
use SainsburysCrawler\Content\DomDocumentFactory;
use SainsburysCrawler\Product\ProductFactory;
use SainsburysCrawler\Product\ProductCollectionFactory;
use SainsburysCrawler\Content\DocumentNotFoundException;

require __DIR__ . '/../vendor/autoload.php';

final class Application
{

    const PAGE_URL = 'http://hiring-tests.s3-website-eu-west-1.amazonaws.com/2015_Developer_Scrape/5_products.html';

    /**
     * @var FileSizeHolder service that holds the size of downloaded files
     */
    private $filesizeHolderService;

    /**
     * @var MarkupDownloader downloade the markup of a page and update data in fileSizeHolder
     */
    private $markupDownloader;

    /**
     * @var DomDocumentFactory build a dom document from a source (url or local path)
     */
    private $domDocumentFactory;

    /**
     * @var ProductFactory
     */
    private $productFactoryService;

    /**
     * Set up the application services
     */
    public function __construct() {
        $this->filesizeHolderService = new FileSizeHolder();
        $this->markupDownloader = new \SainsburysCrawler\Content\MarkupDownloader($this->filesizeHolderService);
    }

    /**
     * Main method of the crawler
     */
    public function main()
    {
        try {
            $productCollectionFactory = new ProductCollectionFactory($this->filesizeHolderService, $this->markupDownloader);
            $productCollection = $productCollectionFactory->fromHtml(self::PAGE_URL);
            echo json_encode($productCollection);
        } catch (DocumentNotFoundException $e) {
            echo "source not found";
        }

        //use json_serialize product and product collection method to get a json representation of the required output
    }
}


$app = new Application();
$app->main();