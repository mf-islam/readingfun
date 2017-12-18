<!-- Signup form -->
<div class="programs">
  <div class="container">
    <h3 class="w3_agileits_head"><span class="w3_child">S</span><span class="w3_child1">i</span><span class="w3_child4">g</span><span class="w3_child1">n</span><span class="w3_child5">u</span><span class="w3_child1">p</span> now</h3>
    <p class="w3_agile_elit">Signup today to enjoy the fun</p>
    <div class="agile_banner_bottom_grids">
        <div class="register-page">
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
    <div class="content">
      <div class="container">
          <div class="row">
              <br />
              <!--<div class="col-md-4 col-md-offset-2">
                  <div class="media">
                      <div class="media-left">
                          <div class="icon icon-danger">
                              <i class="ti ti-user"></i>
                          </div>
                      </div>
                      <div class="media-body">
                          <h5>Free Account</h5>
                          Here you can write a feature description for your dashboard, let the users know what is the value that you give them.
                      </div>
                  </div>
                  <div class="media">
                      <div class="media-left">
                          <div class="icon icon-warning">
                              <i class="ti-bar-chart-alt"></i>
                          </div>
                      </div>
                      <div class="media-body">
                          <h5>Awesome Performances</h5>
                          Here you can write a feature description for your dashboard, let the users know what is the value that you give them.
                      </div>
                  </div>
                  <div class="media">
                      <div class="media-left">
                          <div class="icon icon-info">
                              <i class="ti-headphone"></i>
                          </div>
                      </div>
                      <div class="media-body">
                          <h5>Global Support</h5>
                          Here you can write a feature description for your dashboard, let the users know what is the value that you give them.
                      </div>
                  </div>
              </div>-->
              <div class="col-md-6 col-md-offset-3">
                  <?php echo form_open($form_action, $form_attributes); ?>
                      <div class="card-plain">
                          <div class="content">
                              <div class="form-group">
                                  <input type="text" name="firstName" placeholder="Your First Name" class="form-control" required="true">
                              </div>
                              <div class="form-group">
                                  <input type="text" name="lastName" placeholder="Your Last Name" class="form-control">
                              </div>
                              <!--<div class="form-group">
                                  <input type="text" required="true" name="username" placeholder="Enter Username" class="form-control">
                              </div>-->
                              <div class="form-group">
                                  <input type="email" required="true" name="email" placeholder="Enter email" class="form-control">
                              </div>
                              <div class="form-group">
                                  <input type="password" id="password" required="true" name="password" placeholder="Password" class="form-control">
                              </div>
                              <div class="form-group">
                                  <input type="password" name="passwordConfirm" placeholder="Password Confirmation" class="form-control" equalTo="#password" required="true">
                              </div>
                              <div class="form-group">
                                        <select class="form-control" id="school_id" name="school_id">
                                        <option value="">Select School</option>
                                        <?php if ($schools) { ?>
                                        <?php foreach ($schools as $schools) { ?>
                                          <option value="<?php echo $schools->id; ?>"><?php echo $schools->name . ', ' . $schools->city . ', ' . $schools->state . ' ' . $schools->zip ; ?></option>
                                          <?php } ?>
                                          <?php } ?>
                                        </select>
                              </div>
                                <!--<div class="form-group">
                                    <input type="text" name="library_id" placeholder="Library ID" class="form-control">
                                </div>-->
                          </div>
                          <div class="twenty_px_height"></div>
                          <div class="text-center">
                              <button type="submit" class="btn btn-fill btn-danger btn-wd">Create Free Account</button>
                          </div>
                      </div>
                  <?php echo form_close(); ?>
              </div>
          </div>
      </div>
    </div>
</div>
    </div>
  </div>
</div>
<!-- //signup -->


<script type="text/javascript">
    $().ready(function(){
        $('<?php echo "#".$form_attributes['id']; ?>').validate();
        $('#loginFormValidation').validate();
        $('#allInputsFormValidation').validate();
    });
</script>
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