<!-- reader change password -->
<div class="programs" id="readers_account">
      <div class="container">
        <h3 class="w3_agileits_head"><?php echo $page_title; ?></h3>
        <p class="w3_agile_elit"></p>  
        <div class="twenty_px_height"></div>
        <div class="agile_banner_bottom_grids">
        <?php include "new/template/account_left.php"; ?>
            <div class="col-lg-7 col-md-offset-1">
                <div class="">
                    <div class="header">
                        
                    </div>
                    <div class="content">
                        <?php
                               $attributes = array('class' => 'change_password', 'name' => 'change_password');
                               echo form_open('', $attributes);
                            ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Current email</label>
                                            <input name="email" type="email" class="form-control border-input" placeholder="Email" value="<?php echo $reader_info->email; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Current password</label>
                                            <input name="old_password" type="text" class="form-control border-input" placeholder="Old Password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input name="password" type="text" class="form-control border-input" placeholder="New Password" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input name="confirm_password" type="text" class="form-control border-input" placeholder="Confirm Password" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <br />
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update Password</button>
                                </div>
                                <div class="clearfix"></div>
                            <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
<!-- //reader account -->


<script type="text/javascript">
    $().ready(function(){
        $('<?php echo "#".$form_attributes['id']; ?>').validate();
        $('#loginFormValidation').validate();
        $('#allInputsFormValidation').validate();
    });
</script>
<script type="text/javascript">
    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 3000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
</script>
