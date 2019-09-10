<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 250px !important;
    }
    .widget-user .card-footer{
    padding: 0;
    }
    .ct{
        margin-left: auto;
    }
</style>

<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <div class="card card-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header text-white" style="background-image:url('/admin/img/user-cover.jpg')">
                <h3 class="widget-user-username">{{this.form.full_name}}</h3>
                <h5 class="widget-user-desc">Admin</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" :src="getProfileImage()" alt="User Avatar">
            </div>
            </div>
            </div>
        </div>
        <!-- /.tren -->
        <div class="col-md-12">
            <div class="card">
            <div class="nav-tabs-custom">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane ct active" id="activity">
                    <h3 class="text-center">Display User Activity</h3>
                </div>
                <div class="tab-pane" id="settings">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" name="full_name" v-model="form.full_name" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('full_name') }" id="full_name">
                            <has-error :form="form" field="full_name"></has-error>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" name="email" v-model="form.email" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('email') }" id="email">
                            <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-12">
                            <input type="text" name="phone" v-model="form.phone" class="form-control"
                            :class="{ 'is-invalid': form.errors.has('phone') }" id="phone">
                            <has-error :form="form" field="phone"></has-error>
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-12">
                        <input type="text" name="address" v-model="form.address" class="form-control"
                        :class="{ 'is-invalid': form.errors.has('address') }" id="address">
                        <has-error :form="form" field="address"></has-error>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                        <div class="col-sm-12">
                            <input type="file" @change="updateImage" name="photo" class="form-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRole" class="col-sm-2 control-label">Role</label>
                        <div class="col-sm-12">
                            <select v-model="form.role" name="role" class="form-control" :class="{ 'is-invalid': form.errors.has('role') }">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                            <has-error :form="form" field="role"></has-error>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-12">
                            <button type="submit"  v-bind:disabled="hideSubmit"  @click.prevent="updateProfile" class="btn btn-danger">Update</button>
                        </div>
                    </div>
                </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return{
                form: new Form({
                    id : '',
                    full_name: '',
                    email: '',
                    password: '',
                    phone : '',
                    address : '',
                    role : '',
                    photo : ''
                }),
                hideSubmit : false,
            }
        },
        methods: {
            updateImage(element){                           // base 64
                var file = element.target.files[0];
                var reader = new FileReader();
                if(file.size > 2000000){
                    Swal.fire(
                        'Lỗi!',
                        'File không được vượt quá 2MB',
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
                        this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);
                    this.hideSubmit = false;
                }
            },
            updateProfile(){
                this.$Progress.start();
                this.form.post('api/update/pf',{
                    id : this.form.id
                    }).then(()=>{
                        Swal.fire(
                                'Ok!',
                                'Update thành công',
                                'success'
                            )
                        this.$Progress.finish();
                    }).catch(()=>{
                    Swal.fire(
                            'Failed!',
                            'Update Thất bại',
                            'warning'
                        )
                    this.$Progress.fail();
                });
            },
            getProfileImage(){
                // let prefix = (this.form.photo.match(/\//) ? '' : '/admin/img/profile/');
                // return prefix + this.form.photo;
                // let photo = (this.form.photo.length > 200) ? this.form.photo : "/admin/img/profile/"+ this.form.photo ;
                // return photo;
                let photo = (this.form.photo.length > 200) ? this.form.photo : "/admin/img/profile/"+ this.form.photo ;
                return photo;
            }
        },
        created() {
            axios.get('api/profile').then((data)=>{
                this.form.fill(data.data);
            })
        },
    }
</script>
