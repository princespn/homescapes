<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processed extends CI_Controller {
	
	
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

				$this->load->model('Processed_model');
		
        }

        

    


public function create_data(){

	//error_reporting(0);

		$data['title'] = 'Linnworks Processed Orders.';

		if(!empty($this->input->get('page'))){
		$page = $this->input->get('page'); 
		} else {$page =1;}

        $userkey = $this->Processed_model->gettoken();
        $some_data = array('token' => $userkey);
        $process_orders = $this->Processed_model->getallprocess($page); 
        //print_r($process_orders->Data);die();
        $pkid = array();
        foreach ($process_orders->Data  as $process_order) { 
        // If you need the pointer (but I don't think) you have to add '$i => ' before $username
        $pkid[] = "'". $process_order->pkOrderID. "'";
        }
       $Processedkid = implode(",",$pkid);
       // for pagination

        $adjacents = 12088;
        $total = 604373;
        $targetpage = ""; //your file name
        $limit = 200;  //how many items to show per page
        //$page = isset($_GET['page']);
        $counter = 0;

        if ($page) {
            $start = ($page - 1) * $limit; //first item to display on this page
        } else {
            $start = 0;
        }
        if ($page == 0){$page = 1; }//if no page var is given, default to 1.


        $prev = $page - 1; //previous page is current page - 1
        $next = $page + 1; //next page is current page + 1
        $lastpage = ceil($total / $limit); //lastpage.
        $lpm1 = $lastpage - 1; //last page minus 1

        /* CREATE THE PAGINATION */

        $pagination = "";
        if ($lastpage > 1) {
            $pagination .= "<ul class='pagination pagination-sm margin-0'>";
            if ($page > $counter + 1) {
                $pagination.= "<li><a href=\"$targetpage?page=$prev\">prev</a> </li>";
            }

            if ($lastpage < 7 + ($adjacents * 2)) {
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li>	<a href='#' class='active'>$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                }
            }
            elseif ($lastpage > 5 + ($adjacents * 2)) { //enough pages to hide some
                //close to beginning; only hide later pages
                if ($page < 1 + ($adjacents * 2)) {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                    $pagination.= "<li>...</li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                }
                //in middle; hide some front and some back
                elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
                    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    $pagination.= "<li>...</li>";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                    $pagination.= "<li>...</li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";
                }
                //close to end; only hide early pages
                else {
                    $pagination.= "<li><a href=\"$targetpage?page=1\">1</a></li>";
                    $pagination.= "<li><a href=\"$targetpage?page=2\">2</a></li>";
                    $pagination.= "<li>...</li>";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                        if ($counter == $page)
                            $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                        else
                            $pagination.= "<li><a href=\"$targetpage?page=$counter\">$counter</a></li>";
                    }
                }
            }

            //next button
            if ($page < $counter - 1)
                $pagination.= "<li><a href=\"$targetpage?page=$next\">next</a></li>";
            else
                $pagination.= "";
            $pagination.= "</ul>";
        }

        //end
       $header = array("POST:https://eu-ext.linnworks.net//api/Orders/GetOrdersById HTTP/1.1", "Host: eu-ext.linnworks.net", "Connection: keep-alive", "Accept: application/json, text/javascript, */*; q=0.01", "Origin: https://www.linnworks.net", "Accept-Language: en", "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36", "Content-Type: application/x-www-form-urlencoded; charset=UTF-8", "Referer: https://www.linnworks.net/", "Accept-Encoding: gzip, deflate", "Authorization:" . $some_data['token']);
     
       $url = "https://eu-ext.linnworks.net//api/Orders/GetOrdersById?pkOrderIds=[".$Processedkid."]";
       $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $some_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $orders = json_decode($result);
    //print_r($orders); die();
        $data['Neworders'] = json_decode($result);    
        curl_close($ch);

        //  $this->set(compact('orders','pagination'));
            $this->load->view('includes/header');
            $this->load->view('processed/create', $data);
            $this->load->view('includes/footer');


       
    if (!empty($orders)) {
        foreach ($orders as $order){
                   
            for ($i = 0;$i<=COUNT($order->Items); $i++) {
                    //print_r($order->Items[$i]->SKU); //die();
                             $days = strtotime($order->GeneralInfo->ReceivedDate);
                             $this_week_sd = date("Y-m-d",$days);    

    	 	
	               if(($order->GeneralInfo->Source === 'DATAIMPORTEXPORT') && ($order->GeneralInfo->SubSource === 'Daily Mail')){$smart_orderid = "DMail10".$order->GeneralInfo->ExternalReferenceNum;}else {$smart_orderid = $order->GeneralInfo->ExternalReferenceNum;}

			 	       if((!empty($smart_orderid)) && (!empty($order->Items[$i]->SKU))){
			    
						    $saveAll = array('order_id' => $smart_orderid,'order_date' => $this_week_sd,  'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource, 'product_sku' => $order->Items[$i]->SKU, 'cat_name' => $order->Items[$i]->CategoryName, 'product_name' => $order->Items[$i]->Title, 'quantity' =>  $order->Items[$i]->Quantity, 'price_per_product' => $order->Items[$i]->CostIncTax);

						     $this->Processed_model->savelisting_data($saveAll);
			 			  }
                } 

                  	
                        $days = strtotime($order->GeneralInfo->ReceivedDate);
                        $this_week_sd = date("Y-m-d",$days); 

	               if(($order->GeneralInfo->Source === 'DATAIMPORTEXPORT') && ($order->GeneralInfo->SubSource === 'Daily Mail')){$smart_orderid = "DMail10".$order->GeneralInfo->ExternalReferenceNum;}else {$smart_orderid = $order->GeneralInfo->ExternalReferenceNum;}
	
	
	               //$ordervalue = (($order->TotalsInfo->TotalCharge)-($order->TotalsInfo->Tax));
                      $ordervalue = $order->TotalsInfo->TotalCharge;
	   			        if(!empty($smart_orderid)) {
					   $data = array('order_id' => $smart_orderid, 'currency' => $order->TotalsInfo->Currency, 'plateform' => $order->GeneralInfo->Source,'subsource' => $order->GeneralInfo->SubSource,'order_date' => $this_week_sd,'order_value' => $ordervalue);
					  	 $this->Processed_model->inser_data($data);
	  	 }
    
    }
      

            
    }
    

		
}	
		public function index()
		{
			$query = $this->Processed_model->getsubsource();
			//print_r($query); die();
			  $data['Orders'] = null;
			  if($query){
			   $data['Orders'] =  $query;
			  }
			  
			$this->load->view('includes/header');
			$this->load->view('processed/order', $data);
			$this->load->view('includes/footer');
		}
}





