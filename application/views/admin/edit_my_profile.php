
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
                                <h4>Library Details</h4>
                                <hr>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Library / Site title</label>
                                          <input type="text" required="true" name="library_name" id="library_name" class="field form-control border-input" placeholder="Company" value="<?php echo (isset($libraryDetails->library_name) ? $libraryDetails->library_name : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Library Email address</label>
                                          <input type="email" required="true" name="email" class="field form-control border-input" placeholder="Email" 
                                          value="<?php echo (isset($libraryDetails->email) ? $libraryDetails->email : ''); ?>" autocomplete="off">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Address</label>
                                          <input type="text" required="true" name="address" onFocus="geolocate()" id="autocomplete" class="field form-control border-input" placeholder="Address" value="<?php echo (isset($libraryDetails->address) ? $libraryDetails->address : ''); ?>">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>City</label>
                                          <input type="text" required="true" name="city" id="locality" class="field form-control border-input" placeholder="City" value="<?php echo (isset($libraryDetails->city) ? $libraryDetails->city : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>State</label>
                                          <input type="text" required="true" name="state" id="administrative_area_level_1" class="field form-control border-input" placeholder="State" value="<?php echo (isset($libraryDetails->state) ? $libraryDetails->state : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label>Postal Code</label>
                                          <input type="number" required="true" name="zip" id="postal_code" class="field form-control border-input" placeholder="ZIP Code" value="<?php echo (isset($libraryDetails->zip) ? $libraryDetails->zip : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="text-center clearfix" style="padding: 20px 0;">
                                  <button type="submit" class="btn btn-info btn-fill btn-wd">Update Settings</button>
                              </div>
                              <h4>Personal Details</h4>
                                <hr>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" required="true" name="first_name" class="field form-control border-input" placeholder="First name" value="<?php echo (isset($userDetails->first_name) ? $userDetails->first_name : ''); ?>">
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Last name</label>
                                          <input type="text" required="true" name="last_name" class="field form-control border-input" placeholder="Last Name" value="<?php echo (isset($userDetails->last_name) ? $userDetails->last_name : ''); ?>">
                                      </div>
                                  </div>
                              </div>
                          <?php echo form_close(); ?>
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