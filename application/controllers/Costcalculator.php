<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costcalculator extends CI_Controller {
	
	
        public function __construct()
        {
                parent::__construct();
		        
		        // Load form helper library
				$this->load->helper('form');

				$this->load->helper('url');

				// Load form validation library
				$this->load->library('form_validation');

				// Load session library
				$this->load->library('session');

				$this->load->model('Costcalculator_model');
		
        }
		
		
		public function index()
		{
			$query = $this->Costcalculator_model->getcostprice();
			//print_r($query); die();
			  $data['Purchaseprice'] = null;
			  if($query){
			   $data['Purchaseprice'] =  $query;
			  }
			  
			$this->load->view('includes/header');
			$this->load->view('costcalculator/purchaseprice', $data);
			$this->load->view('includes/footer');
		}

		 public function delete($code)
   		 {                      
	          
	        $this->Costcalculator_model->delete_costcalculate_id($code);
	        $this->session->set_flashdata('successmsg', 'Your data delete successfully');      
	        redirect(base_url().'costcalculator/index');        
   		 }

   		 public function edit($code)
		{
	
	       $this->form_validation->set_rules('linnworks_code', 'Linnworks code', 'required');
	        $this->form_validation->set_rules('product_name', 'product_name', 'required');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
			
	        if ($this->form_validation->run() === FALSE)
	        {	

			 $data['result'] = $this->Costcalculator_model->show_costcalculate_id($code);			

			$this->load->view('includes/header');
			$this->load->view('costcalculator/edit', $data);
			$this->load->view('includes/footer');			
			}
			else
	        {
	        	$id = $this->input->post('id');

	      $data = array('landed_price_gbp' => $this->input->post('landed_price_gbp'));			

	        	$this->Costcalculator_model->update_data($data, $id);
	        	$this->session->set_flashdata('successmsg', 'Your data updated successfully');
	        	redirect(base_url().'costcalculator/index'); 
	        }		
		
		}
		



}


	


