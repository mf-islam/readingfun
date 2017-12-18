<!-- admin/readers -->

<link rel="stylesheet" media="screen" type="text/css" href="/assets/colorpicker/spectrum.css" />
<script type="text/javascript" src="/assets/colorpicker/spectrum.js"></script>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                            <?php
                                if($library_style_settings){
                                    $selectedMenuColor      = $library_style_settings->menu_color;
                                    $selectedMenuColorHover = $library_style_settings->menu_color_hover;
                                    $bodyFontSize           = $library_style_settings->body_font_size;
                                    $titleFontSize          = $library_style_settings->title_font_size;
                                    $bodyLinkColor          = $library_style_settings->body_link_color;
                                }else{
                                    $selectedMenuColor      = '#000000';
                                    $selectedMenuColorHover = '#fa3d03';
                                    $bodyFontSize           = 12;
                                    $titleFontSize          = 16;
                                    $bodyLinkColor          = '#23527c';
                                }
                            ?>
                            <?php echo form_open($form_action, $form_attributes); ?>
                                <div class="form-group col-md-8 col-md-offset-2">
                                    <div class="form-group col-md-8 col-md-offset-2">
                                        <div class="col-md-6 title">
                                            Menu Color
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border-input basic"/>
                                            <input type="hidden" id="cp1" name="menu_color" value="<?php echo $selectedMenuColor; ?>"/>
                                            <em id='basic-log'></em><em id='basic-log'></em>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8 col-md-offset-2">
                                        <div class="col-md-6 title">
                                            Menu Color Hover
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border-input basic2"/>
                                            <input type="hidden" id="cp2" name="menu_color_hover" value="<?php echo $selectedMenuColorHover; ?>"/>
                                            <em id='basic-log'></em><em id='basic-log'></em>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8 col-md-offset-2">
                                        <div class="col-md-6 title">
                                            Body Link Color
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control border-input basic3"/>
                                            <input type="hidden" id="cp3" name="body_link_color" value="<?php echo $bodyLinkColor; ?>"/>
                                            <em id='basic-log'></em><em id='basic-log'></em>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8 col-md-offset-2">
                                        <div class="col-md-6 title">
                                            Title Font Size
                                        </div>
                                        <div class="col-md-6">
                                           <input type="number" min="10" max="25" class="form-control border-input" name="title_font_size" value="<?php echo $titleFontSize; ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-8 col-md-offset-2">
                                        <div class="col-md-6 title">
                                            Body Font Size
                                        </div>
                                        <div class="col-md-6">
                                           <input type="number" min="10" max="18" class="form-control border-input" name="body_font_size" value="<?php echo $bodyFontSize; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center clearfix" style="padding: 20px 0;">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update Style</button>
                                </div>
                            <?php echo form_close(); ?>
                    </div>
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
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

<script type="text/javascript">
    $(".basic").spectrum({
        color: "<?php echo $selectedMenuColor; ?>",
        change: function(color) {
            $("#cp1").val(color.toHexString());
        }
    });
    
    $(".basic2").spectrum({
        color: "<?php echo $selectedMenuColorHover; ?>",
        change: function(color) {
            $("#cp2").val(color.toHexString());
        }
    });
    
    $(".basic3").spectrum({
        color: "<?php echo $bodyLinkColor; ?>",
        change: function(color) {
            $("#cp3").val(color.toHexString());
        }
    });
</script>
