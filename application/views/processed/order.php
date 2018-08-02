<?php if ($this->session->userdata('username') === NULL):
      redirect('user/login');
      endif;
  ?>  

        <div class="container top">   
      
      <div class="row">
        <div class="span12 columns">          

          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">Plateform</th>
                <th class="yellow header headerSortDown">Subsource</th>
                <th class="yellow header headerSortDown">Currency</th>
                <th class="yellow header headerSortDown">Order value</th>
              </tr>
            </thead>
            <tbody>
              
              <?php foreach($Orders as $Order){
                echo '<tr>';
                echo '<td>'.$Order->plateform.'</td>';
                echo '<td>'.$Order->subsource.'</td>';
                echo '<td>'.$Order->currency.'</td>';
                echo '<td>'.$Order->ord_value.'</td>';
                echo '<td class="crud-actions">
                  <a href="'.site_url("admin").'/manufacturers/update/'.$Order->id.'" class="btn btn-info">view & edit</a>  
                  <a href="'.site_url("admin").'/manufacturers/delete/'.$Order->id.'" class="btn btn-danger">delete</a>
                </td>';
                echo '</tr>';
              }
              ?>      
            </tbody>
          </table>

          <?php //echo '<div class="pagination">'.$this->pagination->create_links().'</div>'; ?>

      </div>
    </div>
   
    