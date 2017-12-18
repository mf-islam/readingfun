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
                <!--<div id="collapseOne" class="panel-collapse collapse card">
                    <div class="content panel-body">
                        <div class="col-md-3 pull-left">
                            <div class="content">
                                <div class="img-container text-center" style="margin-bottom:50px;">
                                    <img src="http://books.google.com/books/content?id=tVIjmNS3Ob8C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api" alt="Agenda">
                                </div>
                                
                                <div class="img-container text-left">
                                    <img src="<?php echo base_url(); ?>assets/img/barcode.png" alt="Barcode">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 pull-right">
                            <div class="header" style="margin-bottom:20px;">
                                <h4 class="title margin-0">The Elements of Statistical Learning</h4>
                                <span class="category">Plain text tabs</span>
                            </div>
                            <div class="content">
                                <div class="nav-tabs-navigation">
                                    <div class="nav-tabs-wrapper text-right">
                                        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                            <li class="active"><a href="#home" data-toggle="tab">Description</a></li>
                                            <li><a href="#profile" data-toggle="tab">Catalog</a></li>
                                            <li><a href="#messages" data-toggle="tab">..more</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="my-tab-content" class="tab-content text-left">
                                    <div class="tab-pane active" id="home">
                                        <p>During the past decade there has been an explosion in computation and information technology. With it have come vast amounts of data in a variety of fields such as medicine, biology, finance, and marketing. The challenge of understanding these data has led to the development of new tools in the field of statistics, and spawned new areas such as data mining, machine learning, and bioinformatics. Many of these tools have common underpinnings but are often expressed with different terminology. This book describes the important ideas in these areas in a common conceptual framework. While the approach is statistical, the emphasis is on concepts rather than mathematics. Many examples are given, with a liberal use of color graphics. It is a valuable resource for statisticians and anyone interested in data mining in science or industry. The book's coverage is broad, from supervised learning (prediction) to unsupervised learning. The many topics include neural networks, support vector machines, classification trees and boosting---the first comprehensive treatment of this topic in any book. This major new edition features many topics not covered in the original, including graphical models, random forests, ensemble methods, least angle regression & path algorithms for the lasso, non-negative matrix factorization, and spectral clustering. There is also a chapter on methods for ``wide'' data (p bigger than n), including multiple testing and false discovery rates.</p>
                                    </div>
                                    <div class="tab-pane" id="profile">
                                        <p>Here is your profile.</p>
                                    </div>
                                    <div class="tab-pane" id="messages">
                                        <p>Here are your messages.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="card">
                    <div class="header">
                        <h4 class="title"></h4>
                        <p class="category"></p>
                    </div>
                    <div class="content">
                        <div class="toolbar">
                            <!--Here you can write extra buttons/actions for the toolbar-->
                        </div>
                        <div class="fresh-datatables" id="acordeon">
                            <table id="datatables" class="table table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Book title</th>
                                    <th>Author</th>
                                    <th>ISBN</th>
                                    <th class="text-center">#readers</th>
                                    <th class="text-left">#duration</th>
                                    <!--<th class="disabled-sorting">Actions</th>-->
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php if (isset($books_reading) && count($books_reading[0]) > 1) { 
                                    foreach ($books_reading as $books_reading) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $books_reading['id']; ?></td>
                                    <td>
                                        <a target="_blank" href="<?php echo $books_reading['amazon_url']; ?>" class="text-effect"><?php echo $books_reading['title']; ?></a>
                                    </td>
                                    <td><?php echo $books_reading['author']; ?></td>
                                    <td><?php echo $books_reading['isbn']; ?></td>
                                    <td class="text-center"><?php echo $books_reading['readers_count']; ?></td>
                                    <td id="duration" class="text-left"><?php echo $books_reading['duration']; ?></td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                               </tbody>
                            </table>
                        </div>


                    </div>
                </div><!--  end card  -->
            </div> <!-- end col-md-12 -->
                            
        </div>
    </div>
</div>
<!--  Plugin for DataTables.net  -->
<script src="<?php echo base_url(); ?>assets/js/jquery.datatables.js"></script>

<script type="text/javascript">
    $('#sel1').on('change', function(){
        window.location.replace("/admin/books?s="+$('#sel1').val());
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

