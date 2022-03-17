<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model
{
	//add item
	public function add_banner()
	{
		$data = array(
			'lang_id'   => $this->input->post('lang_id', true),
			'title'     => $this->input->post('title', true),
			'link'      => $this->input->post('link', true),
            'type'      => $this->input->post('type', true)
		);
        
        
		$this->load->model('upload_model');
		$temp_path = $this->upload_model->upload_temp_image('file');
		if (!empty($temp_path)) {
			$data["image"] = $this->upload_model->banner_image_upload($temp_path);
			$this->upload_model->delete_temp_image($temp_path);
		} else {
			$data["image"] = "";
		}
        

		return $this->db->insert('banners', $data);
	}

	//update banner
	public function update_banner($id)
	{
		$data = array(
			'lang_id' => $this->input->post('lang_id', true),
			'title' => $this->input->post('title', true),
			'link' => $this->input->post('link', true)
		);

		$item = $this->get_banner_item($id);
		if (!empty($item)) {
			$this->load->model('upload_model');
			$temp_path = $this->upload_model->upload_temp_image('file');
			if (!empty($temp_path)) {
				delete_file_from_server($item->image);
				$data["image"] = $this->upload_model->banner_image_upload($temp_path);
				$this->upload_model->delete_temp_image($temp_path);
			}
			$this->db->where('id', $id);
			return $this->db->update('banners', $data);
		}
		return false;
	}

	//get slider item
	public function get_banner_item($id)
	{
		$id = clean_number($id);
		$this->db->where('id', $id);
		$query = $this->db->get('banners');
		return $query->row();
	}

	//get slider items
	public function get_banner_items($id)
	{
		if(!empty($this->selected_lang->id)){
			$this->db->where('banners.lang_id', $this->selected_lang->id);
		}
		$this->db->where('banners.type', $id);
		$this->db->limit(12);
		$this->db->order_by('banners.id', 'DESC');
		$query = $this->db->get('banners');
		return $query->result();
	}

	//update slider settings
	public function update_slider_settings()
	{
		$data = array(
			'slider_status' => $this->input->post('slider_status', true),
			'slider_type' => $this->input->post('slider_type', true),
			'slider_effect' => $this->input->post('slider_effect', true)
		);

		$this->db->where('id', 1);
		return $this->db->update('general_settings', $data);
	}

	//delete slider item
	public function delete_banner($id)
	{
		$id = clean_number($id);
		$banner_item = $this->get_banner_item($id);
		if (!empty($banner_item)) {
			//delete from s3
			if ($slider_item->storage == "aws_s3") {
				$this->load->model("aws_model");
				$this->aws_model->delete_slider_object($slider_item->image);
			} else {
				delete_file_from_server($banner_item->image);
				//delete_file_from_server($banner_item->image_small);
			}
			$this->db->where('id', $id);
			return $this->db->delete('banners');
		}
		return false;
	}

}
