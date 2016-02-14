<?php

namespace SainsburysCrawler\Product;


use SainsburysCrawler\Content\FileSizeProvider;
use SainsburysCrawler\Crawler\ProductDescriptionProvider;
use SainsburysCrawler\Crawler\ProductDetailProvider;
use SainsburysCrawler\Util\PriceFormatter;
use SainsburysCrawler\Util\SizeFormatter;

/**
 * Class ProductFactory
 * @package SainsburysCrawler\Product
 */
class ProductFactory
{
    /**
     * Build a product from crawlers and filesize provider
     *
     * @param ProductDetailProvider $detailProvider
     * @param ProductDescriptionProvider $descriptionProvider
     * @param FileSizeProvider $sizeProvider
     * @return Product
     */
    public function create(ProductDetailProvider $detailProvider, ProductDescriptionProvider $descriptionProvider, FileSizeProvider $sizeProvider) {
        $product = new Product();
        $product->setTitle($detailProvider->getTitle());
        $product->setPrice(PriceFormatter::format($detailProvider->getPrice()));
        $product->setLink($detailProvider->getLink());
        $product->setDescription($descriptionProvider->getDescription());
        $product->setFileSize(SizeFormatter::format($sizeProvider->getFileSize($detailProvider->getLink())));
        return $product;
    }
}