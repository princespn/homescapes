<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	
	 public function __construct(){
		 
          parent::__construct();
		  
		 
		// Load form helper library
		$this->load->helper('form');

		$this->load->helper('url');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		// Load database
		$this->load->model('User_model');
				}
	  
	  
	public function index()
	{
			if (!empty($this->session->userdata('username'))) {
				redirect("processed");	
				}else{
			$this->load->view('includes/login-header');
			$this->load->view('admin/login');
			$this->load->view('includes/footer');
				
				
			}
				
			
	
	}
	
	public function login(){
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('includes/login-header');
			$this->load->view('admin/login');
			$this->load->view('includes/footer');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->User_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->User_model->get_user_id_from_username($username);
				$user    = $this->User_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['username']     = (string)$user->username;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				//print_r($user->username); die();
				
				if($this->session->userdata('username') ==='admin'){
			 	 $query = $this->User_model->getallusers();
			 	  //print_r($query); die();
			 	 //$data['Users'] = null;
			 	 $data['Users'] =  $query;
			 	 }else{
			$data = array('username' => $user->username,'email' => $user->email);

			 	 }
				
				$this->load->view('includes/header');
				$this->load->view('admin/user_list', $data);
				$this->load->view('includes/footer');
				
			} else {
				
				// login failed
				$data['error'] = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('includes/login-header');
				$this->load->view('admin/login', $data);
				$this->load->view('includes/footer');
				
			}
			
		}
		
		
		
	}
	
	 /**
    

	/**
    * Create new user and store it in the database
    * @return void
    */	
	public function signup()
	{
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) 
		{
			$data['title'] = 'Please.'; 
			$this->load->view('includes/header');
			$this->load->view('admin/signup', $data);
			$this->load->view('includes/footer');		
		} else {
			
			// set variables from the form
			$data['title'] = 'Please.'; 
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->User_model->create_user($username, $email, $password)) {

				$user_id = $this->User_model->get_user_id_from_username($username);
				$user    = $this->User_model->get_user($user_id);


			
						  	

			 	 if($this->session->userdata('username') ==='admin'){
			 	 $query = $this->User_model->getallusers();

			 	 $data['Users'] =  $query;
			 	 }else{
	$data = array('username' => $user->username,'email' => $user->email);

			 	 }

				$this->load->view('includes/header');
				$this->load->view('admin/user_list', $data);
				$this->load->view('includes/footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				$data['title'] = 'Please.'; 
				$this->load->view('includes/header');
				$this->load->view('admin/signup', $data);
				$this->load->view('includes/footer');
				
			}
			
		}
	}	

    
	/**
    * Destroy the session, and logout the user.
    * @return void
    */	
	
	public function logout()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
			
			// user logout ok
			$data['title']= 'Logout';
			$this->load->view('includes/login-header');
			$this->load->view('admin/login', $data);
			$this->load->view('includes/footer');
				
			
		} else {			
			
			redirect('/');
			
		}
		;
	}

}