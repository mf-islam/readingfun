<!-- Login form -->
<div class="programs">
  <div class="container">
    <h3 class="w3_agileits_head"><span class="w3_child">S</span><span class="w3_child1">i</span><span class="w3_child4">g</span><span class="w3_child1">n</span><span class="w3_child5">i</span><span class="w3_child1">n</span> now</h3>
    <p class="w3_agile_elit"></p>  
    <div class="agile_banner_bottom_grids">
        <div class="login-page">
          <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
          <div class="content">
            <div class="container">
                <div class="row">
                    <br />
                    <div class="col-md-8 col-md-offset-2">
                        <?php echo form_open($form_action, $form_attributes); ?>
                            <div class="card-plain" data-background="color" data-color="blue">
                                <div class="content col-md-6 col-md-offset-3">
                                    
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Enter email" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password" class="form-control">
                                    </div>  
                                </div>
                                <div class="content col-md-6 col-md-offset-3 text-center">
                                    <button type="submit" class="btn btn-fill btn-success btn-wd">Login</button>
                                      <div class="twenty_px_height"></div>
                                      <div class="forgot">
                                          <a href="<?php echo base_url(); ?>readers/forgot<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>">Forgot your password?</a>
                                      </div>
                                      <div class="forgot">
                                          Not registered yet ? <a href="<?php echo base_url(); ?>readers/signup<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>">Sign up</a> now
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
  </div>
</div>
<!-- //login -->

