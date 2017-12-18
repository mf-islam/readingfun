<!-- reader account -->
<div class="programs" id="readers_account">
      <div class="container">
        <h3 class="w3_agileits_head"><?php echo $page_title; ?></h3>
        <p class="w3_agile_elit"></p>  
        <div class="twenty_px_height"></div>
        <div class="agile_banner_bottom_grids">
            <?php include "new/template/account_left.php"; ?>
            <div class="col-lg-7 col-md-offset-1">
                    <div class="content">
                        <?php
                           //$attributes = array('class' => 'account_form', 'name' => 'readers_account', 'onSubmit' => 'return false;');
                           //echo form_open('', $attributes);
                        ?>
                        <?php echo form_open($form_action, $form_attributes); ?>
                              <div class="row">
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label>Username</label>
                                                <input name="username" disabled type="text" class="form-control border-input" placeholder="Username" value="<?php echo $reader_info->username; ?>">
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                          <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input name="email" type="email" class="form-control border-input" placeholder="Email" value="<?php echo $reader_info->email; ?>">
                                          </div>
                                    </div>
                              </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                        <input name="first_name" type="text" class="form-control border-input" placeholder="Company" value="<?php echo $reader_info->first_name; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control border-input" placeholder="Last Name" value="<?php echo $reader_info->last_name; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='form-group date' id="datepicker">
                                        <label class="control-label" for="birthdate">Birthday <span class="text-muted">(MM/DD/YYYY)</span></label>
                                        <input class="form-control datepicker" id="birthdate" name="birthdate" placeholder="MM/DD/YYY" type="text" value="<?php echo nice_date($reader_info->birthdate, 'm-d-Y'); ?>" />
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender <span class="text-primary">(optional)</span></label>
                                        <label class="custom-control custom-radio form-control">
                                          <input id="gender" <?php echo ((!empty($reader_info->gender) && $reader_info->gender == 'male' ? 'checked="checked"' : "")); ?> name="gender" type="radio" class="border-input custom-control-input" value="male">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">Male</span>&nbsp;&nbsp;&nbsp;
                                        
                                          <input id="gender" name="gender" <?php echo ((!empty($reader_info->gender) && $reader_info->gender == 'female' ? 'checked="checked"' : "")); ?> type="radio" class="custom-control-input" value="female">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">Female</span>&nbsp;&nbsp;&nbsp;

                                          <input id="gender" name="gender" <?php echo ((!empty($reader_info->gender) && $reader_info->gender == 'others' ? 'checked="checked"' : "")); ?> type="radio" class="custom-control-input" value="others">
                                          <span class="custom-control-indicator"></span>
                                          <span class="custom-control-description">Others</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input name="address" type="text" class="form-control border-input" placeholder="Address" value="<?php echo $reader_info->address; ?>" onFocus="geolocate()" id="autocomplete">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Apt/Suite</label>
                                        <input name="apt" type="text" class="form-control border-input" placeholder="Apt/suite" value="<?php echo $reader_info->apt; ?>">
                                    </div>
                                </div>
                            </div>
                            <input name="placeID" id="placeID" type="hidden" class="form-control border-input"value="<?php echo $reader_info->address_id; ?>" />
                            
                            <!-- Get google place search address field and country to inserted custom form field -->
                            <input class="field" type="hidden" id="street_number" disabled="true"></input>
                            <input class="field" type="hidden" id="route" isabled="true"></input>
                            <input class="field" type="hidden" id="country" disabled="true"></input>
                            <!-- End -->

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input name="city" id="locality" type="text" class="field form-control border-input" placeholder="City" value="<?php echo $reader_info->city; ?>"></input>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input name="state" id="administrative_area_level_1" type="text" class="form-control border-input" placeholder="State" value="<?php echo $reader_info->state; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ZIP</label>
                                        <input name="zip" id="postal_code" type="text" class="form-control border-input" placeholder="ZIP" value="<?php echo $reader_info->zip; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group has-success">
                                      <label class="custom-control custom-checkbox">
                                        <input type="checkbox" <?php echo ($reader_info->in_city == '1' ? 'checked="checked"' : ""); ?> name="i_am_in_city" class="custom-control-input" value="1">
                                        <span class="custom-control-indicator"></span>
                                        <span class="custom-control-description">I am currently living in <span id="current_city">above city</span></span>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="School Name">School name</label>
                                        <select class="form-control" id="school_id" name="school_id">
                                        <option value="">-- Select School -- </option>
                                        <?php if ($schools) { ?>
                                        <?php foreach ($schools as $schools) { ?>
                                          <option <?php echo (($reader_info->school_id == $schools->id) ? 'selected="selected"' : ''); ?> value="<?php echo $schools->id; ?>"><?php echo $schools->name . ', ' . $schools->city . ', ' . $schools->state . ' ' . $schools->zip ; ?></option>
                                          <?php } ?>
                                          <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="phone form-control border-input" placeholder="(XXX) XXX-XXX" value="<?php echo $reader_info->phone; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Library Card Number</label>
                                        <input name="library_id" type="text" class="form-control border-input" placeholder="Library Card ID" value="<?php echo $reader_info->library_id; ?>">
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control border-input" placeholder="Home Address" value="Melbourne, Australia">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control border-input" placeholder="City" value="Melbourne">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <input type="text" class="form-control border-input" placeholder="Country" value="Australia">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Postal Code</label>
                                        <input type="number" class="form-control border-input" placeholder="ZIP Code">
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Me</label>
                                        <textarea rows="5" class="form-control border-input" placeholder="Here can be your description" value="Mike">Oh so, your weak rhyme
                                You doubt I'll bother, reading into it
                                I'll probably won't, left to my own devices
                                But that's the difference in our opinions.
                                </textarea>
                                    </div>
                                </div>
                                </div>-->
                            <div class="text-center">
                                <br />
                                <a href="<?php echo base_url(); ?>/readers/change_password<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class="btn btn-simple">Change Password</a> <button type="submit" class="btn btn-info btn-fill btn-wd" onClick="document.readers_account.submit()">Update Profile</button>
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

<!-- a little test to get address details from Google using PlaceID -->
<!--<script type="text/javascript">
$(document).ready(function() {
    var placeId = '<?php echo $reader_info->address_id; ?>'
    $.ajax({
        type: 'GET', 
        url: "<?php echo base_url(); ?>books/getAddressByPlaceid/?place_id=" + placeId,
        dataType: "json",
        success: function (json) {
            
            $('input[name=address]').val(json.street);
            $('input[name=city]').val(json.city);
            $('input[name=state]').val(json.state);
            $('input[name=zip]').val(json.zip);

        }
    });
});
</script>-->


