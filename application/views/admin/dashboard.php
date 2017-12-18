<div class="content">
    <div class="container-fluid">
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
                                    <p>Books</p>
                                    <?php echo $total_books_added; ?>
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
                                    <p>Readers</p>
                                    <?php echo $total_readers; ?>
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
                                    <i class="ti-clipboard"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>minutes Read</p>
                                    <?php echo $total_read_duration; ?>
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
            <!--<div class="col-lg-3 col-sm-6">
                <div class="card">
                    <div class="content">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="icon-big icon-info text-center">
                                    <i class="ti-twitter-alt"></i>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <div class="numbers">
                                    <p>Followers</p>
                                    +45
                                </div>
                            </div>
                        </div>
                        <div class="footer">
                            <hr />
                            <div class="stats">
                                <i class="ti-reload"></i> Updated now
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <?php if(isset($readers)){ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Recent <?php echo $readers_count; ?> Readers</h4>
                        <p class="category">Recent readers joined for fun</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Name/email/phone </th>
                                    <th>#duration</th>
                                    <th>#points</th>
                                    <th>from</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($readers)) { 
                                    foreach ($readers as $readers) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $readers->id; ?></td>
                                    <td><?php echo $readers->username; ?></td>
                                    <td>
                                        <?php echo $readers->first_name .' '.$readers->last_name; ?><br />
                                        <?php echo $readers->email; ?><br />
                                        <?php echo $readers->phone; ?>
                                    </td>
                                    <td id="duration"><?php echo $readers->duration; ?></td>
                                    <td><?php echo $readers->points; ?></td>
                                    <td><?php echo date('m/d/Y', strtotime($readers->created_on)); ?><br /></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                               </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        
        <?php } ?>
        
        <?php if(count($latest_books[0]) > 0){ ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Recent <?php echo $books_count; ?> books </h4>
                        <p class="category">list of latest <?php echo $books_count; ?> books added in catalog</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <!--==================================================
                        =            Show Latest 15 books from DB            =
                        ===================================================-->

                        <div id="recent_books" class="row col-md-10 col-md-offset-1 text-center">
                          <div class="content">
                            <?php 
                                echo '<div class="row"><ul class="list-inline">';
                                $i = 0;
                                  foreach ($latest_books as $key => $value) {
                                    $data_isbn = (isset($value['isbn_10']) && !empty($value['isbn_10']) ? 'data-isbn = "' . $value['isbn_10'] . '"' : '');
                                    if ($i % 4 === 0) {
                                      echo '</ul></div><div class="row"><ul class="list-inline">';
                                    }
                                    echo "<li class='book'><img id='books_thumb' " . $data_isbn . " src='" . $value['thumb'] . "' /></li>";
                                    $i++;
                                   }
                                echo '</ul></div>';
                            ?>
                          </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="twenty_px_height"></div>
                        <div class="twenty_px_height"></div>
                        <div class="twenty_px_height"></div>
                        <!--====  End of Show Latest 15 books from DB  ====-->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    
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
<!-- Redirect to Amazon api -->
<script type="text/javascript">
  $('img#books_thumb').each(function(){
    $(this).on('click', function(){
      if ($(this).data('isbn')) {
        //window.location="https://www.amazon.com/dp/"+ $(this).data('isbn') +"/?tag=readi01c-20";
        window.open(
          "https://www.amazon.com/dp/"+ $(this).data('isbn') +"/?tag=readi01c-20",
          '_blank' // <- This is what makes it open in a new window.
        );
      }
    }); 
  });
</script>
