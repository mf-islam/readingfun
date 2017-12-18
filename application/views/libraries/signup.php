
<div class="programs">
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<?php echo form_open($form_action, $form_attributes); ?>
					<div class="card-plain">
                        <div class="content">
							<div class="row">
								<h3>Library Details</h3>
								<p>&nbsp;</p>
							</div>
                        	<div class="row">
                        		<div class="form-group">
					  				<label class="sr-only" for="inlineFormInput">Library name</label>
					  				<input type="text" name="library_name" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Library name" required="true">
					  			</div>
                        	</div>
                          	<div class="row">
	                        	<div class="form-group">
                                    <input name="address" type="text" class="form-control border-input" placeholder="Address" required="true" onFocus="geolocate()" id="autocomplete">
                                </div>
	                            <input name="placeID" id="placeID" type="hidden" class="form-control border-input"  />
	                            
	                            <!-- Get google place search address field and country to inserted custom form field -->
	                            <input class="field" type="hidden" id="street_number" disabled="true"></input>
	                            <input class="field" type="hidden" id="route" isabled="true"></input>
	                            <input class="field" type="hidden" id="country" disabled="true"></input>
	                            <!-- End -->

	                            <div class="row">
	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <input name="city" id="locality" type="text" class="field form-control border-input" placeholder="City"  required="true"></input>
	                                    </div>
	                                </div>
	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <input name="state" id="administrative_area_level_1" type="text" class="form-control border-input" placeholder="State" required="true">
	                                    </div>
	                                </div>
	                                <div class="col-md-4">
	                                    <div class="form-group">
	                                        <input name="zip" id="postal_code" type="text" class="form-control border-input" placeholder="ZIP" required="true">
	                                    </div>
	                                </div>
	                            </div>
	                        </div>  
	                        <div class="row">
	                        	<!--
                   				in database libraries table there is a field named type where value type is ENUM
                   				and value set is 'self-hosted', 'plans'
                   				-->
                          		<div class="form-group">
                          			<label for="installationType">Installation type :</label>&nbsp;&nbsp;&nbsp;
                          			
									  <input id="radio1" name="installation_type" checked="checked" value="self" type="radio" class="custom-control-input">
									  <span class="custom-control-indicator"></span>
									  <span class="custom-control-description">Self-hosted</span>&nbsp;&nbsp;&nbsp;
									
									  <input name="installation_type" type="radio" value="subdomain" class="custom-control-input conditional_control">
									  <span class="custom-control-indicator"></span>
									  <span class="custom-control-description">Plans</span>
									
										<br />
									  	<div class="reveal-if-active">
									  		<div class="row" style="bottom: 0px!important;">
											  	<div class="form-group  col-md-8">
									  				<label class="sr-only" for="inlineFormInputGroup">Subdomain</label>
									  				<div class="input-group mb-2 mr-sm-2 mb-sm-0">
										  				<input type="text" name="library_slug" class="form-control" id="subdomain" placeholder="subdomain">
										    			<div class="input-group-addon">.readingfun.us</div>
									    			</div>
									  			</div>
									  			<div class="col-md-4">
									  				<button type="button" id="checkDomainAvailability" class="btn btn-success text-primary">Check availablity</button>
									  			</div>
								  			</div>
								  			<div class="row text-muted" style="padding-left: 17px; margin-top: -10px; float: left;">
								  				** check for plan pricing here
								  			</div>
							  			</div>
									<!-- https://codepen.io/memco/pen/BajpD -->
                          		</div>
	                        </div>
							<div class="row">
								<hr>
							</div>
							<div class="row">
								<h3>Library Admin Details</h3>
								<p>&nbsp;</p>
							</div>
							<div class="row">
								<div class="form-group">
									<input type="text" name="firstName" placeholder="Your First Name" class="form-control" required="true">
								</div>
								<div class="form-group">
									<input type="text" name="lastName" placeholder="Your Last Name" class="form-control">
								</div>
								<!--<div class="form-group">
									<input type="text" required="true" name="username" placeholder="Enter Username" class="form-control">
								</div>-->
								<div class="form-group">
									<input type="email" required="true" name="email" placeholder="Enter email" class="form-control">
								</div>
								<div class="form-group">
									<input type="password" id="password" required="true" name="password" placeholder="Password" class="form-control">
								</div>
								<div class="form-group">
									<input type="password" name="passwordConfirm" placeholder="Password Confirmation" class="form-control" equalTo="#password" required="true">
								</div>
							</div>
	                        <hr>
	                        <div class="row text-center">
	                        	<button type="submit" class="btn btn-primary" id="library-info-submit-btn">Submit</button>
	                        </div>
					  	</div>
					  </div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- check if the subdomain available -->
<script type="text/javascript">
	
$('#library-info-submit-btn').on('click', function(){
	var errFirstFrm = 0;

	if ($("input[name='installation_type']:checked").val() == 'subdomain') {
        if($.trim($('#subdomain').val()) == ''){
			$('#subdomain').addClass('error');			
			errFirstFrm = 1;
		}else{
			$('#subdomain').removeClass('error');
		}
    }
});
	
	
	
	
$("button#checkDomainAvailability").click(function() {
	var subdomain = document.getElementById('subdomain').value
	var text = "";
	//alert(subdomain);
	
	// check if there is no subdomain entered
	if (subdomain == "") {
		alert('Domain name can not be empty');
		return;
	}

	// check domain name is more than 3 characters
	else if(subdomain.length < 4) {
		alert('Domain name needs to be more than 3 characters');
		return;
	}

	// finally call through AJAX 
	$.ajax({
	    url: "<?php echo base_url(); ?>libraries/checkSubDomain/?subdomain=" + subdomain,
	    type : 'GET',
	    dataType:'json',
	    success : function(data) { 
	    	// if returned 1 then subdomain is available
	    	if (parseInt(data) === 1) {
	    		text = '<span class="text-success">Available</span>';
	    	} else text = '<span class="text-danger">Not available</span>';

	    	$("#checkDomainAvailability").parent().html(text); 
	    	//$("#checkDomainAvailability").parent().html('<span class="text-success">' + parseInt(data) + '</span>');             
	        $("#checkDomainAvailability").fadeOut(fast);
	    },
	    error : function(request,error)
	    {
	        alert("Request: "+JSON.stringify(request));
	    }
	});
});
</script>

<script type="text/javascript">
    $().ready(function(){
        $('<?php echo "#".$form_attributes['id']; ?>').validate();
        $('#loginFormValidation').validate();
        $('#allInputsFormValidation').validate();
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