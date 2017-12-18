<!-- banner -->
<?php if (isset($settings) and $settings['show_video'] == '1') { ?>

<?php if(file_exists($_SESSION['in_sub_domain']['current_video'])){
      $video = base_url().$_SESSION['in_sub_domain']['current_video'];
  }else{
      $video = base_url()."/assets/new/video/nursery";
  }
?>

<div class="row">
  <div data-vide-bg="<?php echo $video; ?>">
    <div class="center-container">
      <div class="container">
        <div class="w3_agile_banner_info">
          <p class="w3_agileits_banner_para"><span><?php echo $this->config->item('site_title'); ?></span></p>
          <div class="agileits_w3layouts_header">
            <h2><span class="w3_child">s</span><span class="w3_child1">u</span><span class="w3_child2">m</span><span class="w3_child3">m</span><span class="w3_child4">e</span><span class="w3_child5">r</span> <span class="w3_child2">reading</span></h2>
          </div>
          <p class="w3_elit_para"><?php echo $this->config->item('site_slogan'); ?></p>
          <div class="agile_more">
            <a href="<?php echo base_url(); ?>programs<?php echo $_SESSION['in_sub_domain']['get_param_subdomain']; ?>" class="btn btn-3 btn-3e icon-arrow-right">Learn More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<!--=====================================
=            3 columns texts            =
======================================-->
<div id="events" class="events row">
  <div class="content" id="about_home">
    <div class="row col-md-8 col-md-offset-1 padding_bottom_20">
        <div class="col-md-3"><hr></div>
        <div class="col-md-6 text-center text-danger"><h2 class="title">What is our plan in this summer</h2></div>
        <div class="col-md-3"><hr></div>
    </div>
    <div class="row col-md-10 col-md-offset-1">
      <div class="col-md-4">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, 
      </div>
      <div class="col-md-4 col-md-offset-1">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo,
        <p><br /><h2><span class="w3_child">h</span><span class="w3_child1">a</span><span class="w3_child2">v</span><span class="w3_child3">e</span> <span class="w3_child4">f</span><span class="w3_child5">u</span><span class="w3_child1">n</span></h2></p>
      </div>
    </div>
  </div>
</div>
<!--====  End of 3collumns text  ====-->


<!--=============================================
=     hover effect bookshelf [experiment]       =
==============================================-->

<!--<div class="row" style="position: relative; margin-top: -120px">
  <div class="container">
    <section id="grid" class="grid clearfix">

    <a href="#" class="b">

    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/2.png" />

      <div class="figcaption">
        <h2>Crystalline</h2>
        <p>Soko radicchio bunya nuts gram dulse.</p>
      </div>
<div class="figbutton">View</div>
</div>

  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/4.png" />
      <div class="figcaption">
        <h2>Cacophony</h2>
        <p>Two greens tigernut soybean radish artichoke.</p>
      </div>
  <div class="figbutton">View</div>
    </div>
  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/6.png" />
      <div class="figcaption">
        <h2>Languid</h2>
        <p>Beetroot water spinach okra water chestnut.</p>
      </div>
<div class="figbutton">View</div>
    </div>
  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/8.png" />
      <div class="figcaption">
        <h2>Serene</h2>
        <p>Water spinach arugula pea tatsoi.</p>
      </div>
<div class="figbutton">View</div>
    </div>
  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/1.png" />
      <div class="figcaption">
        <h2>Nebulous</h2>
        <p>Pea horseradish azuki bean lettuce.</p>
      </div>
<div class="figbutton">View</div>
    </div>
  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/3.png" />
      <div class="figcaption">
        <h2>Iridescent</h2>
        <p>A grape silver beet watercress potato.</p>
      </div>
<div class="figbutton">View</div>
    </div>
  </a>
  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/5.png" />
      <div class="figcaption">
        <h2>Resonant</h2>
        <p>Chickweed okra pea winter purslane.</p>
      </div>
      <div class="figbutton">View</div>
    </div>
  </a>


  <a href="#">
    <div class="figure">
      <img src="http://tympanus.net/Tutorials/ShapeHoverEffectSVG/img/7.png" />
      <div class="figcaption">
  
        <h2>Zenith</h2>
        <p>Salsify taro catsear garlic gram.</p>
  
      </div>
      <div class="figbutton">View</div>
    </div>
  </a>
</section>
  </div>
</div>-->

<!--====  End of hover effect bookshelf  ====-->

<!--==================================================
=            Show Latest 15 books from DB            =
===================================================-->
<?php if (isset($settings) and $settings['show_latest_book'] == '1') { ?>
<div id="recent_books" class="row col-md-10 col-md-offset-1 text-center">
  <div class="content">
    <div class="row">
        <div class="col-md-3"><hr></div>
        <div class="col-md-6 text-center text-danger"><h2 class="title">Recent read books by readers</h2></div>
        <div class="col-md-3"><hr></div>
    </div>
    <div class="twenty_px_height"></div>
    <?php 
        echo '<div class="row"><ul class="list-inline">';
        $i = 0;
          foreach ($latest_books as $key => $value) {
            $data_isbn = (isset($value['isbn_10']) && !empty($value['isbn_10']) ? 'data-isbn = "' . $value['isbn_10'] . '"' : '');
            if ($i % 5 === 0) {
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
<?php } ?>
<!--====  End of Show Latest 15 books from DB  ====-->


<?php if (isset($settings) and $settings['show_readers'] == '1') { ?>
<!--==================================================
=            Show Top 20 readers from DB            =
===================================================-->
<div id="recent_books" class="row col-md-10 col-md-offset-1 text-center">
  <div class="card card-plain">
      <div class="row">
          <div class="col-md-3"><hr></div>
          <div class="col-md-6 text-center text-danger"><h2 class="title">Top Readers</h2></div>
          <div class="col-md-3"><hr></div>
      </div>
      <div class="twenty_px_height"></div>
      <div class="content table-responsive">
          <table class="table table-hover">
              <thead>
                <th class="text-left">#</th>
                <th class="text-left">Name</th>
                <th class="text-left">Books read</th>
                <th class="text-left">Duration</th>
                <th class="text-left">Points</th>
              </thead>
              <tbody>
                <?php if ($top_readers) { ?>
                <?php $rank = 1; ?>
                <?php foreach ($top_readers as $top_readers) { ?>

                  <tr>
                    <td class="text-left"><?php echo $rank; ?></td>
                    <td class="text-primary text-left"><?php echo $top_readers->name; ?></td>
                    <td class="text-left"><?php echo (!empty($top_readers->total_books) ? $top_readers->total_books : '0'); ?></td>
                    <td class="text-left" id="duration"><?php echo (!empty($top_readers->total_duration) ? $top_readers->total_duration : '0'); ?></td>
                    <td class="text-left"><?php echo (!empty($top_readers->total_points) ? $top_readers->total_points : '0'); ?> </td>
                  </tr>
                <?php $rank++; ?>
              <?php } ?>
            <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<!--====  End of Show Top 20 readers from DB  ====-->

<?php if (isset($settings) and $settings['show_book'] == '1') { ?>
<!--==================================================
=            Show Top 20 readers from DB            =
===================================================-->
<div id="recent_books" class="row col-md-10 col-md-offset-1 text-center">
  <div class="card card-plain">
      <div class="row">
          <div class="col-md-3"><hr></div>
          <div class="col-md-6 text-center text-danger"><h2 class="title">Top Books</h2></div>
          <div class="col-md-3"><hr></div>
      </div>
      <div class="twenty_px_height"></div>
      <div class="content table-responsive">
          <table class="table table-hover">
              <thead>
                <th class="text-left">#</th>
                <th class="text-left">Title</th>
                <th class="text-left">Author</th>
                <th class="text-left">#readers</th>
                <th class="text-left">#duration</th>
              </thead>
              <tbody>
                <?php if ($top_books) { ?>
                <?php $rank = 1; ?>
                <?php foreach ($top_books as $top_books) { ?>
                <?php $data_isbn = (isset($top_books['isbn_10']) && !empty($top_books['isbn_10']) ? $top_books['isbn_10'] . '"' : ''); ?>
                  <tr>
                    <td class="text-left"><?php echo $rank; ?></td>
                    <td class="text-primary text-left"><a target="_blank" href="<?php echo $top_books['amazon_url']; ?>" class="text-effect"><?php echo $top_books['title']; ?></a></td>
                    <td class="text-left" class="text-danger"><?php echo $top_books['author']; ?></td>
                    <td class="text-left" class="text-danger"><?php echo $top_books['readers_count']; ?></td>
                    <td class="text-left" id="duration" class="text-danger"><?php echo $top_books['duration']; ?></td>
                  </tr>
                <?php $rank++; ?>
              <?php } ?>
            <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<!--====  End of Show Top 20 readers from DB  ====-->

<?php if (isset($settings) and $settings['show_school'] == '1') { ?>
<!--==================================================
=            Show Top 20 readers from DB            =
===================================================-->
<div id="recent_books" class="row col-md-10 col-md-offset-1 text-center">
  <div class="card card-plain">
      <div class="row">
          <div class="col-md-3"><hr></div>
          <div class="col-md-6 text-center text-danger"><h2 class="title">Top Schools</h2></div>
          <div class="col-md-3"><hr></div>
      </div>
      <div class="twenty_px_height"></div>
      <div class="content table-responsive">
          <table class="table table-hover">
              <thead>
                <th class="text-left">#</th>
                <th class="text-left">Name</th>
                <th class="text-left">City</th>
                <th class="text-left">State</th>
                <th class="text-left">Zip</th>
                <th class="text-left">#students</th>
                <th class="text-left">#books</th>
                <th class="text-left">#points</th>
              </thead>
              <tbody>
                <?php if ($top_schools) { ?>
                <?php $rank = 1; ?>
                <?php foreach ($top_schools as $top_schools) { ?>
                  <tr>
                    <td class="text-left"><?php echo $rank; ?></td>
                    <td class="text-primary text-left"><?php echo $top_schools->name; ?></td>
                    <td class="text-left"><?php echo $top_schools->city; ?></td>
                    <td class="text-left"><?php echo $top_schools->state; ?></td>
                    <td class="text-left"><?php echo $top_schools->zip; ?></td>
                    <td class="text-left"><?php echo $top_schools->no_of_students; ?></td>
                    <td class="text-left"><?php echo $top_schools->no_of_books; ?></td>
                    <td class="text-left"><?php echo $top_schools->points; ?></td>
                  </tr>
                <?php $rank++; ?>
              <?php } ?>
            <?php } ?>
              </tbody>
          </table>
      </div>
  </div>
</div>
<?php } ?>
<div class="clearfix"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<div class="twenty_px_height"></div>
<!--====  End of Show Top 20 readers from DB  ====-->

<!--======================================================================
=            Make duration into hours and minutes like 3h 20m            =
=======================================================================-->
<script type="text/javascript">
  $(document).ready(function() {
    $('td#duration').each(function() {
      console.log($(this).html());
      var minutes = $(this).html();
      var hours = Math.floor( parseInt($(this).html()) / 60);          
      var minutes = parseInt(minutes - (hours*60));

      $(this).html(hours + "h " + minutes + "m" );
    });
});
</script>
<!--====  End of Make duration into hours and minutes like 3h 20m  ====-->

<!-- Redirect to Amazon api -->
<script type="text/javascript">
  $('img#books_thumb').each(function(){
    $(this).on('click', function(){
      if ($(this).data('isbn')) {
        window.open(
          '<?php echo $amazon_url; ?>' + $(this).data('isbn') + '/?tag=<?php echo $amazon_key; ?>',
          '_blank' // <- This is what makes it open in a new window.
        );
      }
    }); 
  });
</script>