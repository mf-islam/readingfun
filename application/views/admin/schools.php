<!-- admin/readers -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="content">
                        <div class="toolbar">
                            <div class="row col-md-12 text-right">
                              <button type="submit" id="add_school"  class="btn btn-text btn-danger">&nbsp;&nbsp;&nbsp;Add new School&nbsp;&nbsp;&nbsp;</button>
                              <div class="twenty_px_height"></div>
                            </div>

                            <div id="addNewSchool" class="panel-collapse collapse row col-md-10 col-md-offset-1">
                                <hr>
                                    <div class="content">
                                    <?php echo form_open($form_action, $form_attributes); ?>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label>School name</label>
                                                      <input type="text" name="name" class="form-control border-input" placeholder="School name" id="schoolName" value="">
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- Get google place search address field and country to inserted custom form field -->
                            <input class="field" type="hidden" id="street_number" disabled="true"></input>
                            <input class="field" type="hidden" id="route" isabled="true"></input>
                            <input class="field" type="hidden" id="country" disabled="true"></input>
                            <!-- End -->
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div class="form-group">
                                                      <label>Address</label>
                                                      <input type="text" id="school_address" name="street" class="form-control border-input" placeholder="Address" value="">
                                                  </div>
                                              </div>
                                          </div>

                                          <div class="row">
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label>City</label>
                                                      <input type="text" id="locality" name="city" class="form-control border-input" placeholder="City" value="">
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label>State</label>
                                                      <input type="text" id="administrative_area_level_1" name="state" class="form-control border-input" placeholder="State" value="">
                                                  </div>
                                              </div>
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label>Postal Code</label>
                                                      <input id="postal_code" type="number" name="zip" class="form-control border-input" placeholder="ZIP Code" value="">
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="text-center clearfix" style="padding: 20px 0;">
                                              <button type="submit" class="btn btn-fill btn-success">Add new School</button>
                                          </div>
                                      </form>
                                  </div>
                                <hr>
                                <div class="twenty_px_height"></div>
                            </div>
                        </div>
                
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Details</th>
                                    <th>#Students</th>
                                    <th>#books</th>
                                    <th>#duration</th>
                                    <th>#points</th>
                                </tr>
                            </thead>
                            <!--<tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>-->
                            <tbody>
                                 <?php if($schools){ ?>
                                    <?php if (isset($schools)) { 
                                        foreach ($schools as $schools) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $schools->id; ?></td>
                                        <td><?php echo $schools->name; ?></td>
                                        <td><?php echo $schools->street; ?><br>
                                        <?php echo $schools->city .', ' . $schools->state.' ' . $schools->zip; ?><br></td>
                                        <td><?php echo $schools->no_of_students; ?></td>
                                        <td><?php echo $schools->no_of_books; ?></td>
                                        <td id="duration"><?php echo $schools->duration; ?></td>
                                        <td><?php echo $schools->points; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php }else{ ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No School Created</td>
                                        </tr>
                                    <?php } ?>
                               </tbody>
                            </table>
                        </div>


                    </div>
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
        </div> <!-- end row -->
    </div>
</div>
<script type="text/javascript">
    $('#add_school').click('on', function(){
        $(this).toggleClass("btn-danger");
        $(this).text(function(i, text){
          if (text == "Close") {
            $('div#addNewSchool').slideUp(300);
          } else {
            $('div#addNewSchool').slideDown(300);
          }
          return text === "Close" ? "Add new School" : "Close";
        })
    });
</script>

<!--  Plugin for DataTables.net  -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
            search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#datatables').DataTable();
         // Edit record
         table.on( 'click', '.edit', function () {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert( 'You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.' );
         } );

         // Delete a record
         table.on( 'click', '.remove', function (e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
         } );

        //Like record
        table.on( 'click', '.like', function () {
            alert('You clicked on Like button');
         });

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
        /** @type {!HTMLInputElement} */(document.getElementById('school_address')),
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

//console.log(place.address_components);
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
    // get school name formatted
    var schoolField = school = document.getElementById('schoolName').value;
    var school = schoolField.split(',');
    document.getElementById('schoolName').value = school[0];
    document.getElementById('school_address').value = ((address) ? address : '');
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

