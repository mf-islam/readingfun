
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-7">
                  <div class="card">
                      <div class="content">
                          <?php
                             $attributes = array('class' => 'settings_form', 'name' => 'settings_form');
                             echo form_open('', $attributes);
                          ?>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Site title</label>
                                          <input type="text" required="true" name="site_title" id="site_title" class="form-control border-input" placeholder="Company" value="<?php echo (isset($site_title) ? $site_title : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Site slogan</label>
                                          <input type="text" name="site_slogan" class="form-control border-input" placeholder="Slogan" value="<?php echo (isset($site_slogan) ? $site_slogan : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" name="first_name" class="form-control border-input" placeholder="First name" value="<?php echo (isset($first_name) ? $first_name : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Last name</label>
                                          <input type="text" name="last_name" class="form-control border-input" placeholder="Last Name" value="<?php echo (isset($last_name) ? $last_name : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Email address</label>
                                          <input type="email" name="admin_email" class="form-control border-input" placeholder="Email" 
                                          value="<?php echo (isset($admin_email) ? $admin_email : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Phone</label>
                                          <input type="phone" name="admin_phone" class="form-control border-input" placeholder="Phone"
                                          value="<?php echo (isset($admin_phone) ? $admin_phone : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Address</label>
                                          <input type="text" name="address" class="form-control border-input" placeholder="Address" value="<?php echo (isset($address) ? $address : ''); ?>">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>City</label>
                                          <input type="text" name="city" class="form-control border-input" placeholder="City" value="<?php echo (isset($city) ? $city : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>State</label>
                                          <input type="text" name="state" class="form-control border-input" placeholder="State" value="<?php echo (isset($state) ? $state : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Postal Code</label>
                                          <input type="number" name="zip" class="form-control border-input" placeholder="ZIP Code" value="<?php echo (isset($zip) ? $zip : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                          <label>Country</label>
                                          <input type="text" name="country" class="form-control border-input" placeholder="Country" value="<?php echo (isset($country) ? $country : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="text-center clearfix" style="padding: 20px 0;">
                                  <button type="submit" class="btn btn-info btn-fill btn-wd">Update Settings</button>
                              </div>
                          </form>
                      </div>
                  </div>
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