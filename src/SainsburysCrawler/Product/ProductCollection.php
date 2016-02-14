<?php

namespace SainsburysCrawler\Product;

/**
 * Class ProductCollection
 * @package SainsburysCrawler\Product
 */
class ProductCollection implements \JsonSerializable
{
    protected $total;

    protected $products;

    public function __construct() {
        $this->total = 0;
        $this->products = array();
    }

    /**
     * Add a product to collection and update the total
     * @param Product $product
     */
    public function add(Product $product) {
        $this->total += $product->getPrice();
        $this->products[] = $product;
    }

    /**
     * @param $item
     * @return null|Product
     */
    public function get($item) {
        if (isset($this->products[$item])) {
            return $this->products[$item];
        }
        return null;
    }

    /**
     * total getter
     */
    public function getTotal() {
        return $this->total;
    }
    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */function jsonSerialize()
    {
        return array(
            'results'=>$this->products,
            'total'=>$this->total
        );
    }
}