<div class="main-panel">
	<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <span class="navbar-brand"><?php echo $page_title; ?></span>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!--<li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-panel"></i>
							<p>Stats</p>
                        </a>
                    </li>
                    <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p class="notification">5</p>
								<p>Notifications</p>
								<b class="caret"></b>
                          </a>
                          <ul class="dropdown-menu">
                            <li><a href="#">Notification 1</a></li>
                            <li><a href="#">Notification 2</a></li>
                            <li><a href="#">Notification 3</a></li>
                            <li><a href="#">Notification 4</a></li>
                            <li><a href="#">Another notification</a></li>
                          </ul>
                    </li>-->
                    <li>  
                        <a href=""> Hello Admin! </a>
                    </li>
					<li class="dropdown" class="active">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="ti-settings"></i>
							<p>Change</p>
							<b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
							<?php
								if($this->session->userdata('admin_group_id') != 3){
							?>
								<li><a href="<?php echo base_url(); ?>admin/edit_profile">Edit Profile</a></li>
							<?php }else{ ?>
								<li><a href="<?php echo base_url(); ?>admin/edit_my_profile">Edit Profile</a></li>
							<?php } ?>							
                            <li><a href="<?php echo base_url(); ?>admin/change_password">Change Password</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/users/logout">Logout</a></li>
                          </ul>
                </li>

                </ul>

            </div>
        </div>
    </nav>
