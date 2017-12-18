<!-- forgot form -->
<div class="programs">
  <div class="container">
    <h3 class="w3_agileits_head"><?php echo $page_title; ?></h3>
    <p class="w3_agile_elit"></p>  
    <div class="agile_banner_bottom_grids">
        <div class="login-page">
          <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
          <div class="content">
            <div class="container">
                <div class="row">
                    <br />
                    <div class="col-md-4 col-md-offset-4">
                      <?php echo form_open($form_action, $form_attributes); ?>
                      <div class="form-group">
                          <label for="new_password"><?php echo sprintf('New Password (at least %s characters long):', $min_password_length);?></label> <br />
                          <input type="password" required="true" name="new" placeholder="New password" id="new" class="form-control">
                      </div>
                      <div class="form-group">
                          <label for="confirm_password">Confirm new password</label> <br />
                          <input type="password" required="true" name="new_confirm" id="new_confirm" placeholder="Confirm password" class="form-control">
                      </div>
                          <div class="twenty_px_height"></div>
                          <div class=" text-center">
                              <button type="submit" class="btn btn-fill btn-danger btn-wd">Recover password</button>
                          </div>
                          <?php echo form_input($user_id);?>
                          <?php echo form_hidden($csrf); ?>
                          <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>