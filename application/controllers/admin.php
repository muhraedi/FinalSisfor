<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('session');
	}
	public function index() {
		if(!($this->session->userdata('status') == 'logged_in')){
			redirect('admin/login');
		}
		$this->load->view('admin/index');
	}
	public function login() {
		if($this->session->userdata('status') == 'logged_in'){
			redirect('admin/index');
		}
		$this->load->view('login');
	}
	public function loginAction() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (!empty($username) && !empty($password)) {
			if ($username == 'ifan' && ($password =='ifan')) {
				$session_data = [];
				$session_data['status'] = 'logged_in';
				$session_data['user'] = $user->username;
				$this->session->set_userdata($session_data);
			}
		}
		redirect(base_url("index.php/admin/index"));
	}
	public function customer() {
		$this->load->view('admin/customer');
	}
	public function customerTambah(){
		$this->load->view('admin/customerForm');	
	}
	public function company() {
		$this->load->view('admin/company');
	}
	public function companyTambah(){
		$this->load->view('admin/companyForm');	
	}
	public function library() {
		$this->load->view('admin/library');
	}
	public function libraryTambah(){
		$this->load->view('admin/libraryForm');	
	}
	public function product() {
		$data['query'] = $this->Admin_model->get_all_product();
		$this->load->view('admin/product', $data);
	}
	public function productTambah(){
		$id = (int) $this->input->post('id');
		$data = [];
		$data['product'] = false;
		$data['action_button'] = 'Create';

		if ($id && $id > 0) {
			$data['product'] = $this->Admin_model->get_product_by_id($id);
			$data['action_button'] = 'Update';
		}

		$this->load->view('admin/productForm', $data);	
	}
	public function productSave(){
		$data_product['jenis_paket'] = $this->input->post('jenis_paket');
		$data_product['nama_paket'] = $this->input->post('nama_paket');
		$data_product['fasilitas'] = $this->input->post('fasilitas');
		$data_product['jenis_kerjasama'] = $this->input->post('jenis_kerjasama');
		$data_product['harga_per_bulan'] = $this->input->post('harga_per_bulan');
		$data_product['harga_per_tahun'] = $this->input->post('harga_per_tahun');
		$id = (int) $this->input->post('id');

		if ($id && $id > 0) {
			$this->Admin_model->update_product($data_product, $id);
		}
		else {
			$this->Admin_model->insert_product($data_product);
		}

		redirect(base_url('index.php/admin/product'));
	}
	public function productDelete(){
		 $id = (int) $this->input->post('id');
		 if ($id && $id > 0) {
		 	$this->Admin_model->delete_product($id);
		 }
		 redirect(base_url('index.php/admin/product'));
	}
	public function post(){
		$this->load->view('admin/posts');	
	}
}
