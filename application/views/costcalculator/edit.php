     
<?php if ($this->session->userdata('username') === NULL):
      redirect('user/login');
      endif;
?>  
<div class="container">
  <div class="row">
    <?php if (validation_errors()) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= validation_errors() ?>
        </div>
      </div>
    <?php endif; ?>
    <?php if (isset($error)) : ?>
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-md-12">
      <div class="page-header">
        <h1>Edit List</h1>
      </div>
      <?= form_open() ?>
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $result[0]->id; ?>">
        </div>
        <div class="form-group">
          <label for="linnworks_code">linnworks code</label>
          <input type="text" class="form-control" id="linnworks_code" name="linnworks_code" value="<?php echo $result[0]->linnworks_code; ?>">
        </div>
       
        <div class="form-group">
          <label for="product_name">Product name</label>
          <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $result[0]->product_name; ?>">
           </div>

          <div class="form-group">
          <label for="category">Category</label>
          <input type="text" class="form-control" id="category" name="category" value="<?php echo $result[0]->category; ?>">
           </div>

          <div class="form-group">
          <label for="landed_price_gbp">landed Price</label>
          <input type="text" class="form-control" id="landed_price_gbp" name="landed_price_gbp" value="<?php echo $result[0]->landed_price_gbp; ?>">
           </div>

        <div class="form-group">
          <input type="submit" class="btn btn-default" value="Update">
        </div>
      </form>
    </div>
  </div><!-- .row -->
</div><!-- .container -->