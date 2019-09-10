<template>
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                <div class="box-header p-5">
                    <div class="row">
                        <h3 class="box-title">Danh Sách Sản Phẩm</h3>
                        <div class="box-tools ml-5">
                            <button class="btn btn-success" @click="addProductClick">
                                Thêm <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table  class="table table-hover">
                    <tbody>
                    <tr>
                        <th>STT</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>description</th>
                        <th>Unit Price</th>
                        <th>Promotion Price</th>
                        <th>Image</th>
                        <th>Unit</th>
                        <th>New</th>
                        <th>Create At</th>
                        <th>Action</th>
                    </tr>
                    <tr v-for="(product, index) in products.data" :key="index">
                        <td>{{product.id}}</td>
                        <td>{{product.name}}</td>
                        <td>
                            <span v-if="product.id_type === 1">Cá Khô</span>
                            <span v-if="product.id_type === 2">khô ăn chơi</span>
                            <span v-if="product.id_type === 3">Mắm 3 miền</span>
                            <span v-if="product.id_type === 4">các loại tép và tôm khô</span>
                            <span v-if="product.id_type === 5">Sản Phẩm Khác</span>
                            <span v-if="product.id_type === 6">Gia vị 3 miền</span>
                        </td>
                        <td>{{product.description}}</td>
                        <td>{{product.unit_price | nummberFormat}}</td>
                        <td>
                            <span v-if="product.promotion_price === null">--------</span>
                            <span v-else>{{product.promotion_price | nummberFormat}} </span>
                        </td>
                        <td><img style="width:100px;height:100px" v-bind:src="'/main/image/product/' + product.image" /></td>
                        <td>{{product.unit}}</td>
                        <td>
                            <span v-if="product.new === 1">Mới</span>
                            <span v-else></span>
                        </td>
                        <td>{{product.created_at | moment("dddd, MMMM Do YYYY")}}</td>
                        <td>
                            <a @click="editProductClick(product)">
                                <i class="fa fa-edit green"></i>
                            </a>
                            <a @click="deleteProduct(product.id)">
                                <i class="fa fa-trash red"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody></table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <pagination :data="products" @pagination-change-page="getResults"></pagination>
                </div>
                </div>
                <!-- /.box -->
            </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="addNewProduct" tabindex="-1" role="dialog" aria-labelledby="addNewProductLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 v-if="!statusForm" class="modal-title">Thêm Sản Phẩm</h5>
                            <h5 v-if="statusForm" class="modal-title">Sửa Sản Phẩm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                    <form @submit.prevent="statusForm ? updateProduct() : createNewProduct()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="id_type" v-model="form.id_type" class="form-control" :class="{ 'is-invalid': form.errors.has('id_type') }">
                                    <option value="">Select type</option>
                                    <option value="1">Cá Khô</option>
                                    <option value="2">khô ăn chơi</option>
                                    <option value="3">Mắm 3 miền</option>
                                    <option value="4">Các loại tép và tôm khô</option>
                                    <option value="5">Sản Phẩm Khác</option>
                                    <option value="6">Gia vị 3 miền</option>
                                </select>
                                <has-error :form="form" field="id_type"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.description" type="text" name="description" placeholder="description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }">
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.unit_price" type="text" name="unit_price" placeholder="unit price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('unit_price') }">
                            <has-error :form="form" field="unit_price"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.promotion_price" type="text" name="promotion_price" placeholder="promotion price"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('promotion_price') }">
                            <has-error :form="form" field="promotion_price"></has-error>
                        </div>
                        <div v-if="!statusForm">
                            <div class="form-group row">
                                <label for="image" class="col-sm-12 control-label" >Product Image </label>
                                <div class="col-sm-12">
                                    <input  type="file" @change="ImageProduct" name="image" class="form-input">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input v-model="form.unit" type="text" name="unit" placeholder="unit"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('unit') }">
                            <has-error :form="form" field="unit"></has-error>
                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" v-show="!statusForm" :disabled="hideSubmit" class="btn btn-primary">Create</button>
                            <button type="submit" v-show="statusForm" :disabled="hideSubmit" class="btn btn-success">Update</button>
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
                return {
                    products : {},
                    form: new Form({
                        id :'',
                        name: '',
                        id_type: '',
                        description: '',
                        unit_price : '',
                        promotion_price : '',
                        image : '',
                        unit : '',
                        created_at : '',
                    }),
                    statusForm : false,
                    hideSubmit : false,
                    id_update : null
                }
            },methods: {
                getResults(page = 1) {   // phân trang
                    axios.get('api/product?page=' + page)
                        .then(response => {
                            this.products = response.data;
                        });
                },loadProduct(){
                    axios.get('api/product').then((res) => {
                        this.products = res.data;
                    })
                },addProductClick(){
                    this.statusForm = false;
                    this.form.reset();
                    $('#addNewProduct').modal('show')
                },editProductClick(data){
                    this.statusForm = true;
                    this.form.reset();
                    $('#addNewProduct').modal('show')
                    this.form.fill(data);
                    this.id_update = data.id;
                },createNewProduct(){
                    this.$Progress.start();                 //vprcress 7
                    this.form.post('api/product').then(()=>{ // gán form cho các dữ liệu trong api/user             // vform 6
                        Fire.$emit('AfterCreate');          // custom event goi đến $on
                        $('#addNewProduct').modal('hide')
                        Toast.fire({                        //sweetAlert 5
                        type: 'success',
                        title: 'Thêm Sản Phẩm Mới Thành Công'
                        })
                        this.$Progress.finish();        //vprcress 7
                    }).catch(()=>{
                        $('#addNewProduct').modal('show')
                        Toast.fire({                        //sweetAlert 6
                        type: 'error',
                        title:  "Lỗi Không Thể Thêm Sản Phẩm"
                        })
                        this.$Progress.fail()    //vprcress 8
                    });
                },updateProduct(){
                    this.$Progress.start();
                    this.form.post('api/update/sp',{
                        id : this.id_update
                    }).then((res)=>{
                    Fire.$emit('AfterCreate');          // custom event goi đến $on
                    $('#addNewProduct').modal('hide')
                    Swal.fire(
                            'Updated!',
                            'Sửa Sản Phẩm Thành công',
                            'success'
                        )
                    this.$Progress.finish();
                    }).catch(()=>{
                    $('#addNewProduct').modal('show')
                    Swal.fire(
                            'Failed!',
                            'Sửa Sản Phẩm Thất Bại',
                            'warning'
                        )
                    this.$Progress.fail();
                });
                },deleteProduct(id){
                    this.$Progress.start();
                    Swal.fire({
                        title: 'Warning',
                        text: "Bạn có chắc chắn muốn xóa sản phẩm này ?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.value) {
                                axios.post('api/delete/sp',{
                                    id : id,
                                }).then((res)=>{
                                    Swal.fire(
                                        'Deleted!',
                                        'Xóa Thành Công',
                                        'success'
                                    )
                                    Fire.$emit('AfterCreate');          // custom event goi đến $on
                                    this.$Progress.finish();
                            }).catch((err)=>{
                                    Swal.fire(
                                        'Failed!',
                                        'Lỗi Không Thể Xóa',
                                        'warning'
                                    )
                                    this.$Progress.fail()
                            });
                        }
                    })
                },ImageProduct(element){                           // base 64
                var file = element.target.files[0];
                // console.log(file);
                var reader = new FileReader();
                if(file.size > 2000000){
                    Swal.fire(
                        'Lỗi!',
                        'Ảnh không được vượt quá 2MB',
                        'error'
                    )
                    this.hideSubmit = true;
                }else if(file.type != "image/jpeg" && file.type != "image/png" && file.type != "image/jpg"){
                    Swal.fire(
                        'Lỗi!',
                        'Không đúng định dạng của ảnh',
                        'error'
                    )
                    this.hideSubmit = true;
                }else{
                    reader.onloadend = (file) => {
                        this.form.image = reader.result;
                    }
                    reader.readAsDataURL(file);
                    this.hideSubmit = false;
                }
            },
            },created() {
                this.$Progress.start();
                Fire.$on('afterSeach',()=>{
                    let keyword = this.$parent.search;
                    axios.get('api/findProduct?q=' + keyword).then((res)=>{
                        this.products = res.data;
                        }).catch((err)=>{
                            console.log(err)
                    });
                });
                this.loadProduct();        // mỗi lần tạo thì gọi method loaduser
                Fire.$on('AfterCreate',()=>{            // load lại mỗi lần click
                    this.loadProduct();
                });
                this.$Progress.finish();
            },mounted() {
                this.getResults();
            },filters: {
                nummberFormat(money)
                {
                    if(money){
                        return money.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                    }
                }
            }
    }
</script>

