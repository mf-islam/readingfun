        <div class="clearfix"></div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-center">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.fimaruf.com">Md Fakhrul Islam</a>
                </div>
            </div>
        </footer>
    </div>
</div>
</body>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui.min.js" type="text/javascript"></script>

    <!--   Core JS Files   -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo base_url(); ?>assets/js/chartist.min.js"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-notify.js"></script>

    <!--  Custom JS    -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

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
    <!--  Google Maps Plugin    -->
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>-->

</html>