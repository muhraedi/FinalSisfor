<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_model extends CI_Model
{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function get_user($username){
		return $this->db->where('username', $username)->get('users')->row();
	}

	public function get_all_product(){
		return $this->db->get('product')->result();
	}

	public function get_product_by_id($id){
		return $this->db->where('id', $id)->get('product')->row();
	}

	public function insert_product($data){
		return $this->db->insert('product', $data);
	}

	public function update_product($data, $id){
		return $this->db->where('id', $id)->update('product', $data);
	}

	public function delete_product($id){
		return $this->db->where('id', $id)->delete('product');
	}
}