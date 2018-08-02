<?php 
class Processed_model extends CI_Model {
  

public function gettoken() {

        	$auth_data = array(
			'applicationId' =>'b72fc47a-ef82-4cb3-8179-2113f09c50ff',
			'applicationSecret' =>'e727f554-7d27-4fd2-bcaf-dad3e0079821',
			'token' =>'cd431b31abd667bbb1e947be42077e9d');

			$header = array("POST:https://api.linnworks.net//api/Auth/AuthorizeByApplication HTTP/1.1","Host:api.linnworks.net","Connection: keep-alive","Accept: application/json, text/javascript, */*; q=0.01","Origin: https://www.linnworks.net","Accept-Language: en","User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36","Content-Type: application/x-www-form-urlencoded; charset=UTF-8","Referer: https://www.linnworks.net/","Accept-Encoding: gzip, deflate");

			$url = 'https://api.linnworks.net//api/Auth/AuthorizeByApplication?applicationId='.$auth_data['applicationId'].'&applicationSecret='.$auth_data['applicationSecret'].'&token='.$auth_data['token'];
			$ch = curl_init();
	        curl_setopt($ch, CURLOPT_URL, $url);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        curl_setopt($ch, CURLOPT_POST, 1);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $auth_data);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        //curl_setopt($ch, CURLOPT_USERPWD,$some_data['userName'].':'.$some_data['password']);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        $result = curl_exec($ch);
	        $yummy = json_decode($result);
	        curl_close($ch);
        //print_r($yummy);die();
        	$Token = $yummy->{'Token'};
       		return $Token;

        }


        public function getallprocess($pagenum){      

        //$this->set('title', 'Linnworks Process Orders get for pkOrderID.');
        $userkey = $this->gettoken();
        $some_data = array('token' => $userkey);

    
		$from = '2018-01-01T00:00:00'; //min
		//$from = '';   // 2017-04-03 - TO - 2017-04-09
		$to =  '2018-07-31T60:60:60'; //max
		//$to = '';
        
		$datetype = '1';
        $sfield  = '';
        $sterm  = '';
        $limit = '50';
		
        //$pagenum = isset($_GET['page']);
		//$pagenum =  '5'; //1482,74070
        // for process orders

        $header = array("POST:https://eu-ext.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);

        $url = 'https://eu-ext.linnworks.net//api/ProcessedOrders/SearchProcessedOrdersPaged?from=' . $from . '&to=' . $to . '&dateType=' . $datetype . '&searchField=' . $sfield . '&exactMatch=true&searchTerm=' . $sterm . '&pageNum=' . $pagenum . '&numEntriesPerPage='.$limit;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $porders = json_decode($result);
       //print_r($porders); die();
          curl_close($ch);
   		return $porders ;

    }

    public function inser_data($data){ 
       	
    	return $this->db->insert('processed_orders', $data);
	}

	public function savelisting_data($saveAll){		

		return $this->db->insert('processed_listings', $saveAll);

	}

	 public function getOrders(){
	  $this->db->select("order_id,order_date,currency,plateform,subsource,order_value");
	  $this->db->from('processed_orders');
	  $query = $this->db->get();
	  return $query->result();
	 }
	 	

	 public function getsubsource(){
		 
		 $this->db->select('id,currency,plateform,subsource,sum(order_value) AS ord_value');
		 $this->db->from('processed_orders');
		 $this->db->group_by('plateform'); 	
		 $this->db->order_by('currency','desc'); 
		 $query = $this->db->get();
		 return $query->result();	 
		 
	 }
 
   /*
 public function getPlateform(){
	 
	 $this->db->select('order_id,order_date,currency,plateform,subsource,order_value');
	 $this->db->from('processed_orders');
	 $this->db-join('processed_orders','processed_listings','processed_orders.plateform = processed_listings.plateform');
	 $query = $this->db->get();
	 return $query->result();	 
	 
 }*/
 
}