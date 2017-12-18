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
                      <div class=" card-plain">
                          <div class="text-center">
                              <div class="category">Enter your account email to get password reset email<br /><br></div>
                          </div>
                          
                          <div class="content">
                              <div class="form-group">
                                  <input type="email" required="true" name="email" placeholder="Enter email" class="form-control">
                              </div>
                          </div>
                          <div class="twenty_px_height"></div>
                          <div class=" text-center">
                              <button type="submit" class="btn btn-fill btn-danger btn-wd">Recover password</button>
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
<!-- //forgot -->
