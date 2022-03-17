<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model
{
	//add item
	public function add_brand()
	{
		$data = array(
			'lang_id'   => $this->input->post('lang_id', true),
			'title'     => $this->input->post('title', true),
            'created_at'=> date('Y-m-d H:i:s')
		);
        
        
		$this->load->model('upload_model');
		$temp_path = $this->upload_model->upload_temp_image('file');
		if (!empty($temp_path)) {
			$data["image"] = $this->upload_model->banner_image_upload($temp_path);
			$this->upload_model->delete_temp_image($temp_path);
		} else {
			$data["image"] = "";
		}
		return $this->db->insert('brands', $data);
	}

	//update brand
	public function update_brand($id)
	{
		$data = array(
			'lang_id' => $this->input->post('lang_id', true),
			'title' => $this->input->post('title', true),
			'show_homepage' => $this->input->post('show_homepage', true)
		);

		$item = $this->get_brand_item($id);
		if (!empty($item)) {
			$this->load->model('upload_model');
			$temp_path = $this->upload_model->upload_temp_image('file');
			if (!empty($temp_path)) {
				delete_file_from_server($item->image);
				$data["image"] = $this->upload_model->brand_image_upload($temp_path);
				$this->upload_model->delete_temp_image($temp_path);
			}
			$this->db->where('id', $id);
			return $this->db->update('brands', $data);
		}
		return false;
	}

	//get slider item
	public function get_brand_item($id)
	{
		$id = clean_number($id);
		$this->db->where('id', $id);
		$query = $this->db->get('brands');
		return $query->row();
	}

	//get slider items
	public function get_brands()
	{
		if(!empty($this->selected_lang->id)){
			$this->db->where('brands.lang_id', $this->selected_lang->id);
		}else{
			$this->db->where('brands.lang_id', 2);
		}
		$this->db->order_by('brands.id', 'DESC');
		$query = $this->db->get('brands');
		return $query->result();
	}

	/**
     * Get Brand Products
     */
    public function get_brand_products($brand_id)
    {
        $this->db->where('products.brand_id', $brand_id);
        $this->db->where('products.is_deleted', 0);
        $this->db->where('products.is_draft', 0);
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('products');
        $result = $query->result();
        return $result;
    }

	//delete slider item
	public function delete_brand($id)
	{
		$id = clean_number($id);
		$brand_item = $this->get_brand_item($id);
		if (!empty($brand_item)) {
            delete_file_from_server($brand_item->image);
            //delete_file_from_server($banner_item->image_small);
			$this->db->where('id', $id);
			return $this->db->delete('brands');
		}
		return false;
	}

}
