    @extends('admin.layout.index')
    @section('content')
        <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
            <div class="jumbotron jumbotron-default">
                <div class="container">
                    <h6 class="display-3 text-danger">Thủy Sản Khô Thùy Mai</h6>
                </div>
            </div>
            <!-- router view -->
            <router-view></router-view>       <!-- router 6 -->
            <vue-progress-bar></vue-progress-bar>    <!-- Vprocessbar 3 -->
            <!-- router view -->
    </div>
    @endsection

