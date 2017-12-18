<div class="sidebar" data-background-color="white" data-active-color="danger">
<div class="sidebar-wrapper">
    <div class="logo">
        <a href="" class="simple-text">
            Admin Panel
        </a>
        <hr class="colorgraph"><br>
    </div>

    <ul class="nav">
        <li class="active">
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="glyphicon glyphicon-th"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a data-toggle="collapse" href="#readersOverview">
                <i class="glyphicon glyphicon-user"></i>
                <p>Readers
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="readersOverview">
                <ul class="nav">
                    <li><a href="../dashboard/overview.html">Overview</a></li>
                    <li><a href="../dashboard/stats.html">Stats</a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-book"></i>
                <p>Books</p>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-list-alt"></i>
                <p>Reports</p>
            </a>
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