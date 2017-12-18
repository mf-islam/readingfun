<!-- admin/readers -->
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <div class="card">
               <div class="content">
                  <div class="row col-md-10 col-md-offset-1">
                     <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="col-md-4 text-center text-danger">General</div>
                     <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="twenty_px_height"></div>
                     <div class="clearfix"></div>
                     <div class="twenty_px_height"></div>
                     <div class="twenty_px_height"></div>
                  </div>
                  <div class="row col-md-10 col-md-offset-1">
                     <?php echo form_open($form_action, $form_attributes); ?>
                     <?php if($general_settings){ ?>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show readers information on home page
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_readers" <?php foreach($general_settings as $setting){ if($setting->name == 'show_readers'){ if($setting->is_active == '1'){ ?> value="1" checked<?php }else{ ?> value="0" <?php }}} ?> data-toggle="switch" class="ct-primary  show_readers"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show top video in home page
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_video" <?php foreach($general_settings as $setting){ if($setting->name == 'show_video'){ if($setting->is_active == '1'){ ?> value="1" checked<?php }else{ ?> value="0" <?php }}} ?> data-toggle="switch" class="ct-primary  show_video"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Top School ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_school" <?php foreach($general_settings as $setting){ if($setting->name == 'show_school'){ if($setting->is_active == '1'){ ?> value="1" checked<?php }else{ ?> value="0" <?php }}} ?> data-toggle="switch" class="ct-primary  show_school"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Latest Books ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_latest_book" <?php foreach($general_settings as $setting){ if($setting->name == 'show_latest_book'){ if($setting->is_active == '1'){ ?> value="1" checked<?php }else{ ?> value="0" <?php }}} ?> data-toggle="switch" class="ct-primary  show_latest_book"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Top Books ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_book" <?php foreach($general_settings as $setting){ if($setting->name == 'show_book'){ if($setting->is_active == '1'){ ?> value="1" checked<?php }else{ ?> value="0" <?php }}} ?> data-toggle="switch" class="ct-primary  show_book"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of readers to show as Top Readers
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_readers" value="<?php foreach($general_settings as $setting){ if($setting->name == 'no_of_readers'){ echo $setting->is_active; break;}} ?>" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of books to show as Top Books
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_books" value="<?php foreach($general_settings as $setting){ if($setting->name == 'no_of_books'){ echo $setting->is_active; break;}} ?>" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of books to show as Latest Books
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_latest_books"  value="<?php foreach($general_settings as $setting){ if($setting->name == 'no_of_latest_books'){ echo $setting->is_active; break;}} ?>" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of school to show as Top School
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_schools" value="<?php foreach($general_settings as $setting){ if($setting->name == 'no_of_schools'){ echo $setting->is_active; break;}} ?>" />
                           </div>
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                           <p><br /><button id="submit" type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                        </div>
                     <?php }else{ ?>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show readers information on home page
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_readers" value="0" data-toggle="switch" class="ct-primary show_readers"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show top video in home page
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_video" value="0" data-toggle="switch" class="ct-primary  show_video"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Top School ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_school" value="0" data-toggle="switch" class="ct-primary  show_school"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Latest Books ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_latest_book" value="0" data-toggle="switch" class="ct-primary  show_latest_book"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Show Top Books ?
                           </div>
                           <div class="col-md-3">
                              <input type="checkbox" name="show_book" value="0" data-toggle="switch" class="ct-primary  show_book"/>
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of readers to show as Top Readers
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_readers" value="0" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of books to show as Top Books
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_books" value="0" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of books to show as Latest Books
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_latest_books" value="0" />
                           </div>
                        </div>
                        <div class="form-group col-md-8 col-md-offset-2">
                           <div class="col-md-7 title">
                              Number of school to show as Top School
                           </div>
                           <div class="col-md-3">
                              <input type="text" class="form-control border-input" name="no_of_schools" value="0" />
                           </div>
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                           <p><br /><button id="submit" type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                        </div>
                     
                     <?php } ?>
                     <?php echo form_close(); ?>
                     <div class="clearfix"></div>
                     <div class="twenty_px_height"></div>
                     <div class="twenty_px_height"></div>
                  </div>
                  <div class="row col-md-10 col-md-offset-1">
                    <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="col-md-4 text-center text-danger">Home page Video [mp4]</div>
                     <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="twenty_px_height"></div>
                     <div class="clearfix"></div>
                     <div class="twenty_px_height"></div>
                     <div class="twenty_px_height"></div>
                  </div>
                  <div class="row col-md-10 col-md-offset-1">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <?php echo form_open_multipart($form_upload_action, $form_upload_attributes);?>
                        <div class="file-upload-wrapper" data-text="Select your file!">
                          <input name="userfile" type="file" class="form-control file-upload-field" value="">
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                        <p><br /><button id="submit" type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                     </div>
                      <?php echo form_close(); ?>
                      <div class="clearfix"></div>
                     <div class="twenty_px_height"></div>
                     <div class="twenty_px_height"></div>
                     </div>
                  </div>
                  <div class="row col-md-10 col-md-offset-1">
                    <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="col-md-4 text-center text-danger">Logo [png only and 187x104]</div>
                     <div class="col-md-4">
                        <hr>
                     </div>
                     <div class="twenty_px_height"></div>
                     <div class="clearfix"></div>
                     <div class="twenty_px_height"></div>
                     <div class="twenty_px_height"></div>
                  </div>
                  <div class="row col-md-10 col-md-offset-1">
                    <div class="form-group col-md-8 col-md-offset-2">
                        <?php echo form_open_multipart($form_logo_upload_action, $form_logo_upload_attributes);?>
                        <div class="file-upload-wrapper" data-text="Select your file!">
                          <input name="logo" type="file" class="form-control file-upload-field" value="">
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                        <p><br /><button id="submit" type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                     </div>
                        <?php echo form_close(); ?>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="twenty_px_height"></div>
            </div>
            <!--  end card  -->
         </div>
         <!-- end col-md-12 -->
      </div>
      <!-- end row -->
   </div>
</div>
<script type="text/javascript">
  $("form#upload, form#upload_logo").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
  });
</script>
<?php
   $general_settings_array = array();
   
   if($general_settings){
      foreach($general_settings as $setting){
         $general_settings_array[$setting->name] = $setting->is_active;
      }
   }else{
      $general_settings_array = false;
   }
   

?>
<script type="text/javascript">
   
   
   
   
$(window).on('load', function() {
   <?php if($general_settings_array){ ?>
   
      <?php if (isset($general_settings_array['show_readers']) and ($general_settings_array['show_readers'] == "1")) {?>
        $('input[type=checkbox].show_readers').prop('checked', true);
        $('input[type=checkbox].show_readers').parent().removeClass('switch-off').addClass('switch-on');
      <?php } ?>
      <?php if (isset($general_settings_array['show_video']) and ($general_settings_array['show_video'] == "1")) {?>
        $('input[type=checkbox].show_video').prop('checked', true);
        $('input[type=checkbox].show_video').parent().removeClass('switch-off').addClass('switch-on');
      <?php } ?>
      <?php if (isset($general_settings_array['show_book']) and ($general_settings_array['show_book'] == "1")) {?>
        $('input[type=checkbox].show_book').prop('checked', true);
        $('input[type=checkbox].show_book').parent().removeClass('switch-off').addClass('switch-on');
      <?php } ?>
      <?php if (isset($general_settings_array['show_latest_book']) and ($general_settings_array['show_latest_book'] == "1")) {?>
        $('input[type=checkbox].show_latest_book').prop('checked', true);
        $('input[type=checkbox].show_latest_book').parent().removeClass('switch-off').addClass('switch-on');
      <?php } ?>
      <?php if (isset($general_settings_array['show_school']) and ($general_settings_array['show_school'] == "1")) {?>
        $('input[type=checkbox].show_school').prop('checked', true);
        $('input[type=checkbox].show_school').parent().removeClass('switch-off').addClass('switch-on');
      <?php } ?>
   <?php } ?>
});
</script>
<script type="text/javascript">
  $("#submit").click(function () {
    $('input:checkbox').each(function () {
      var name = $(this).attr('name');
        $(this).prop("checked") ? $(this).attr('value','1') : $(this).html("<input type='hidden' name='" + name + "' value='0' />");
    });
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