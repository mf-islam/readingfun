

<!-- admin/readers -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="sel1">Select Season </label>
                    <select class="form-control" id="sel1">
                        <option value="2015" <?php if(@$_GET['s'] == 2015){ echo "selected"; } ?>>2015</option>
                        <option value="2016" <?php if(@$_GET['s'] == 2016){ echo "selected"; } ?>>2016</option>
                        <option value="2017" <?php if(!isset($_GET['s'])){ echo "selected"; }else{ if(@$_GET['s'] == 2017){ echo "selected"; }} ?>>2017</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
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
                          <div class="col-md-4 text-right">
                              <button id="tryMe" class="btn btn-danger btn-fill">Add points to <span id="name"></span><span id="uid" style="display: none"></span></button>
                          </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-warning text-center">
                                                    <i class="ti-book"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Books read</p>
                                                    <span id="books"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="footer">
                                            <hr />
                                            <div class="stats">
                                                <i class="ti-reload"></i> Updated now
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-success text-center">
                                                    <i class="ti-face-smile"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Points collected</p>
                                                    <span id="points"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="footer">
                                            <hr />
                                            <div class="stats">
                                                <i class="ti-calendar"></i> Last day
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="card">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="icon-big icon-danger text-center">
                                                    <i class="ti-time"></i>
                                                </div>
                                            </div>
                                            <div class="col-xs-7">
                                                <div class="numbers">
                                                    <p>Minutes read</p>
                                                    <span id="duration"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="footer">
                                            <hr />
                                            <div class="stats">
                                                <i class="ti-timer"></i> In the last hour
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-md-4 text-center"><span class="text-muted">** click on number of books to see the list</span></div>
                        <div class="twenty_px_height"></div> 
                        <!--<div class="col-md-4">
                            <hr>
                         </div>
                         <div class="col-md-4 text-center text-danger">All books read by <span id="name"></span><span id="uid" style="display: none"></span></div>
                         <div class="col-md-4">
                            <hr>
                         </div>
                         <div class="row col-md-12">
                            <div class="fresh-datatables content table-responsive table-full-width">
                                <table id="books_datatables" class="table table-striped table-no-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Book ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>ISBN</th>
                                            <th>#duration</th>
                                            <th>date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="books">
                                        
                                     </tbody>
                                  </table>
                            </div>
                         </div>-->
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
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Name/email/phone </th>
                                    <th>#duration</th>
                                    <th>#points</th>
                                    <th class="disabled-sorting">Actions</th>
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
                                <?php if (isset($readers)) { 
                                    foreach ($readers as $readers) {
                                ?>
                                <tr>
                                    <td class="text-center" id="uid"><?php echo $readers->id; ?></td>
                                    <td><?php echo $readers->username; ?></td>
                                    <td>
                                        <?php echo $readers->first_name .' '.$readers->last_name; ?><br />
                                        <?php echo $readers->email; ?><br />
                                        <?php echo $readers->phone; ?>
                                    </td>
                                    <td id="duration"><?php echo $readers->duration; ?></td>
                                    <td><?php echo $readers->points; ?></td>
                                    <td>
                                        <btn id="getInfo" class="btn btn-simple btn-danger collapsed" data-toggle="collapse" href="#readersInfo" data-id="<?php echo $readers->id; ?>">Show more</btn>
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
        var userid = parseInt($(this).data('id'))
        $.ajax({
          type: "GET",
          url: "<?php echo base_url(); ?>admin/readers/getReaderDetails/?userid=" + userid,
          dataType: 'json',
          success: function (json) {
            if (json.error) {
              alert (json.error);
              $('img#loading').fadeOut();
            } else {
              console.log(json);
              $('span#points').html(json.TotalPoint);
              $('span#books').html('<a href="<?php echo base_url(); ?>admin/books/' + userid + '" class="text-warning">' + json.TotalBooks + '</a>');
              $('span#duration').html(json.TotalDuration);
              $('span#since').html(' since '+json.details.created_on);
              $('span#name').html(json.details.first_name  + ' ' + json.details.last_name);
              $('span#uid').html(json.details.id);
             /* var i;
              var html = '';
              for (i = 0; i < json.books.length; ++i) {
                html += '<tr>';
                html += '<td>'   + json.books[i]['book_id'] + '</td>';
                html += '<td>'   + json.books[i]['book_title'] + '</td>';
                html += '<td>'   + json.books[i]['author'] + '</td>';
                html += '<td>'   + json.books[i]['isbn'] + '</td>';
                html += '<td>'   + json.books[i]['duration'] + '</td>';
                html += '<td>' + json.books[i]['date'] + '</td>';
                
                html += '<tr>';
              }
              $('tbody#books').html(html);
              console.log(html);*/
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
  /*$("#getInfo").click(function() {
    var userid = $(this).data('id')

    alert (userid)
    var q = ""
    if($.isNumeric(search))
        q = "isbn=" + parseInt(search)
    else q = "title=" + search

    //console.log("<?php echo base_url(); ?>books/bookSearch/?" + q)
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
          $('div#showResult').show();
            $('#readLog #thumb').html('<img src="'+json.thumb+'" />');
            $('input[name=title]').val(json.title);
            $('input[name=author]').val(json.author);
            $('input[name=isbn]').val(json.isbn);
          $('span#thumb').html('<img src="'+json.thumb+'" />');
          $('span#title').html('<b>'+json.title+'</b>');
          $('span#author').html('<span class="text-muted">by </span>'+json.author);
          $('span#isbn').html('ISBN : '+json.isbn);
        }
      }
    });
  });*/
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

