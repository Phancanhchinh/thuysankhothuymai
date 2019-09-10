
require('./bootstrap');
window.Vue = require('vue');
import {                                             // Vform 1
    Form,HasError,AlertError} from 'vform'
window.Form = Form;                                 // Vform  2
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)          // Vform 3
Vue.component('pagination', require('laravel-vue-pagination'));     //paginate


import VueRouter from 'vue-router'                  //  Vrouter 1
Vue.use(VueRouter)                                  //  Vrouter 2



import Swal from 'sweetalert2'                         //sweetAlert 1
window.Swal = Swal;                                      //sweetAlert 2
const Toast = Swal.mixin({                          //sweetAlert 3
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
});
window.Toast = Toast;                               //sweetAlert 4




import VueProgressBar from 'vue-progressbar'          // Vprocessbar 1
const options = {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    thickness: '4px',
    transition: {
    speed: '1s',                                    // Vprocessbar 2
    opacity: '1s',
    termination: 1000
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)                    // Vprocessbar 3

Vue.use(require('vue-moment'));                 //vue moment 1


const routes = [                        //  Vrouter 3
    { path: '/products', component: require('./components/admin/Products.vue').default},
    { path: '/users', component: require('./components/admin/Users.vue').default },
    { path: '/profile', component: require('./components/admin/Profile.vue').default },
    { path: '/orders', component: require('./components/admin/Orders.vue').default }
]
const router = new VueRouter({              //  Vrouter 4
    //mode: 'history',
    routes // short for `routes: routes`
    })
// Vue.filter('Uptext',function(text){             // filler viết hoa chữ cái đầu
//     return text.charAt(0).toUpperCase() + text.slice(1);
// })
window.Fire =  new Vue();

//passport

const app = new Vue({
    el: '#app',
    router,
    data : {
        search : ''
    },methods: {
        searchIt: _.debounce(()=>{
            Fire.$emit('afterSeach');
        },100)
    },

});
