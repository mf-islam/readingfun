<!-- admin/readers -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <?php if($badges_point_settings){ ?>
                            <?php echo form_open($form_action, $form_attributes); ?>
                                <?php foreach ($badge_item as $badge_item) { ?>
                                <?php foreach($badges_point_settings as $key => $val){ if($badge_item->id == $val->id){ ?>
                                    <div class="row col-md-8 col-md-offset-2">
                                        <div class="col-md-4">
                                            <label class="checkbox <?php echo (($val->is_active == '1') ? 'checked' : ''); ?>">
                                                <input type="checkbox" id="badge" <?php echo (($val->is_active == '1') ? 'checked="checked"' : ''); ?> name="<?php echo $badge_item->id; ?>[name]" data-toggle="checkbox" value="<?php echo $badge_item->name; ?>">
                                                <?php echo $badge_item->title; ?>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text"  name="<?php echo $badge_item->id; ?>[points]" class="form-control border-input" placeholder="enter point" value="<?php echo $val->point; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?php echo base_url() . 'assets/icon/' . $badge_item->badge_img; ?>" width="40" />
                                        </div>
                                    </div>
                                <?php }}} ?>
                                <div class="clearfix"></div>
                                <div class="text-center clearfix" style="padding: 20px 0;">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update Badge</button>
                                </div>
                            <?php echo form_close(); ?>
                        <?php }else{ ?>
                            <?php echo form_open($form_action, $form_attributes); ?>
                                <?php foreach ($badge_item as $badge_item) { ?>
                                    <div class="row col-md-8 col-md-offset-2">
                                        <div class="col-md-4">
                                            <label class="checkbox">
                                                <input type="checkbox" id="badge" name="<?php echo $badge_item->id; ?>[name]" data-toggle="checkbox" value="<?php echo $badge_item->name; ?>">
                                                <?php echo $badge_item->title; ?>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text"  name="<?php echo $badge_item->id; ?>[points]" class="form-control border-input" placeholder="enter point" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?php echo base_url() . 'assets/icon/' . $badge_item->badge_img; ?>" width="40" />
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                                <div class="text-center clearfix" style="padding: 20px 0;">
                                    <button type="submit" class="btn btn-info btn-fill btn-wd">Update Badge</button>
                                </div>
                            <?php echo form_close(); ?>
                        <?php } ?>
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
<script>
$("label.checkbox").change(function() {
  $checkbox = $(this).children('input:checkbox#point')
  checked = $checkbox.is(':checked') // first time it will return true
  $checkbox.attr('checked', checked)
});
</script>

