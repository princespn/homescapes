<?php 
class Costcalculator_model extends CI_Model {
  


 public function getcostprice(){
 	$this->db->select('*');
	$this->db->from('cost_calculators');
	$this->db->join('purchase_prices', 'purchase_prices.item_sku = cost_calculators.linnworks_code');
	$this->db->join('admin_listings', 'admin_listings.linnworks_code = cost_calculators.linnworks_code');
	$query = $this->db->get();
	 return $query->result();		 
 }

	 public function show_costcalculate_id($code){
		$this->db->select('*');
		$this->db->from('cost_calculators');
		$this->db->where('linnworks_code', $code);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
		}

		public function delete_costcalculate_id($code){
		$this->db->where('linnworks_code', $code);
		$this->db->delete('cost_calculators');
		}

    public function update_data($data, $id)  
      {  
           $this->db->where("id", $id);  
           $this->db->update("cost_calculators", $data);            
      }  



 /* public function getcostprice(){
	 
	 $this->db->select('order_id,order_date,currency,plateform,subsource,order_value');
	 $this->db->from('processed_orders');
	 $this->db-join('processed_orders','processed_listings','processed_orders.plateform = processed_listings.plateform');
	 $query = $this->db->get();
	 return $query->result();	 
	 
 }*/


 }