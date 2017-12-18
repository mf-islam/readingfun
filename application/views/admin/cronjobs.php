<!-- admin/readers -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                    	<div class="row col-md-10 col-md-offset-1">
	                    	<div class="col-md-4"><hr></div>
							<div class="col-md-4 text-center text-danger">Current Cron Jobs</div>
							<div class="col-md-4"><hr></div>
							<div class="twenty_px_height"></div>
							<div class="col-md-8 col-md-offset-2">
								<?php echo $current_cron; ?>
							</div>
							<div class="clearfix"></div>
							<div class="twenty_px_height"></div>
							<div class="twenty_px_height"></div>
						</div>
						
						<div class="row col-md-10 col-md-offset-1">
	                        <?php echo form_open($form_action, $form_attributes); ?>
	                        	<div class="row">
		                            <div class="col-md-4"><hr></div>
									<div class="col-md-4 text-center text-danger">Add new Cron Jobs</div>
									<div class="col-md-4"><hr></div>
		                            <div class="clearfix"></div>
		                        </div>
		                        <div class="row col-md-8 col-md-offset-2">
		                            <input type="text" name="add_cron" size="100" placeholder="e.g.: * * * * * curl <?php echo base_url(); ?>my_cron.php">
		                            <div class="clearfix"></div>
		                            <div class="twenty_px_height"></div>
									<div class="twenty_px_height"></div>
		                        </div>
		                        <div class="row">
		                            <div class="col-md-4"><hr></div>
									<div class="col-md-4 text-center text-danger">Remove Cron Jobs</div>
									<div class="col-md-4"><hr></div>
		                            <div class="clearfix"></div>
		                        </div>
		                        <div class="row col-md-8 col-md-offset-2">
		                            <input type="text" name="remove_cron" size="100" placeholder="e.g.: * * * * * /usr/local/bin/php -q <?php echo FCPATH; ?>my_cron.php">
		                            <div class="clearfix"></div>
		                        </div>
		                        <div class="row col-md-8 col-md-offset-2">
		                            <input type="checkbox" name="remove_all_cron" value="1"> Remove all cron jobs?
		                            <div class="clearfix"></div>
		                            <div class="twenty_px_height"></div>
									<div class="twenty_px_height"></div>
		                        </div>
		                        <div class="row col-md-8 col-md-offset-2">
		                            <div class="text-center clearfix" style="padding: 20px 0;">
		                                <button type="submit" class="btn btn-danger btn-fill btn-wd">Submit</button>
		                            </div>
		                        </div>
	                        <?php echo form_close(); ?>
	                        <div class="clearfix"></div>
							
                        </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="twenty_px_height"></div>
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