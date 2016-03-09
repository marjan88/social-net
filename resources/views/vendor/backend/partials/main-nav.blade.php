<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ \Auth::user()->getAvatarUrl(50) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->getNameOrUsername() }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">           
            <li class="active">
                <a href="{{route('cms.index')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>                
            </li>
            <li class="header">CONTENT</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i> <span>Posts</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-newspaper-o"></i> All Posts</a></li>
                    <li><a href=""><i class="fa fa-plus"></i> Add New</a></li>
                    <li><a href=""><i class="fa fa-tasks"></i> Categories</a></li>
                    <li><a href=""><i class="fa fa-tags"></i> Tags</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Pages</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-file-text-o"></i> All Pages</a></li>
                    <li><a href=""><i class="fa fa-plus"></i> Add New</a></li>                    
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-bars"></i> <span>Menu</span></i>
                </a>                
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-photo"></i> <span>Media</span></i>
                </a>                
            </li>
            <li class="header">WORKSHOP</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-users"></i> All Users</a></li>
                    <li><a href="#"><i class="fa fa-user-plus"></i> Add New</a></li>
                    <li><a href="#"><i class="fa fa-group"></i> User Group</a></li>
                </ul>
            </li>

            <li>
                <a href="pages/mailbox/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="label pull-right bg-yellow">12</small>
                </a>
            </li>   
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i> <span>Settings</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                </ul>
            </li>           
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>