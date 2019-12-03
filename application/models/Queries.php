<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Queries extends CI_Model {

	public function logIn($data){
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('email', $data['email']);
		$this->db->where('password', $data['password']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row;
		}
	}

	public function addUser($data){
		$this->db->insert('users', $data);	
	}

	public function users(){
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->result_array();
			return $row;
		}
	}


	public function deleteStu($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
	}


	public function updateStatus($data,$id){
	 	$this->db->where('id',$id);
		$this->db->update('users',$data);       
	}


	public function detailsById($id){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->result_array();
			return $row;
		}
	}


	public function update($data,$id){
		$this->db->where('id',$id);
		$this->db->update('users',$data);      
	}

}