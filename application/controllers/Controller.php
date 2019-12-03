<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();        
		$this->load->model('Queries');      
		$this->load->library('session');
		
	}

	public function index() {
		$this->load->library('form_validation'); 
		if (isset($_POST['login'])) {

			$this->form_validation->set_rules('email', 'E-Mail', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE){ 

				$data = array(
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password'))
				);

				$check = $this->Queries->logIn($data);
				if ($check != '') {
					$session_data = array(
						'id' => $check['id'],
						'email' => $check['email'],
						'logged_in' => TRUE
					); 

					$this->session->set_userdata($session_data);
					redirect('home');
				}
				else{
					echo "Invalid E-Mail and Password Combination.";
				}

			}
		}
		$this->load->view('index');
	}

	public function addUser(){
		
		$this->form_validation->set_rules('fname','Title', 'required');
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');

		if ($this->form_validation->run() == TRUE){ 
			$data = array(
				'f_name' => $this->input->post('fname'),
				'l_name' => $this->input->post('lname'),
				'gender' => $this->input->post('gender'),
				'created_at'=> date('Y-m-d h:i:s')
			);
			$this->Queries->addUser($data);
		}
		else{
			echo "Error";
		}

	}




	public function Page(){
		$details['users'] = $this->Queries->users();
		$this->load->view('home',$details);
	}


	public function delUser(){
		$id =$this->input->get('id');
		$this->Queries->deleteStu($id);
		$this->session->set_flashdata('delete_msg', 'User Deleted..!!!');
		redirect('home');
	}


	public function Status(){
		$id = $this->input->get('id');
		$r = $this->input->get('data');
		$data = array(
			'status' => $this->input->get('data'),
			'modified_at'=> date('Y-m-d h:i:s')
		);
		$this->Queries->updateStatus($data,$id);
	}


	public function updateUser(){
		$id = $this->input->get('id');
		$details['users'] = $this->Queries->detailsById($id);
		$this->load->view('update',$details);

		$this->load->library('form_validation'); 


		if (isset($_POST['update'])) {

			$this->form_validation->set_rules('fname', 'First Name', 'required');
			$this->form_validation->set_rules('lname', 'Last Name', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');

			if ($this->form_validation->run() == TRUE){ 

				$data = array(
					'f_name' => $this->input->post('fname'),
					'l_name' => $this->input->post('lname'),
					'gender' => $this->input->post('gender'),
					'modified_at'=> date('Y-m-d h:i:s')
				);

				$id = $this->input->get('id');
				$this->Queries->update($data,$id);
				$this->session->set_flashdata('update_msg', 'User Successfully Updated..!!!');
				redirect('home');
			}
		}
	}



}