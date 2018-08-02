<?php if ($this->session->userdata('username') === NULL):
      redirect('user/login');
      endif;
?>  
<div class="container top"> 
      <div class="row">
        <div class="span12 columns">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
                <tr><td colspan="17"><div class="alert alert-danger" role="alert">
               <?= $this->session->flashdata('successmsg'); ?>
               </div></td></tr>  
              <tr>
              <td colspan="6"></td>
              <td colspan="5">GBP</td>
              <td colspan="5">EUR</td>
              <td></td>
              </tr>
             <tr> 
            <td><strong>Product SKU</strong></td>
            <td><strong>Product Name</strong></td>   
            <td><strong>Category Name</strong></td>
            <td><strong>Supplier Name</strong></td>
            <td><strong>Currency</strong></td>
            <td><strong>Purchase Price</strong></td>

            <td><strong>Landed Price</strong></td>
            <td><strong>S.P.1</strong></td>
            <td><strong>S.P.2</strong></td>
            <td><strong>S.P.3</strong></td>
            <td><strong>Web Price</strong></td>

            <td><strong>Landed Price</strong></td>
            <td><strong>S.P.1</strong></td>
            <td><strong>S.P.2</strong></td>
            <td><strong>S.P.3</strong></td>
            <td><strong>Web Price</strong></td>
            <td>Action</td>
            </tr>
            </thead>
            <tbody>
              
              <?php foreach($Purchaseprice as $Purchasepric){?> 
              <tr>   
              <td><?=$Purchasepric->linnworks_code;?></td>
              <td><?=$Purchasepric->product_name;?></td>
              <td><?=$Purchasepric->category;?></td>
              <td><?=$Purchasepric->supplier;?></td>
              <td><?=$Purchasepric->invoice_currency;?></td>
              <td><?=$Purchasepric->purchase_price;?></td>

              <td><?=$Purchasepric->landed_price_gbp;?></td>
              <td><?=$Purchasepric->sp1_value_gbp;?></td>
              <td><?=$Purchasepric->sp2_value_gbp;?></td>
              <td><?=$Purchasepric->sp3_value_gbp;?></td>
              <td><?=$Purchasepric->web_sale_price_uk;?></td>
              <td><?=$Purchasepric->landed_price_gbp;?></td>
              <td><?=$Purchasepric->sp1_value_gbp;?></td>
              <td><?=$Purchasepric->sp2_value_gbp;?></td>
              <td><?=$Purchasepric->sp3_value_gbp;?></td>      
              <td><?=$Purchasepric->web_sale_price_de;?></td>
              <td><a href="<?php echo site_url('costcalculator/edit/'.$Purchasepric->linnworks_code); ?>">Edit</a> | 
                        <a href="<?php echo site_url('costcalculator/delete/'.$Purchasepric->linnworks_code); ?>" onClick="return confirm('Are you sure you want to delete?')">Delete</a></td>
                  </tr>
                <?php }?>  
            </tbody>
          </table>

          <?php //echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>
   
    