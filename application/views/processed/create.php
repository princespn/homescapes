 <?php if ($this->session->userdata('username') === NULL):
			redirect('user/login');
			endif;
?>	

 <h1 class="sub-header"><?php echo 'Processed Orders';?></h1>
 <?php //print_r($Neworders); die(); ?>
 <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      <thead>      
      <tr> 
      <th><?php echo 'OrderId';?></th>
      <th><?php echo 'Currency';?></th> 
     <th><?php echo 'Plateform';?></th>
     <th><?php echo 'SubSource';?></th>
      <th><?php echo 'Product SKU';?></th>
      <th><?php echo 'Category';?></th>
      <th><?php echo 'Product name';?></th>
       <th><?php echo 'Quantity';?></th>
       <th><?php echo 'Cost PerUnit';?></th>       
       <th><?php echo 'Order Date';?></th>
       <th><?php echo 'Order value';?></th> 
       </tr>
      </thead>
      <tbody>

<?php foreach ($Neworders as $order): ?>  
      <tr>     
        <td><?php echo $order->GeneralInfo->ExternalReferenceNum; ?></td>       
        <td><?php echo $order->TotalsInfo->Currency;?></td>  
        <td><?php echo $order->GeneralInfo->Source;?></td> 
         <td><?php echo $order->GeneralInfo->SubSource;?></td>
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if(isset($order->Items[$i]->SKU)){ echo $order->Items[$i]->SKU; echo "</BR>"; }?>    
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if(isset($order->Items[$i]->CategoryName)){ echo  $order->Items[$i]->CategoryName;} echo "</BR>"; ?>    
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if(isset($order->Items[$i]->Title)){ echo $order->Items[$i]->Title;} echo "</BR>";   ?>  
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if(isset($order->Items[$i]->Quantity)){ echo  $quantity = $order->Items[$i]->Quantity;} echo "</BR>"; ?>    
         <?php } ?></td> 
         <td><?php for ($i = 0;$i<=count($order->Items); $i++){ ?>             
         <?php if(isset($order->Items[$i]->CostIncTax)){ echo  $order->Items[$i]->CostIncTax;} echo "</BR>"; ?>    
         <?php } ?></td>
         <td><?php echo $order->GeneralInfo->ReceivedDate; ?></td>        
         <td><?php echo number_format($order->TotalsInfo->TotalCharge,2);?></td>        
          <?Php //if($order->GeneralInfo->SubSource ==='Germany'){$Gersum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='United Kingdom'){$Uksum+= $order->TotalsInfo->TotalCharge; } ?>
           <?Php //if($order->GeneralInfo->SubSource ==='EBAY0'){$Ebsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='France'){$Frsum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='Tesco UK'){$Tessum+= $order->TotalsInfo->TotalCharge; } ?>
          <?Php //if($order->GeneralInfo->SubSource ==='http://www.homescapesonline.com'){$Magsum+= $order->TotalsInfo->TotalCharge; } ?>        
        </tr> 
    <?php endforeach; ?>   
      </tbody>
    </table>
  </div>
<p><nav><?php //print_r($pagination); ?></nav></p>
<a href="#" onclick="pageloader();">Click here</a>
<script>
function pageloader()
{
<?php for ($i=3600; $i<=4000; $i++){ ?>
 window.open("http://localhost/codenew/processed/create_data?page=<?php echo $i; ?>", '_blank');
<?php } ?>
}
</script>
<?php  echo "Amit kumar tiwari"; ?>