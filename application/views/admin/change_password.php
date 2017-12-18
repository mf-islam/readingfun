
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-7">
                  <div class="card">
                      <div class="content">
                          <?php
                             $attributes = array('class' => 'change_password_form', 'autocomplete' => 'on', 'name' => 'change_password_form');
                             echo form_open('', $attributes);
                          ?>
                              <div class="row ">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="currentAdminEmail">Current Email</label>
                                          <input type="email" required="required" name="admin_email" class="form-control border-input" placeholder="Current Admin Email" value="<?php echo (isset($admin_email) ? $admin_email : ''); ?>" autocomplete="off">
                                          <div class="category"><star>*</star> Enter new admin email to change</div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="current_password">Current Password<star>*</star></label>
      <input type="password" class="form-control form-control-sm" id="current_password" name="old_password" placeholder="Current Password" />
                                      </div>
                                  </div>
                              </div>
                              <div class="row ">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="new_password">New Password</label>
      <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="New Password" />
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label for="current_password">Confirm Password<star>*</star></label>
      <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password" placeholder="Confirm new Password" />
                                      </div>
                                  </div>
                              </div>
                              
                              <div class="category"><star>*</star> Required fields</div>
                              
                              <div class="text-center clearfix" style="padding: 10px 0;">
                                  <button type="submit" class="btn btn-info btn-fill btn-wd">Update</button>
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
});
</script>