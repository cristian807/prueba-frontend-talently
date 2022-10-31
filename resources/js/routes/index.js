
import VueRouter from 'vue-router';
import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'
import Dashboard from '../views/Dashboard'
import Vue from 'vue'
import store from '../store'
Vue.use(VueRouter)

 const router= new VueRouter({
    routes:[
        {
            path:'/',
            name:'login',
            component: Login,
            meta:{
                middleware:'guest'
            }
        },
        {
            path:'/register',
            name:'register',
            component: Register,
            meta:{
                middleware:'guest'
            }
        },
        {
            path:'/dashboard',
            name:'dashboard',
            component: Dashboard,
            meta:{
                middleware:'auth'
            }
        },

    ],
    mode:'history',

})
router.beforeEach((to, from, next) => {
    if (to.matched.some(record=> record.meta.middleware !='auth')){
        if (localStorage.getItem('Authentication')) {
            next({
                name:'dashboard'
            })
        }else{
            next()
        }
    }
    next()
})

export default router

