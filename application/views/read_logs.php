<!-- reader account -->
<div class="programs" id="readers_account">
      <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3"><h3 class="w3_agileits_head"><?php echo $page_title; ?></h3><p class="w3_agile_elit"></p></div>
            <div class="col-md-3"><button type="button" id="readNew" data-toggle="collapse" class="btn btn-fill btn-primary btn-wd">Reading something new ?</button></div>
        </div>
        <div class="twenty_px_height"></div>
        <div class="twenty_px_height"></div>
        <div class="twenty_px_height"></div>

        <div id="readLog" class="panel-collapse collapse card">
            <div class="content panel-body">
                <div class="col-md-4  text-center" id="thumb"></div>
               <div class="col-md-6 text-center">
                    <div class="content">   
                    <?php //echo form_open('readers/addNewReadLog?lib_id=<?php echo ($_SESSION['in_sub_domain']['lib_id'] ? $_SESSION['in_sub_domain']['lib_id'] : ''); ?>'); ?>
                        <form action="addNewReadLog?lib_id=<?php echo ($_SESSION['in_sub_domain']['lib_id'] ? $_SESSION['in_sub_domain']['lib_id'] : ''); ?>" method="post">
                        <div class="form-group required has-feedback">
                            <input type="text" name="title" readonly="readonly" placeholder="Book Title" required autofocus="autofocus" class="form-control" value="" />
                            
                        </div>
                        <div class="form-group required has-feedback">
                            <input type="text" name="author" readonly="readonly" placeholder="Book Author" required class="form-control" value="" />
                            
                        </div>
                        <div class="form-group required has-feedback">
                            <input type="text" name="isbn" readonly="readonly" placeholder="Enter ISBN or Title" required class="form-control" value="" />
                            <span class="glyphicon glyphicon-barcode form-control-feedback" style="font-size:24px; margin-top:-16px!important"></span>
                        </div>
                        <div class="form-group">
                            <div class='input-group date' id="datepicker">
                                <input name="date" type='text' class="readDate form-control datepicker" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group required has-feedback">
                            <input type="text" name="duration" placeholder="How long you read this book ? [ in minutes ]" required class="form-control" value="" /> 
                            <span class="glyphicon glyphicon-time form-control-feedback" style="font-size:24px; margin-top:-16px!important"></span>
                        </div>
                        <br><br>
                        <button type="submit" id="submitReadLog"  class="btn btn-normal btn-success">Submit Read Log</button>
                        <br><br>
                    </div>
                    <?php echo form_close(); ?>
                </div> <!--  end col-md-6  -->
            </div>
        </div>

        <div id="showBookInfo" class="panel-collapse collapse card">
            <div class="content panel-body">
               <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="content">
                    <div class="form-group required has-feedback">
                        <input type="text" id="searchBook" placeholder="Enter ISBN or Title" required autofocus="autofocus" class="form-control"/>
                        <span class="glyphicon glyphicon-barcode form-control-feedback" style="font-size:24px; margin-top:-16px!important"></span>
                    </div>
                    <span class="help-block text-warning"><star>*</star> Enter ISBN to get more precise result</span>
                        <br><br>
                        <button type="button" id="getInfo" class="btn btn-fill btn-info">Get Information</button>
                        <button id="enterManually" type="button" data-toggle="collapse" data-target="#showBookInfo" class="btn-link btn-wd">I want to enter manually</button>
                        <br><br>
                    </div>
                </div> <!--  end col-md-6  -->
            </div>
            <div id="showResult" class="panel-collapse collapse card">
                <div class="twenty_px_height"></div>
                <div class="col-md-12 text-center">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-4"><hr></div>
                            <div class="col-md-4 text-center text-danger">Book Information</div>
                            <div class="col-md-4"><hr></div>
                        </div>
                        <!--==================================
                        =            Book Details            =
                        ===================================-->
                        
                        <div class="row">
                            <div class="col-md-4 text-center" id="resultBookThumb"></div>
                            <div class="col-md-4 text-center" id="resultBookDetails">
                                <span id="thumb"></span><br /><br />
                                <span id="title"></span><br />
                                <span id="author"></span><br />
                                <span id="isbn"></span>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                        <div class="twenty_px_height"></div>
                        <div class="twenty_px_height"></div>
                        <div class="col-md-12"><button type="button" id="selectBook" data-toggle="collapse" data-target="#showBookInfo" class="btn btn-fill btn-success btn-wd">Yeah, that's it</button>
                        <button id="enterManually" type="button" data-toggle="collapse" data-target="#showBookInfo" class="btn-link btn-wd">Nope! enter manually</button>
                        </div>
                        <div class="twenty_px_height"></div>
                        <!--====  End of Book Details  ====-->
                    </div>
                </div> <!--  end col-md-6  -->
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <?php include "new/template/account_left.php"; ?>
            <div class="col-lg-9">
                <div class="content">
                    <div class="toolbar">
                        <!--Here you can write extra buttons/actions for the toolbar-->
                    </div>
                    <div class="fresh-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Book title</th>
                                <th>Author</th>
                                <th>ISBN</th>
                                <th>Duration</th>
                                <th>Points</th>
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
                            <?php if (isset($readers_books)) { 
                                foreach ($readers_books as $readers_books) {
                            ?>
                            <tr>
                                <td><?php echo date('m/d/Y', strtotime(str_replace('-', '/', $readers_books->date))); ?></td>
                                <td><?php echo $readers_books->book_title; ?></td>
                                <td><?php echo $readers_books->author; ?></td>
                                <td><?php echo $readers_books->isbn; ?></td>
                                <td class="text-center"><?php echo $readers_books->duration; ?></td>
                                <td><?php echo $readers_books->reading_point; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                           </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //reader account -->


<script type="text/javascript">
    $('#readNew').click('on', function(){
        $(this).toggleClass("btn-danger");
        $(this).text(function(i, text){
          if (text == "Cancel new books log") {
            $('div#readLog').slideUp(300);
            $('div#showBookInfo').slideUp(300);
          } else {
            $('div#showBookInfo').slideDown(300);
          }
          return text === "Cancel new books log" ? "Reading something new ?" : "Cancel new books log";
        })
    });
</script>

<script type="text/javascript">
  $("#getInfo").click(function() {
    var search = document.getElementById('searchBook').value
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
  });
</script>

<!--  Plugin for DataTables.net  -->
<script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            order: [[0, 'ASC']], //default sorting latest one
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


<!-- Hide book information div -->
<script type="text/javascript">
    $('button#selectBook').click(function() {
        //alert ($(this).attr('id'));
        if (!$('div#readLog').hasClass('in')) {
            $('div#showBookInfo').slideUp(300);
            $('div#readLog').slideDown(300);
        }
    });
</script>

<script type="text/javascript">
    $('button#enterManually').click(function() {
        //alert ($(this).attr('id'));
        $('#readLog #thumb').html('');
        $('input[name=title]').removeAttr('readonly').val('');
        $('input[name=author]').removeAttr('readonly').val('');
        $('input[name=isbn]').removeAttr('readonly').val('');

        if (!$('div#readLog').hasClass('in')) {
            $('div#showBookInfo').slideUp(300);
            $('div#readLog').slideDown(300);
        }
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
