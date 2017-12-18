
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                  <div class="content" id="api">
                      <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                          <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                              <li class="active"><a href="#google" data-toggle="tab"><img src="<?php echo base_url(); ?>/assets/img/google_books.png" alt="" width="101" /><br />Google Books API</a></li>
                              <li><a href="#amazon" data-toggle="tab"><img src="<?php echo base_url(); ?>/assets/img/amazon.jpeg" alt="" width="132" /><br />Amazon</a></li>
                          </ul>
                        </div>
                      </div>
                      <?php $attributes = array('class' => 'form_horizontal', 'autocomplete' => 'on', 'name' => 'api');
                     echo form_open('', $attributes); ?>
                      <div id="my-tab-content" class="tab-content text-left">
                        <div class="tab-pane active" id="google">
                              <div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                  <input type="checkbox" name="google[active]" value="1" data-toggle="switch" class="ct-primary googleActive"/>
                                </div>
                                <div class="col-md-6">
                                 &nbsp;&nbsp;&nbsp;&nbsp;Make Active
                                </div>
                              </div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                    <input type="checkbox" name="google[isDefault]" value="1" data-toggle="switch" class="ct-primary googleIsDefault"/>
                                </div>
                                <div class="col-md-6">
                                  &nbsp;&nbsp;&nbsp;&nbsp;Make Default
                                </div>
                              </div>
                              <div class="twenty_px_height"></div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="google[url]">Enter Google API URL</label>
                                  <input type="text" name="google[url]" class="form-control border-input" placeholder="Google Books API Url" value="<?php echo (isset($google['url']) ? $google['url'] : ""); ?>" autocomplete="off">
                                  <div class="category"><star>+ </star>more details can be found here https://developers.google.com/books/</div>
                              </div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="google[key]">Enter Google API Key</label>
                                  <input type="text" name="google[key]" class="form-control border-input" placeholder="Google Books API KEY" value="<?php echo (isset($google['key']) ? $google['key'] : ""); ?>" autocomplete="off">
                                  <div class="category"><star>+ </star>https://console.developers.google.com</div>
                              </div>
                              
                        </div>
                        <!--<div class="tab-pane" id="openlibrary">
                        
                              <div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                  <input type="checkbox" name="openlibrary[active]" value="1" data-toggle="switch" class="ct-primary openlibraryActive"/>
                                </div>
                                <div class="col-md-6">
                                 &nbsp;&nbsp;&nbsp;&nbsp;Make Active
                                </div>
                              </div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                    <input type="checkbox" name="openlibrary[isDefault]" value="1" data-toggle="switch" class="ct-primary openlibraryIsDefault"/>
                                </div>
                                <div class="col-md-6">
                                  &nbsp;&nbsp;&nbsp;&nbsp;Make Default
                                </div>
                              </div>
                              <div class="twenty_px_height"></div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="openlibrary[url]">Enter Openlibrary API URL</label>
                                  <input type="text" name="openlibrary[url]" class="form-control border-input" placeholder="Open Library API Url" value="<?php echo (isset($openlibrary['url']) ? $openlibrary['url'] : ''); ?>" autocomplete="off">
                                  <div class="category"><star>+ </star>more details can be found here https://openlibrary.org/dev/docs/api/books</div>
                              </div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="openlibrary[key]">Enter Openlibrary API Key</label>
                                  <input type="text" name="openlibrary[key]" class="form-control border-input" placeholder="Open Library API KEY" value="<?php echo (isset($openlibrary['key']) ? $openlibrary['key'] : ''); ?>" autocomplete="off">
                              </div>
                        
                        </div>-->
                        <div class="tab-pane" id="amazon">
                        
                              <div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                  <input type="checkbox" name="amazon[active]" value="1" data-toggle="switch" class="ct-primary amazonActive"/>
                                </div>
                                <div class="col-md-6">
                                 &nbsp;&nbsp;&nbsp;&nbsp;Make Active
                                </div>
                              </div>
                              <!--<div class="form-group col-md-8 col-md-offset-2">
                                <div class="col-md-1">
                                    <input type="checkbox" name="amazon[isDefault]" value="1" data-toggle="switch" class="ct-primary amazonIsDefault"/>
                                </div>
                                <div class="col-md-6">
                                  &nbsp;&nbsp;&nbsp;&nbsp;Make Default
                                </div>
                              </div>-->
                              <div class="twenty_px_height"></div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="amazon[url]">Enter Aamzon API URL</label>
                                  <input type="text" name="amazon[url]" class="form-control border-input" placeholder="Amazon API Url" value="<?php echo (isset($amazon['url']) ? $amazon['url'] : ''); ?>" autocomplete="off">
                                  <div class="category"><star>+ </star>more details can be found here https://affiliate-program.amazon.com/</div>
                              </div>
                              <div class="form-group col-md-8 col-md-offset-2">
                                  <label for="amazon[key]">Enter Amazon API Key</label>
                                  <input type="text" name="amazon[key]" class="form-control border-input" placeholder="Amazon API KEY" value="<?php echo (isset($amazon['key']) ? $amazon['key'] : ''); ?>" autocomplete="off">
                              </div>
                        
                        </div>
                        <div class="footer text-center col-md-8 col-md-offset-2">
                        <p><br /><button type="submit" class="btn btn-fill btn-danger btn-wd">Submit</button></p>
                        </div>
                        <?php echo form_close(); ?>
                      <div class="clearfix"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(window).on('load', function() {
  <?php if (isset($google['active']) and ($google['active'] == '1')) {?>
    $('input[type=checkbox].googleActive').prop('checked', true);
    $('input[type=checkbox].googleActive').parent().removeClass('switch-off').addClass('switch-on');
  <?php } ?>
  <?php if (isset($google['isDefault']) and ($google['isDefault'] == '1')) {?>
    $('input[type=checkbox].googleIsDefault').parent().removeClass('switch-off').addClass('switch-on');
  <?php } ?>
  <?php if (isset($openlibrary['active']) and ($openlibrary['active'] == '1')) {?>
    $('input[type=checkbox].openlibraryActive').parent().removeClass('switch-off').addClass('switch-on');
  <?php } ?>
  <?php if (isset($amazon['active']) and ($amazon['active'] == '1')) {?>
    $('input[type=checkbox].amazonActive').parent().removeClass('switch-off').addClass('switch-on');
  <?php } ?>
  <?php if (isset($openlibrary['isDefault']) and ($openlibrary['isDefault'] == '1')) {?>
    $('input[type=checkbox].openlibraryIsDefault').parent().removeClass('switch-off').addClass('switch-on');
  <?php } ?>
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