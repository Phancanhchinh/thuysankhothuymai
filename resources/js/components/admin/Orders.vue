            <template>
            <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                    <div class="box-header p-5">
                        <div class="row">
                            <h3 class="box-title">Danh Sách Đặt Hàng</h3>
                            <!-- <div class="box-tools ml-5">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addNewUsers">
                                    Thêm <i class="fas fa-user-plus fa-fw"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Note</th>
                                    <th>created_at</th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="(order, index) in orders.data" :key="index">
                                    <td>{{order.id}}</td>
                                    <td>{{order.name | Uptext }} </td>
                                    <td>{{order.gender | Uptext}}</td>
                                    <td>{{order.email}}</td>
                                    <td>{{order.address}}</td>
                                    <td>{{order.phone_number}}</td>
                                    <td>{{order.note}}</td>
                                    <td>{{order.created_at | moment("HH:MM,dddd, MMMM Do YYYY")}}</td>
                                    <td>
                                        <a @click="detailOrder(order.id)">
                                            <i class="fas fa-search-plus green"></i>
                                        </a>
                                        <a @click="deleteOrder(order.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <div class="box-footer">
                        <pagination :data="orders" @pagination-change-page="getResults"></pagination>
                    </div>
                    <!-- /.box -->
                </div>
                </div>
                <!-- Modal -->
                    <div class="modal fade" id="detailOrder" tabindex="-1" role="dialog" aria-labelledby="detailOrderLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h1 text-info text-uppercase font-weight-bold" id="detailOrderLabel">Chi Tiết Đơn Hàng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover">
                                    <div v-for="(bill_detail, index) in billDetail" :key="index">
                                        <div v-for="(product, index) in products" :key="index">
                                            <div v-if="product.id == bill_detail.id_product">
                                                <div v-if="product.id == bill_detail.id_product">
                                                    <td class="h2 text-capitalize text-success">{{product.name}}</td>
                                                </div>
                                                <td class="h4">SL : {{bill_detail.quantity}}</td>
                                                <td class="h4">Đơn Giá : {{bill_detail.unit_price | nummberFormat}}</td>
                                            </div>
                                        </div>
                                    </div>
                            </table>
                            <hr>
                            <hr>
                            <div class="h1 text-danger">Tổng Tiền: <span>{{this.bill.total | nummberFormat}}</span></div>
                            <hr>
                            <div class="h1 text-danger">Thanh Toán: <span>{{this.bill.payment}}</span></div>
                            <hr>
                            <div class="h1 text-danger">Tình Trạng:
                                <span v-if="this.bill.status == 0">Chưa Xử Lý</span>
                                <span class="text-primary" v-if="this.bill.status == 1">Đã Xử Lý</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary bg-danger" data-dismiss="modal">Close</button>
                            <button type="button" v-bind:class="{hide : this.bill.status == 1}" class="btn btn-secondary bg-success" @click="ChangeStatus(bill.id)">Confirm</button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </template>

            <script>
            export default {
                data(){
                    return {
                        orders : {},
                        billDetail : [],
                        bill : [],
                        products : [],
                    }
                },methods: {
                    getResults(page = 1) {   // phân trang
                    axios.get('api/order?page=' + page)
                        .then(response => {
                            this.orders = response.data;
                        });
                    },loadOrder(){
                        axios.get('api/order').then((res) => {
                            this.orders = res.data;
                        })
                    },detailOrder(id){
                        $('#detailOrder').modal('show')
                        axios.get('api/order/' + id).then((res)=>{
                            this.billDetail = res.data[0];
                            this.bill = res.data[1];
                            this.products = res.data[2];
                        }).catch((err)=>{
                            console.log(err);
                        })

                    },deleteOrder(id){
                        this.$Progress.start();
                        Swal.fire({
                        title: 'Warning',
                        text: "Bạn có chắc chắn muốn xóa đơn hàng này ?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.value) {
                                axios.post('api/delete/od',{
                                    id : id
                                }).then(()=>{
                                Swal.fire(
                                    'Deleted!',
                                    'Xóa Thành Công',
                                    'success'
                                )
                                this.$emit('AfterCreate');          // custom event goi đến $on
                                this.$Progress.finish();
                            }).catch(()=>{
                                Swal.fire(
                                    'Failed!',
                                    'Lỗi Không Thể Xóa',
                                    'warning'
                                )
                                this.$Progress.fail()
                            });
                        }
                    })
                    },ChangeStatus(id){
                        this.$Progress.start();
                        axios.post('api/update/od',{
                            id : id
                        }).then((res)=>{
                            $('#detailOrder').modal('hide');
                            Swal.fire(
                                'Ok!',
                                'Đã Xử Lý',
                                'success'
                            )
                            this.$emit('AfterCreate');          // custom event goi đến $on
                            this.$Progress.finish();
                        }).catch((err)=>{
                            console.log(err)
                            $('#detailOrder').modal('show')
                            Swal.fire(
                                'Failed!',
                                'Xử Lý Thất Bại',
                                'warning'
                            )
                            this.$Progress.fail()
                        })
                    }
                },
                created() {
                    this.$Progress.start();
                    Fire.$on('afterSeach',()=>{
                    let keyword = this.$parent.search;
                    axios.get('api/findOrder?q=' + keyword).then((res)=>{
                        this.orders = res.data;
                    }).catch((err)=>{
                        console.log(err)
                    });
                });
                    this.loadOrder();
                    this.$Progress.finish();
                    this.$on('AfterCreate',()=>{            // function custom
                        this.loadOrder();
                    });
                },filters : {
                    Uptext(text)
                    {
                        return text.charAt(0).toUpperCase() + text.slice(1);
                    },
                    nummberFormat(money){
                        if(money){
                            return money.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                        }
                    }
                }
            }
            </script>


