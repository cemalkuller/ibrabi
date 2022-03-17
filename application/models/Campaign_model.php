<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
    //Add Campaign
    public function add_campaign()
    {
        $this->load->model('upload_model');
        $temp_path = $this->upload_model->upload_temp_image('file');
        if (!empty($temp_path))
        {
            $data["image_default"] = $this->upload_model->campaign_image_default_upload($temp_path);
            $campaign['title'] = $this->input->post('title', true);
            $campaign['image'] = $data["image_default"];
            $campaign["created_at"] = date('Y-m-d H:i:s');
            return $this->db->insert('campaigns', $campaign);
            $this->upload_model->delete_temp_image($temp_path);
        }
    }

    //Ppdate Campaign
    public function update_campaign($id)
    {
        $this->load->model('upload_model');
        $temp_path = $this->upload_model->upload_temp_image('file');
        if (!empty($temp_path))
        {
            $data["image_default"] = $this->upload_model->campaign_image_default_upload($temp_path);
            $campaign['image'] = $data["image_default"];
            $this->upload_model->delete_temp_image($temp_path);
        }
        $this->db->where('id', $id);
        $campaign['title'] = $this->input->post('title', true);
        return $this->db->update('campaigns', $campaign);

    }

    //Campaigns
    public function campaigns()
    {
        $query = $this->db->get('campaigns');
        return $query->result();
    }

    //Get Campaign
    public function get_campaign($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('campaigns');
        return $query->row();
    }

    //delete campaign
    public function delete_campaign($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('campaigns');
        $row = $query->row();
        if (!empty($row)) {
            $this->db->where('id', $id);
            return $this->db->delete('campaigns');
        } else {
            return false;
        }
    }
}
