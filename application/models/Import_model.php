<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
class Import_model extends CI_Model
{
    public function importData($data)
    {
        $res = $this->db->insert_batch('products',$data);
        if($res){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function import_data($data)
    {
        $data = array(
            'title' => $data['title'],
            'slug' => str_slug($data['title']),
            'description' => $data['description'],
            'price' => get_price($data['price'], 'database'),
            'currency' => $data['currency'],
            'category_id' => $this->input->post('thirdcategory_id', true),
            'discount_rate' => 0,
            'vat_rate' => 0,
            'description' => $data['description'],
            'country_id' => 0,
            'state_id' => 0,
            'city_id' => 0,
            'user_id' => $this->auth_user->id,
            'status' => 1,
            'is_promoted' => 0,
            'promote_plan' => "none",
            'promote_day' => 0,
            'visibility' => 1,
            'rating' => 0,
            'hit' => 0,
            'stock' => $data['stock'],
            'shipping_cost' => 0,
            'shipping_cost_additional' => 0,
            'is_deleted' => 0,
            'is_draft' => 0,
            'is_free_product' => 0,
            'barcode' => $data['barcode'],
            'sku' => $data['code'],
            'image' => $data['image'],
            'created_at' => date('Y-m-d H:i:s')
        );
        //set category id
        /*$data['category_id'] = 0;
        $post_inputs = $this->input->post();
        foreach ($post_inputs as $key => $value) {
            if (strpos($key, 'category_id_') !== false) {
                $data['category_id'] = $value;
            }
        }*/
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }
}
?>