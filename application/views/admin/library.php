

<!-- admin/readers -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="readersInfo" class="panel-collapse collapse card">
                    <div class="content panel-body">
                        <div class="row col-md-12">
                            <div class="col-md-8">
                              <div class="header" style="margin-bottom:20px;">
                                  <h4 class="title margin-0"><span id="name"></span></h4>
                                  <span class="category"><span id="since"></span></span>
                              </div>
                            </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="ti-email"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers" style="font-size: 1.1em !important;">
                                                    <p>Library Email</p>
                                                    <span id="email"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-direction"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers" style="font-size: 1.1em !important;">
                                                    <p>Address</p>
                                                    <span id="address"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="twenty_px_height"></div> 

                        <div class="row col-md-12 text-center">
                            <button type="submit" id="close_readerInfo"  class="btn btn-fill btn-warning">Close</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="twenty_px_height"></div> 
                    </div>
                </div>
                <div class="card">
                    <div class="content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <div class="fresh-datatables">
                            <table id="datatables" class="table table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Library Name</th>
                                    <th>Type</th>
                                    <th>Created By</th>
                                    <th>Crated On</th>
                                    <th class="disabled-sorting">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($library)) { 
                                    foreach ($library as $library) {
                                ?>
                                <tr>
                                    <td class="text-center" id="uid"><?php echo $library['library_name']; ?></td>
                                    <td><?php echo $library['type']; ?></td>
                                    <td>
                                        <?php echo $library['first_name'] .' '.$library['last_name']; ?><br />
                                    </td>
                                    <td><?php echo @date('Y-m-d',strtotime($library['created_on'])); ?></td>
                                    <td>
                                        <btn id="getInfo" class="btn btn-simple btn-danger collapsed" data-toggle="collapse" href="#readersInfo" data-id="<?php echo $library['library_id']; ?>">Show more</btn>
                                    </td>
                                </tr>
                                <?php } ?>
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
<!-- Sweet Alert 2 plugin -->

<script type="text/javascript">
  $('button#tryMe').on('click',function(e){
    e.preventDefault();
    var uid = $(this).parent().find('#uid').html();

    //alert (uid);
    //var form = $('form#addPoints');
    swal({
        title: "Enter point to add",
        text: "You will not be able to recover this imaginary file!",
        html:'<p><form id="addPoint" action="<?php echo base_url(); ?>admin/readers" method="post"><input name="uid" type="hidden" value="'+ uid +'" /><input required="true" name="points" class="form-control"><br><button type="submit" class="btn btn-danger btn-fill">Add points</button></form>',
        type: "warning",
        showCancelButton: false,
        showConfirmButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true
    });
});
</script>
<!--  Plugin for DataTables.net  -->

<script type="text/javascript">
    
    $('#sel1').on('change', function(){
        window.location.replace("/admin/readers?s="+$('#sel1').val());
    });
    
    
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#books_datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            responsive: true,
            language: {
            search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('#books_datatables').DataTable();
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

<script type="text/javascript">
$( "btn#getInfo" ).each(function(index) {
    $(this).on("click", function(){
        if($(this).hasClass('btn-danger')) {
          $( "btn#getInfo" ).addClass('btn-danger');
          $(this).removeClass('btn-danger').addClass('btn-success');
        }

        if ($('div#readersInfo').hasClass('in')) {
            $(this).removeClass('collapsed');
            $(this).attr('href', '');
        }
        var libraryid = parseInt($(this).data('id'))
        
        $.ajax({
          type: "GET",
          url: "<?php echo base_url(); ?>admin/getLibraryDetails/?id=" + libraryid,
          dataType: 'json',
          success: function (json) {
            if (json.error) {
              alert (json.error);
              $('img#loading').fadeOut();
            } else {
              console.log(json);
              $('span#address').html(json.details.address+','+json.details.city+','+json.details.state);
              $('span#email').html(json.details.email);
              $('span#since').html(' since '+json.details.created_on);
              $('span#name').html(json.details.library_name);
            }
          }
        });
    });
});

$('button#close_readerInfo').on("click", function(){
    if ($('div#readersInfo').hasClass('in')) {
        $('div#readersInfo').removeClass('in');
        $('div#readersInfo').slideUp(300);
    }
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

