<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mainlisting extends CI_Controller {

	
	 public function __construct(){
		 
          parent::__construct();
		  
		 
		// Load form helper library
		$this->load->helper('form');

		$this->load->helper('url');

		// Load form validation library
		$this->load->library('form_validation');

		// Load session library
		$this->load->library('session');

		$this->load->library('pagination');

		// Load database
		$this->load->model('Mainlisting_model');
				}



		public function index($offset=0) {

		$config = array();
		$limit_per_page = 5;	
		//$page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
		$total_records = $this->Mainlisting_model->totallist();
 		//print_r($config['total_rows']);
 		$config["base_url"] = base_url()."/mainlisting/index";
 		$config['total_rows'] = $total_records;  		
  		$config['per_page'] = $limit_per_page; 
  		$config["uri_segment"] = 3;  
  		$config["num_links"] = 2;   
  		$config['use_page_numbers'] = TRUE;
  		//$config['page_query_string'] = TRUE;
  		//$config['reuse_query_string'] = FALSE;
  		$config['prefix'] = '';
  		$config['suffix'] = '';
  		$config['use_global_url_suffix'] = FALSE;

  		$config['full_tag_open'] = '<div class="pagination"><ul>';
  		$config['full_tag_close'] = '</ul></div>';

  		$confcig['first_link'] = '« First';
  		$config['first_tag_open'] = '<li class="prev page">';
  		$config['first_tag_close'] = '</li>';

  		$config['last_link'] = 'Last »';
 		$config['last_tag_open'] = '<li class="next page">';
  		$config['last_tag_close'] = '</li>';

  		$config['next_link'] = 'Next →';
  		$config['next_tag_open'] = '<li class="next page">';
  		$config['next_tag_close'] = '</li>';

  		$config['prev_link'] = '← Previous';
  		$config['prev_tag_open'] = '<li class="prev page">';
  		$config['prev_tag_close'] = '</li>';

  		$config['cur_tag_open'] = '<li class="active"><a href="">';
  		$config['cur_tag_close'] = '</a></li>';

  		$config['num_tag_open'] = '<li class="page">';
  		$config['num_tag_close'] = '</li>';


  		$this->pagination->initialize($config);


			if (empty($this->session->userdata('username'))) {

			redirect("user/login");	
						
			}else{

		$query = $this->Mainlisting_model->getListings($config['per_page'],$offset);
								//print_r($query); die();
			 $data['Listings'] = null;
							if($query){
					$data['Listings'] =  $query;
										}

						$this->load->view('includes/header');
						$this->load->view('mainlisting/listings',$data);
						$this->load->view('includes/footer');
				
				
						}

				}
	  
	
}