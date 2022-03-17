<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Products
     */
    public function products()
    {
        //$products = $this->product_model->get_products();
        //echo json_encode($products);
        
        header("content-type: application/xml");
        $xml = new DOMDocument('1.0', 'UTF-8');

        $get_products = $this->product_model->get_products();
        $products = $xml->createElement('products');
        
        foreach ($get_products as $item)
        {
            $category = $this->category_model->get_category_by_lang($item->category_id, '2');
            $product = $xml->createElement('product');
            $id = $xml->createElement('id', $item->id);
            $title = $xml->createElement('title', $item->title);
            $slug = $xml->createElement('slug', $item->slug);
            $price = $xml->createElement('price', get_price($item->price, 'input'));
            $description = $xml->createElement('description', htmlspecialchars($item->description));
            $currency = $xml->createElement('currency', $item->currency);
            $category_id = $xml->createElement('category_id', $item->category_id);
            $category = $xml->createElement('category', $category->name);
            $stock = $xml->createElement('stock', $item->stock);
            $sku = $xml->createElement('sku', $item->sku);

            $product->appendChild($id);
            $product->appendChild($title);
            $product->appendChild($slug);
            $product->appendChild($price);
            $product->appendChild($description);
            $product->appendChild($currency);
            $product->appendChild($category_id);
            $product->appendChild($category);
            $product->appendChild($stock);
            $product->appendChild($sku);

            $products->appendChild($product);
        }

        $xml->appendChild($products);
        $xml->save('products.xml');
        echo $xml->saveXML();

    }

    /**
     * Products
     */
    public function product($id)
    {
        header('Content-Type: application/json;charset=utf-8');
        $product = $this->api_model->get_product_by_id($id); 
        echo json_encode($product);
    }

    /**
     * Get Products
     */
    public function get_products()
    {
        header('Content-Type: application/json;charset=utf-8');
        $products = $this->api_model->get_products();
        echo json_encode($products);
    }

    /**
     * Get Main Categories
     */
    public function get_parent_categories()
    {
        header('Content-Type: application/json;charset=utf-8');
        $products = $this->api_model->get_parent_categories();
        echo json_encode($products);
    }

    /**
     * Get Product Images
     */
    public function get_product_images($product_id)
    {
        header('Content-Type: application/json;charset=utf-8');
        $images = $this->api_model->get_product_images($product_id);
        echo json_encode($images);
    }

    /**
     * 
     */
    public function search_products($search)
    {
        header('Content-Type: application/json;charset=utf-8');
        $products = $this->api_model->search_products($search);
        echo json_encode($products);
    }
}
