<!-- Sidebar Menu -->
<nav class="mt-2">
    {{-- item 1 --}}
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
        <span class="nav-link">
            <i class="fas fa-fish blue"></i>&ensp;
            <p>
            Sản Phẩm
            <i class="right fa fa-angle-left"></i>
            </p>
        </span>
        <ul class="nav nav-treeview">
            <li class="nav-item">
            <router-link to="/products" class="nav-link ">
                <i class="fa fa-circle-o nav-icon"></i>
                <p>Danh Sách</p>
            </router-link>
            </li>
        </ul>
        </li>
    </ul>
    {{-- item 3 --}}
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
            <span  class="nav-link">
                    <i class="fas fa-shopping-cart yellow"></i></i>&ensp;
                <p>
                Đơn Hàng
                <i class="right fa fa-angle-left"></i>
                </p>
            </span>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <router-link to="/orders" class="nav-link ">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Danh Sách</p>
                    </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    {{-- item 4 --}}
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview">
            <span class="nav-link">
                <i class="fas fa-users green"></i>&ensp;
                <p>
                Tài Khoản Khách Hàng
                <i class="right fa fa-angle-left"></i>
                </p>
            </span>
            <ul class="nav nav-treeview">
                    <li class="nav-item">
                    <router-link to="/users" class="nav-link ">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Danh Sách</p>
                    </router-link>
                    </li>
                </ul>
            </li>
    </ul>
    {{-- item 5 --}}
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
            <router-link to="/profile" class="nav-link">
                <i class="fas fa-user-circle red"></i>&ensp;
                <p>
                Profile
                </p>
            </router-link>
        </li>
    </ul>
    {{-- item 5 --}}
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <a href="{{route('out')}}" class="nav-link">
                <i class="fas fa-power-off purple"></i> &ensp;
                <p>
                Đăng Xuất
                </p>
            </a>
    </ul>
    </nav>
    <!-- /.sidebar-menu -->
