	<!--<div class="row">
		<div class="w3_agileits_twitter_post">
			<div class="container">
				<h4>"Pellentesque habitant morbi tristique senectus et netus <a href="#">
					http://example.com</a> egestas."</h4>
			</div>
		</div>
	</div>-->
	<div class="w3layouts_copy_right row">
		<div class="container">
			<p>&copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.fimaruf.com">Md Fakhrul Islam</a> . All rights reserved&nbsp;&nbsp;|&nbsp;&nbsp;<span class="text-muted"><a href="<?php echo base_url(); ?>disclaimer">Disclaimer</span></p>
		</div>
	</div>
</div><!-- end container -->
		<script src="<?php echo base_url(); ?>assets/new/js/bootstrap.js"></script>

		<!-- //for bootstrap working -->
		<script src="<?php echo base_url(); ?>assets/new/js/custom.js"></script>

		<!--  Notifications Plugin    -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

		<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
		<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>

		<!--  Date Time Picker Plugin is included in this js file -->
		<script src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js"></script>

		<script type="text/javascript">
			$('.phone')

			.on('keypress', function(e) {
			  var key = e.charCode || e.keyCode || 0;
			  var phone = $(this);
			  if (phone.val().length === 0) {
			    phone.val(phone.val() + '(');
			  }
			  // Auto-format- do not expose the mask as the user begins to type
			  if (key !== 8 && key !== 9) {
			    if (phone.val().length === 4) {
			      phone.val(phone.val() + ')');
			    }
			    if (phone.val().length === 5) {
			      phone.val(phone.val() + ' ');
			    }
			    if (phone.val().length === 9) {
			      phone.val(phone.val() + '-');
			    }
			    if (phone.val().length >= 14) {
			      phone.val(phone.val().slice(0, 13));
			    }
			  }

			  // Allow numeric (and tab, backspace, delete) keys only
			  return (key == 8 ||
			    key == 9 ||
			    key == 46 ||
			    (key >= 48 && key <= 57) ||
			    (key >= 96 && key <= 105));
			})

			.on('focus', function() {
			  phone = $(this);

			  if (phone.val().length === 0) {
			    phone.val('(');
			  } else {
			    var val = phone.val();
			    phone.val('').val(val); // Ensure cursor remains at the end
			  }
			})

			.on('blur', function() {
			  $phone = $(this);

			  if ($phone.val() === '(') {
			    $phone.val('');
			  }
			});
		</script>
		<!-- Notification -->
		<script>
		$(function(){
			<?php if (isset($_SESSION['message'])): ?>
		  <?php foreach ($_SESSION['message'] as $key => $value) { ?>
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
		    $().ready(function(){
		        // Init DatetimePicker
		        custom.initDatetimepickers();
		    });
		</script>
		<script>
		var date=new Date();
		$('#birthdate').datetimepicker({
		    useCurrent: true, //this is important as the functions sets the default date value to the current value 
		    format: 'MM/DD/YYYY',
		    maxDate: date
		});
		</script>

		<script>
		var date=new Date();
		$('.readDate').datetimepicker({
		    useCurrent: true, //this is important as the functions sets the default date value to the current value 
		    format: 'MM-DD-YYYY',
		    maxDate: date
		});
		</script>

		<script>
  // This example displays an address form, using the autocomplete feature
  // of the Google Places API to help users fill in the information.

  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  var placeSearch, autocomplete;
  var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
  };

  function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode', 'establishment']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    //console.log(place);

    for (var component in componentForm) {
      document.getElementById(component).value = '';
      document.getElementById(component).disabled = false;
    }

console.log(place.address_components);
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
      var addressType = place.address_components[i].types[0];
      if (componentForm[addressType]) {
        var val = place.address_components[i][componentForm[addressType]];
        
        if (addressType == 'street_number') {
            var address = val;
        }

        if (addressType == 'route') {
            address = address + ' '+val;
        }

        if (addressType == 'locality') {
            var city = val;
        }  

        document.getElementById(addressType).value = val;

      }
    }

    document.getElementById('autocomplete').value = address;
    $('span#current_city').text(city);
    $('input#placeID').val(place.place_id);
  }
  // Bias the autocomplete object to the user's geographical location,
  // as supplied by the browser's 'navigator.geolocation' object.
  function geolocate() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
        var geolocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        var circle = new google.maps.Circle({
          center: geolocation,
          radius: position.coords.accuracy
        });
        autocomplete.setBounds(circle.getBounds());
      });
    }
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google_api'); ?>&libraries=places&callback=initAutocomplete"></script>
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
	</body>
</html>

<?php
	if(!empty($_SESSION['in_sub_domain']['menu_color'])){
?>
<style>
    .navbar-default .navbar-nav > li > a{
        color: <?php echo $_SESSION['in_sub_domain']['menu_color']; ?> !important;
    }
	
	#about_home{
		font-size: <?php echo $_SESSION['in_sub_domain']['body_font_size']; ?>px !important;
	}
	
	.title{
		font-size: <?php echo $_SESSION['in_sub_domain']['title_font_size']; ?>px !important;
	}
	
	.text-effect{
		color: <?php echo $_SESSION['in_sub_domain']['body_link_color']; ?> !important;
	}
</style>
<?php
 }

?>