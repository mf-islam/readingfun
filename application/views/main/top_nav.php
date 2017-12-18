<div class="row col-lg-10 col-md-offset-1">
    <nav class="navbar navbar-transparent navbar-absolute">
        
        <div class="navbar-header">
            <button type="button" class="navbar-toggle navbar-toggle-black" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar "></span>
                <span class="icon-bar "></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if (!$this->ion_auth->logged_in()) { ?>
                <li>
                   <a href="login" class="btn">
                        Looking to login?
                    </a>
                </li>
                <?php } ?>
                <?php if ($this->ion_auth->logged_in()) { ?>
                <li><a href="<?php echo base_url(); ?>/readers/account" class="btn btn-simple">My Account</a></li>
                <li><a href="<?php echo base_url(); ?>/readers/books" class="btn btn-simple">My Books</a></li>
                <li><a href="<?php echo base_url(); ?>/readers/logout" class="btn btn-simple">Logout</a></li>
                <?php } ?>
            </ul>
        </div>
    <?php if ($this->ion_auth->logged_in()) { ?><hr /><?php } ?></nav>
</div>