<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Add new book by ISBN or Title</h4>
                        <p class="category"><star>*</star> ISBN will give exact result</p>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 text-center">
                            <form data-toggle="validator" role="form">
                                    <div class="content">
                                    <div class="form-group required has-feedback">
                                        <input type="text" id="search" placeholder="Enter ISBN or Title" required autofocus="autofocus" class="form-control"/>
                                        <span class="glyphicon glyphicon-barcode form-control-feedback" style="font-size:24px; margin-top:-11px!important"></span>
                                    </div>
                                    <span class="help-block text-warning"><star>*</star> Enter ISBN to get more precise result</span>
                                        <br><br>
                                        <button type="submit" id="getInfo"  class="btn btn-fill btn-info">Get Information</button>
                                        <br><br>
                                    </div>
                                    </form>
                            </div> <!--  end col-md-6  -->
                        </div>

                        <!-- show result -->
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1 text-center">
                                <hr>
                                <div class="" id="results">ccc</div>
                            </div> <!--  end col-md-6  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>              
    </div>
</div>

<script type="text/javascript">
  $("#getInfo").click(function() {
    
    var search = document.getElementById('search').value
    var q = ""
    if($.isNumeric(search))
        q = "isbn=" + parseInt(search)
    else q = "title=" + search

    console.log("<?php echo base_url(); ?>books/bookSearch/?" + q)
    $.ajax({
      type: "GET",
      url: "<?php echo base_url(); ?>books/bookSearch/?" + q,
      dataType: 'json',
     // beforeSend: function () {
      //  $( "div#content" ).scrollTop( 300 );
      //  $('img#loading').show();
     // },
      success: function (json) {
        if (json.error) {
          alert (json.error);
          $('img#loading').fadeOut();
        } else {
          alert(json.bib_key);
        }
      }
    });
  });
</script>

<!--<script>
function booksearch() {
    //console.log('this function workds')
    var search = document.getElementById('search').value
    var q = ""
    if($.isNumeric(search))
        q = "isbn=" + parseInt(search)
    else q = "title=" + search

    console.log("<?php echo base_url(); ?>books/bookSearch/?" + q)

    //document.getElementById('results').innerHTML = ""

    $.ajax({
        url: "<?php echo base_url(); ?>books/bookSearch/?" + q,
        dataType: "json",

        success: function(data) {
            console.log(data)

        },

        type: 'GET'
    });
}

document.getElementById('getInfo').addEventListener('click', booksearch, false)
</script>-->

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

