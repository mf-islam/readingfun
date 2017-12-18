<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="<?php echo base_url(); ?>admin" class="simple-text">
                Admin Panel
            </a>
            <hr class="colorgraph"><br>
        </div>

        <ul class="nav">
            <li <?php echo ((strtolower($menu_title) == "dashboard") ? 'class="active"' : ''); ?>>
                <a href="<?php echo base_url(); ?>admin/dashboard">
                    <i class="glyphicon glyphicon-th"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <?php
                if($this->session->userdata('admin_group_id') != 3){
            ?>
            <li <?php echo ((strtolower($menu_title) == "library") ? 'class="active"' : ''); ?>>
                <a href="<?php echo base_url(); ?>admin/library">
                    <i class="glyphicon glyphicon-book"></i>
                    <p>Library</p>
                </a>
            </li>
            <?php } ?>
            <li <?php echo ((strtolower($menu_title) == "readers") ? 'class="active"' : ''); ?>>
                <a data-toggle="collapse" href="#readersOverview">
                    <i class="glyphicon glyphicon-user"></i>
                    <p>Readers
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse <?php echo ((strtolower($menu_title) == "readers") ? 'in' : ''); ?>" id="readersOverview">
                    <ul class="nav">
                        <li><a href="<?php echo base_url(); ?>admin/readers">List Readers</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/books">Books Reading</a></li>
                        <!--<li><a href="<?php echo base_url(); ?>admin/readers/new">Add new Reader</a></li>-->
                    </ul>
                </div>
            </li>
            <!--<li <?php echo ((strtolower($menu_title) == "books") ? 'class="active"' : ''); ?>>
                <a data-toggle="collapse" href="#booksSubmenu">
                    <i class="ti-book"></i>
                    <p>Books <b class="caret"></b></p>
                </a>
                <div class="collapse" id="booksSubmenu">
                    <ul class="nav">
                        <li><a href="<?php echo base_url(); ?>admin/books">List Books</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/books/new">Add new book</a></li>
                    </ul>
                </div>
            </li>-->
            <li <?php echo ((strtolower($menu_title) == "settings") ? 'class="active"' : ''); ?>>
                <a data-toggle="collapse" href="#settingsNav">
                    <i class="glyphicon glyphicon-list-alt"></i>
                    <p>Settings<b class="caret"></b></p>
                </a>
                <div class="collapse <?php echo ((strtolower($menu_title) == "settings") ? 'in' : ''); ?>" id="settingsNav">
                    <ul class="nav">
                        <li><a href="<?php echo base_url(); ?>admin/settings/setstyle">Style Scheme</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/settings/profilepicture">Profile Picture</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/settings/general">General</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/settings/schools">Schools</a></li>
                        <?php
                            if($this->session->userdata('admin_group_id') != 3){
                        ?>
                            <li><a href="<?php echo base_url(); ?>admin/settings/api">API Settings</a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url(); ?>admin/settings/points">Points</a></li>
                        <li><a href="<?php echo base_url(); ?>admin/settings/badges">Badges</a></li>
                        <?php
                            if($this->session->userdata('admin_group_id') != 3){
                        ?>
                            <li><a href="<?php echo base_url(); ?>admin/settings/cron">Cron Settings</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>admin/users/logout">
                    <i class="glyphicon glyphicon-off"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>