
     <div class="container top">      
      <div class="row">
        <div class="span12 columns">
          <table class="table table-striped table-bordered table-condensed">
            <thead>
              <tr>
                <th class="header">Name</th>
                <th class="yellow header headerSortDown">E-mail</th>       
              </tr>
            </thead>
            <tbody>
              <?php   if(!empty($Users)){
             foreach($Users as $User){             

                echo '<tr>';
                echo '<td>'.$User->username.'</td>';
                echo '<td>'.$User->email.'</td>';                         
                echo '</tr>';  }    
             }else{
                echo '<tr>';
                echo '<td>'. $username.'</td>';
                echo '<td>'.$email.'</td>';               
                echo '</tr>';
              }

          
            
              ?>      
            </tbody>
          </table>
        </div>
    </div>