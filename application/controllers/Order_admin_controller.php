<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_admin_controller extends Admin_Core_Controller
{
	public function __construct()
	{
		parent::__construct();
		//check user
		if (!is_admin()) {
			redirect(admin_url() . 'login');
		}
	}

	/**
	 * Orders
	 */
	public function orders()
	{
		$data['title'] = trans("orders");
		$data['form_action'] = admin_url() . "orders";

		$pagination = $this->paginate(admin_url() . 'orders', $this->order_admin_model->get_orders_count());
		$data['orders'] = $this->order_admin_model->get_paginated_orders($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = $this->settings_model->get_panel_settings();

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/order/orders', $data);
		$this->load->view('admin/includes/_footer');
	}

	/**
	 * Order Details
	 */
	public function order_details($id)
	{
		$data['title'] = trans("order");

		$data['order'] = $this->order_admin_model->get_order($id);
		$order = $this->order_admin_model->get_order($id);
		if (empty($data['order'])) {
			redirect(admin_url() . "orders");
		}
		$data['order_products'] = $this->order_admin_model->get_order_products($id);
        $data['panel_settings'] = $this->settings_model->get_panel_settings();

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/order/order_details', $data);
		$this->load->view('admin/includes/_footer');
	}

	public function barkod($code){
		$this->set_barcode($code);
	}

	private function set_barcode($code)
	{
		// Load library
		$this->load->library('zend');
		// Load in folder Zend
		$this->zend->load('Zend/Barcode');
		// Generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}

	public function kargo_olustur($id)
	{
		$order = $this->order_admin_model->get_order($id);
		if($order->has_cargo == 1){
			header('Location: /admin/order-details/' . $id);
			die();
		}
		$shipping = get_order_shipping($order->id);
		$products = $this->order_admin_model->get_order_products($id);
		//print_r($products); exit;

		$prods = [];
		foreach($products as $key => $product){
			$prods['kargolaricerik_urunadi_' . ($key + 1)] = $product->product_title;
			$prods['kargolaricerik_adet_' . ($key + 1)] = $product->product_quantity;
			$prods['kargolaricerik_agirlik_' . ($key + 1)] = 1;
			$prods['kargolaricerik_fiyat_' . ($key + 1)] = $product->product_unit_price / 100;
			$prods['kargolaricerik_toplam_' . ($key + 1)] = $product->product_total_price / 100;
		}
		//print_r($prods); exit;
		try {
			$this->load->library('artkargo');
			$this->artkargo->setApiKey('6344991732DD86FCF28CFC7D5C855418')
						   ->setReturnType('array');

			$prms = array(
				"alici" => array(
					"adsoyad" => $shipping->shipping_first_name . " " . $shipping->shipping_last_name,
					"adres" => $shipping->shipping_address_1 . " " . $shipping->shipping_address_2,
					"il_id" => 34,
					"ulke_id" => 1,
					"ilce_id" => 441,
					"tel" => $shipping->shipping_phone_number
				),
				"kargo" => array(
					"teslimat_tipi_id" => 1,
					"odeme_tipi_id" => 2,
					"odeme_sekli_id" => 3,
					"kontrollu_teslimat" => "",
					"adet" => count($products),
					"desi" => 1,
					"tutar" => $order->price_total / 100,
					"icerik" => $shipping->shipping_first_name . " " . $shipping->shipping_last_name . " İçin Kargo",
					"fatura_basligi" => $shipping->shipping_first_name . " " . $shipping->shipping_last_name . " İçin Kargo",
					"aciklama" => $shipping->shipping_first_name . " " . $shipping->shipping_last_name . " İçin Kargo"
				),
				'kargo_icerik' => $prods
			);
			//print_r($prms);
			$response = $this->artkargo->setParams($prms)/* methodun parametreleri */
							->yeni_olustur()/* kullanilacak method ismi */
							->getResponse(true); /* api isteği çalıştırıldıktan sonra geriye dönen datayı almak için kullanılır*/
			//echo $response; exit;

			if($response['status'] == 1){
				$model['has_cargo'] = 1;
				$model['takip_no'] = $response['data']['takip_no'];
				$model['barkod'] = $response['data']['barkod'];
				//print_r($model);
				$this->db->set($model);
				$this->db->where('id', $id);
				$this->db->update('orders'); // gives UPDATE mytable SET field = field+1 WHERE id = 2
				$this->session->set_flashdata('success', 'Kargo başarıyla oluşturuldu');
				header('Location: /admin/order-details/' . $id);
				die();
			} else {
				$this->session->set_flashdata('error', 'Kargo oluşturulurken bir hatayla karşılaşıldı: ' . $response['message']);
				header('Location: /admin/order-details/' . $id);
				die();
			}
		} catch(\Exception $e){
			$this->session->set_flashdata('error', 'Kargo oluşturulurken bir hatayla karşılaşıldı: '. $e->getMessage());
			header('Location: /admin/order-details/' . $id);
			die();
		}
		
	}

	/**
	 * Order Options Post
	 */
	public function order_options_post()
	{
		$order_id = $this->input->post('id', true);
		$option = $this->input->post('option', true);

		if ($option == "payment_received") {
			$this->order_admin_model->update_order_payment_received($order_id);

			$this->order_admin_model->update_payment_status_if_all_received($order_id);
			$this->order_admin_model->update_order_status_if_completed($order_id);
		}

		$this->session->set_flashdata('success', trans("msg_updated"));
		redirect($this->agent->referrer());
	}

	/**
	 * Delete Order Post
	 */
	public function delete_order_post()
	{
		$id = $this->input->post('id', true);
		if ($this->order_admin_model->delete_order($id)) {
			$this->session->set_flashdata('success', trans("msg_deleted"));
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
		}
	}

	/**
	 * Update Order Product Status Post
	 */
	public function update_order_product_status_post()
	{
		$id = $this->input->post('id', true);
		$order_product = $this->order_admin_model->get_order_product($id);
		if (!empty($order_product)) {
			if ($this->order_admin_model->update_order_product_status($order_product->id)) {
				$order_status = $this->input->post('order_status', true);
				if ($order_product->product_type == "digital") {
					if ($order_status == 'completed' || $order_status == 'payment_received') {
						$this->order_model->add_digital_sale($order_product->product_id, $order_product->order_id);
						//add seller earnings
						$this->earnings_model->add_seller_earnings($order_product);
					}
				} else {
					if ($order_status == 'completed') {
						//add seller earnings
						$this->earnings_model->add_seller_earnings($order_product);
					} else {
						//check if earning added before
						$order = $this->order_admin_model->get_order($order_product->order_id);
						if (!empty($order) && !empty($this->earnings_model->get_earning_by_user_id($order_product->seller_id, $order->order_number))) {
							//remove seller earnings
							$this->earnings_model->remove_seller_earnings($order_product);
						}
					}
				}
				$this->session->set_flashdata('success', trans("msg_updated"));
			} else {
				$this->session->set_flashdata('error', trans("msg_error"));
			}

			$this->order_admin_model->update_payment_status_if_all_received($order_product->order_id);
			$this->order_admin_model->update_order_status_if_completed($order_product->order_id);
		}
		redirect($this->agent->referrer() . "#t_product");
	}

	/**
	 * Delete Order Product Post
	 */
	public function delete_order_product_post()
	{
		$id = $this->input->post('id', true);
		if ($this->order_admin_model->delete_order_product($id)) {
			$this->session->set_flashdata('success', trans("msg_deleted"));
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
		}
	}

	/**
	 * Transactions
	 */
	public function transactions()
	{
		$data['title'] = trans("transactions");
		$data['form_action'] = admin_url() . "transactions";

		$pagination = $this->paginate(admin_url() . 'transactions', $this->transaction_model->get_transactions_count());
		$data['transactions'] = $this->transaction_model->get_paginated_transactions($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = $this->settings_model->get_panel_settings();

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/order/transactions', $data);
		$this->load->view('admin/includes/_footer');
	}

	/**
	 * Delete Transaction Post
	 */
	public function delete_transaction_post()
	{
		$id = $this->input->post('id', true);
		if ($this->transaction_model->delete_transaction($id)) {
			$this->session->set_flashdata('success', trans("msg_deleted"));
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
		}
	}

	/**
	 * Bank Transfer Notifications
	 */
	public function order_bank_transfers()
	{
		$data['title'] = trans("bank_transfer_notifications");
		$data['form_action'] = admin_url() . "order-bank-transfers";

		$pagination = $this->paginate(admin_url() . 'order-bank-transfers', $this->order_admin_model->get_bank_transfers_count());
		$data['bank_transfers'] = $this->order_admin_model->get_paginated_bank_transfers($pagination['per_page'], $pagination['offset']);

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/order/bank_transfers', $data);
		$this->load->view('admin/includes/_footer');
	}

	/**f
	 * Bank Transfer Options Post
	 */
	public function bank_transfer_options_post()
	{
		$id = $this->input->post('id', true);
		$order_id = $this->input->post('order_id', true);
		$option = $this->input->post('option', true);
		if ($this->order_admin_model->update_bank_transfer_status($id, $option)) {
			if ($option == 'approved') {
				$this->order_admin_model->update_order_payment_received($order_id);
			}
			$this->order_admin_model->update_order_status_if_completed($order_id);
			$this->session->set_flashdata('success', trans("msg_updated"));
			redirect($this->agent->referrer());
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
			redirect($this->agent->referrer());
		}
	}

	/**
	 * Approve Guest Order Product
	 */
	public function approve_guest_order_product()
	{
		$order_product_id = $this->input->post('order_product_id', true);
		if ($this->order_admin_model->approve_guest_order_product($order_product_id)) {
			//order product
			$order_product = $this->order_admin_model->get_order_product($order_product_id);
			//add seller earnings
			$this->earnings_model->add_seller_earnings($order_product);
			//update order status
			$this->order_admin_model->update_order_status_if_completed($order_product->order_id);
		}
		redirect($this->agent->referrer());
	}

	/**
	 * Delete Bank Transfer Post
	 */
	public function delete_bank_transfer_post()
	{
		$id = $this->input->post('id', true);
		if ($this->order_admin_model->delete_bank_transfer($id)) {
			$this->session->set_flashdata('success', trans("msg_deleted"));
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
		}
	}

    /**
     * Invoices
     */
    public function invoices()
    {
        $data['title'] = trans("invoices");
        $data['form_action'] = admin_url() . "invoices";

        $pagination = $this->paginate(admin_url() . 'invoices', $this->order_admin_model->get_invoices_count());
        $data['invoices'] = $this->order_admin_model->get_paginated_invoices($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = $this->settings_model->get_panel_settings();

        $this->load->view('admin/includes/_header', $data);
        $this->load->view('admin/order/invoices', $data);
        $this->load->view('admin/includes/_footer');
    }

	/**
	 * Digital Sales
	 */
	public function digital_sales()
	{
		$data['title'] = trans("digital_sales");
		$data['form_action'] = admin_url() . "digital-sales";

		$pagination = $this->paginate(admin_url() . 'digital-sales', $this->order_admin_model->get_digital_sales_count());
		$data['digital_sales'] = $this->order_admin_model->get_digital_sales($pagination['per_page'], $pagination['offset']);
        $data['panel_settings'] = $this->settings_model->get_panel_settings();

		$this->load->view('admin/includes/_header', $data);
		$this->load->view('admin/order/digital_sales', $data);
		$this->load->view('admin/includes/_footer');
	}

	/**
	 * Delete Digital Sales Post
	 */
	public function delete_digital_sales_post()
	{
		$id = $this->input->post('id', true);
		if ($this->order_admin_model->delete_digital_sale($id)) {
			$this->session->set_flashdata('success', trans("msg_deleted"));
		} else {
			$this->session->set_flashdata('error', trans("msg_error"));
		}
	}
}
