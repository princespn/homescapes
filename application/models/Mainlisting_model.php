<?php 
class Mainlisting_model extends CI_Model {


		   public function getListings($limit,$offset){
	 			 $this->db->select("*");
	  			 $this->db->from('main_listings');
				$this->db->join('admin_listings', 'admin_listings.linnworks_code = main_listings.linnworks_code');
					$this->db->join('inventory_codes', 'inventory_codes.linnworks_code = main_listings.linnworks_code');
	  			$this->db->limit($limit,$offset);
	  			$query = $this->db->get();
	  			return $query->result();
 		}



		 public function totallist(){
		  return $this->db->count_all_results('main_listings');
		 }

    }