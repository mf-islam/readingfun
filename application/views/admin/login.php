
            <div class="container-fluid col-md-8 col-md-offset-2 absolute-center is-responsive">
              <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Admin Panel</h4>
                        </div>
                        <div class="content">
                              <hr class="colorgraph"><br>
                              <?php
                                 $attributes = array('class' => 'login-form', 'name' => 'admin_form');
                                 echo form_open('', $attributes);
                              ?>
                              <div class="col-md-6 col-md-offset-3 text-center">
                                <input type="text" name="identity" id="identity" class="form-control border-input" placeholder="email" value="">
                                </div>
                               <div class="col-md-6 col-md-offset-3 text-center">
                                <input type="password" name="password" id="password" class="form-control border-input" placeholder="Password" value="">
                                <!--<div class="form-group">
                                  <label class="checkbox text-left">
                                    <input type="checkbox" data-toggle="checkbox" name="remember" value="1">Remember me
                                  </label>
                                </div>-->
                                <div class="clearfix"></div>   
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Login</button> 
                                </div>
                                
                              </div>    
                              <div class="clearfix"></div>   
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
              </div>
<script>
$(function(){
  <?php if (isset($_SESSION['message'])): 
  foreach ($_SESSION['message'] as $key => $value) { ?>
    custom.showNotification(
      'danger', 
      '<?php echo $value; ?>',
      'top',
      'center');
  <?php } endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
    custom.showNotification(
      'danger', 
      '<?php echo $_SESSION['error']; ?>',
      'top',
      'center');
  <?php endif; ?>
  <?php if (isset($_SESSION['success'])): ?>
    custom.showNotification(
      'success', 
      '<?php echo $_SESSION['success']; ?>',
      'top',
      'center');
  <?php endif; ?>
  <?php if (isset($_SESSION['warning'])): ?>
    custom.showNotification(
      'warning', 
      '<?php echo $_SESSION['warning']; ?>',
      'top',
      'center');
  <?php endif; ?>
  
});
</script>