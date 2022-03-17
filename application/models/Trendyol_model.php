<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trendyol_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->trendyol_api_key = 'tbboict1EnjTar2Rjsai';
		$this->trendyol_api_secret = 'Z8FKXulkZLIoMiEAuDV5';
		$this->supplier_id = '289256';
    }
    
    /**
     * Connect Trendyol
     */
	public function connect($type = "POST", $url)
	{
		$params = NULL;
        $header = array(
            'Authorization: Basic ' . base64_encode($this->trendyol_api_key . ':' . $this->trendyol_api_secret) ,
            'Content-Type: application/json'
        );

        $url = 'https://api.trendyol.com/sapigw/'.$url;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($type == "POST")
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        $result = curl_exec($ch);
        return json_decode($result);
		//echo '<pre>'; print_r( $result );
	}

    /**
     * Add Trendyol Products
     */
    public function add_trendyol_products()
    {
        $url = 'suppliers/'.$this->supplier_id.'/products?approved=true&page=0&size=10';
        $products = $this->connect('get', $url);
        $content = $products->content;
        foreach($content as $item)
        {
            /*
            echo $item->pimCategoryId.'<br>';
            echo $item->categoryName.'<br>';
            echo $item->brand.'<br>';
            */
            $this->add_product($item);
        }
    }

    /**
     * add product
     */
    public function add_product($item)
    {
        if($this->check_product($item->id) == 0)
        {
            $data = array(
                'title' => $item->title,
                'slug' => str_slug($item->title),
                'stock' => $item->quantity,
                'price' => get_price($item->salePrice, 'database'),
                'description' => $item->description,
                'barcode' => $item->barcode,
                'code' => $item->id,
                'user_id' => $this->auth_user->id,
                'status' => 1,
                'is_promoted' => 0,
                'currency' => 'TRY',
                'listing_type' => 'sell_on_site',
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->db->insert('products', $data);
            //foreach($item->images as $image)
            $this->upload_product_image_by_link($item->images, $this->db->insert_id());
        }
        //print_r($item); exit;
    }

    /**
     * Check Product
     */
    public function check_product($code)
    {
        $this->db->where('code', $code);
		$query = $this->db->get('products');
		return $query->num_rows();
    }

    /**
     * Upload product image
     */
    public function upload_product_image_by_link($url, $product_id)
    {
        $i = 0;
        foreach($url as $value)
        {
            //echo $value.'<br>';
            // Resim Yolu(Kayıt yolu)
            $new_name = 'img_x500_' . generate_unique_id() . '.jpg';
            $img = 'uploads/images/'. $new_name;
            // Resmi Kaydet 
            $ch = curl_init($value->url);
            $fp = fopen($img, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);

            if($i == 0){
                $data['is_main'] = 1;
            }else{
                $data['is_main'] = 0;
            }
            $data['product_id'] = $product_id;
            $data['image_default'] = $new_name;
            $data['image_big'] = $new_name;
            $data['image_small'] = $new_name;
            $data['storage'] = 'local';
            $this->db->insert('images', $data);
            $i++;
        }
    }
}
