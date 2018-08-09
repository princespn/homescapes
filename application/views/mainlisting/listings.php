    <div class="container top">

      <ul class="breadcrumb">

        <li>
          <a href="<?php echo site_url("mainlisting"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a> 
          <span class="divider">/</span>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

      <div class="page-header users-header">
        <h2>
          <?php echo ucfirst($this->uri->segment(2));?> 
          <a  href="<?php echo site_url("mainlisting"); ?>/add" class="btn btn-success">Add a new</a>
        </h2>
      </div>
      
      <div class="row">
        <div class="span12 columns">
          
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="yellow header headerSortDown"><?php echo "Linnworks code"; ?></th>
                <th class="yellow header headerSortDown"><?php echo "Category"; ?></th>
                <th class="yellow header headerSortDown"><?php echo "Amazon sku"; ?></th>
                <th class="yellow header headerSortDown"><?php echo "RRP(GBP)"; ?></th>
                <th class="yellow header headerSortDown"><?php echo "Amazon UK"; ?></th>
                <th class="yellow header headerSortDown"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach($Listings as $Listing)
              {
                echo '<tr>';                
                echo '<td>'.$Listing->linnworks_code.'</td>';
                echo '<td>'.$Listing->category.'</td>';
                echo '<td>'.$Listing->amazon_sku.'</td>';
                echo '<td>'.$Listing->price_uk.'</td>';
                echo '<td>'.$Listing->sale_price_uk.'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/mainlisting/update/'. $Listing->id .'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/mainlisting/delete/'. $Listing->id .'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>