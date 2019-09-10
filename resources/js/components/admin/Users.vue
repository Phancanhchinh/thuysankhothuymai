<template>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header p-5">
                    <div class="row">
                        <h3 class="box-title">Danh Sách Khách Hàng</h3>
                        <div class="box-tools ml-5">
                            <button class="btn btn-success" @click="addUser">
                                Thêm <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                <tbody><tr>
                    <th>STT</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Permission</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Create At</th>
                    <th>Action</th>
                </tr>

                <tr v-for="(user, index) in users.data" :key="index">
                    <td>{{user.id}}</td>
                    <td>{{user.full_name | Uptext}}</td>
                    <td>{{user.email}}</td>
                    <td v-if="user.role == 1">Admin</td>
                    <td v-else>User</td>
                    <td>{{user.phone}}</td>
                    <td>{{user.address}}</td>
                    <td>{{user.created_at | moment("dddd, MMMM Do YYYY")}}</td>   <!-- vue moment 2 -->
                    <td>
                        <a @click="editUser(user)">
                            <i class="fa fa-edit green"></i>
                        </a>
                        <a @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
            <div class="box-footer">
                    <pagination :data="users" @pagination-change-page="getResults"></pagination>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNewUsers" tabindex="-1" role="dialog" aria-labelledby="addNewUsersLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="statusForm">Sửa Tài Khoản</h5>
                        <h5 class="modal-title" v-else>Thêm Tài Khoản</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                <form @submit.prevent="statusForm ? updateUser() : createNewUser()">                <!-- Vform 4 -->
                    <div class="modal-body">
                    <div class="form-group">
                        <input v-model="form.full_name" type="text" name="full_name" placeholder="Full Name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('full_name') }">
                        <has-error :form="form" field="full_name"></has-error>
                    </div>
                    <div class="form-group">
                        <input v-model="form.email" type="text" name="email" placeholder="Email"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <has-error :form="form" field="email"></has-error>
                    </div>
                    <div v-if="!statusForm">
                        <div class="form-group">
                            <input v-model="form.password" type="password" name="password" placeholder="PassWord"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="form.phone" type="text" name="phone" placeholder="Phone"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                        <has-error :form="form" field="phone"></has-error>
                    </div>

                    <div class="form-group">
                        <input v-model="form.address" type="text" name="address" placeholder="Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                        <has-error :form="form" field="address"></has-error>
                    </div>
                    <div class="form-group">
                        <select name="role" v-model="form.role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                            <option value="">Select Role</option>
                            <option value="1">Admin</option>
                            <option value="0">User</option>
                        </select>
                        <has-error :form="form" field="role"></has-error>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" v-show="!statusForm" class="btn btn-primary">Create</button>
                        <button type="submit" v-show="statusForm" class="btn btn-success">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>
    </template>

<script>
    export default {
        data(){
            return {                // vform 5
                users : {},
                form: new Form({
                    id : '',
                    full_name: '',
                    email: '',
                    password: '',
                    phone : '',
                    address : '',
                    role : '',
                    id_update : null,
                }),
                statusForm : false,
            }
        },methods: {
            editUser(data){
                this.statusForm = true;
                this.form.reset();
                $('#addNewUsers').modal('show')
                this.form.fill(data);
                this.id_update = data.id;
            },
            addUser(){
                this.statusForm = false;
                this.form.reset();
                $('#addNewUsers').modal('show')
            },
            updateUser(){
                this.$Progress.start();
                this.form.post('api/update/us' ,{
                    id : this.id_update
                }).then(()=>{
                    Fire.$emit('AfterCreate');          // custom event goi đến $on
                    $('#addNewUsers').modal('hide')
                    Swal.fire(
                            'Updated!',
                            'Cập Nhật Tài Khoản Thành Công',
                            'success'
                        )
                    this.$Progress.finish();
                }).catch(()=>{
                    $('#addNewUsers').modal('show')
                    Swal.fire(
                            'Failed!',
                            'Cập Nhật Tài Khoản Không Thành Công',
                            'warning'
                        )
                    this.$Progress.fail();
                });
            },
            deleteUser(id){
                this.$Progress.start();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Bạn Có Chắc Chắn Muốn Xóa Tài Khoản Này",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        //send req to the server
                        if (result.value) {
                            axios.post('api/delete/us',{
                                id : id
                            }).then((res)=>{
                                Swal.fire(
                                    'Deleted!',
                                    'Xóa Tài Khoản Thành Công',
                                    'success'
                                )
                                Fire.$emit('AfterCreate');          // custom event goi đến $on
                                this.$Progress.finish();
                        }).catch((err)=>{
                            Swal.fire(
                                'Failed!',
                                'Xóa Tài Khoản Không Thành Công',
                                'warning'
                            )
                            this.$Progress.fail()
                        });
                        }
                    })
            },getResults(page = 1) {   // phân trang
                    axios.get('api/user?page=' + page)
                        .then(response => {
                            this.users = response.data;
                        });
            },
            loadUser(){
                axios.get('api/user').then((res) => {   // axios gọi api laravel
                    this.users = res.data;
                })
            },
            createNewUser(){
                this.$Progress.start();                 //vprcress 7
                this.form.post('api/user').then(()=>{ // gán form cho các dữ liệu trong api/user             // vform 6
                    Fire.$emit('AfterCreate');          // custom event goi đến $on
                    $('#addNewUsers').modal('hide')
                    Toast.fire({                        //sweetAlert 5
                    type: 'success',
                    title: 'Tài Khoản Đã Được Tạo Thành Công'
                    })
                    this.$Progress.finish();        //vprcress 7
                }).catch(()=>{
                    $('#addNewUsers').modal('show')
                    Toast.fire({                        //sweetAlert 6
                    type: 'error',
                    title:  "Không Thể Tạo Tài Khoản"
                    })
                    this.$Progress.fail()    //vprcress 8
                });
                // this.$router.go();           // load lại router
            }
        },created() {
            this.$Progress.start();
                Fire.$on('afterSeach',()=>{
                    let keyword = this.$parent.search;
                    axios.get('api/findUser?q='+ keyword).then((res)=>{
                        this.users = res.data;
                    }).catch((err)=>{
                        console.log(err)
                    });
                });
            this.loadUser();        // mỗi lần tạo thì gọi method loaduser
            this.$Progress.finish();
            // setInterval(() => {
            //     this.loadUser();     3.5 s gửi req 1 lần update trang
            // }, 3500);
            Fire.$on('AfterCreate',()=>{            // load lại mỗi lần click
                this.loadUser();
            });
        },filters : {
            Uptext(text)
            {             // filler viết hoa chữ cái đầu
                return text.charAt(0).toUpperCase() + text.slice(1);
            }
        }
    }
</script>


