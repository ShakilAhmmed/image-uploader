import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

const Login = () => import('../components/Login.vue' /* webpackChunkName: "resource/js/components/login" */)
const Register = () => import('../components/Register.vue' /* webpackChunkName: "resource/js/components/register" */)

const Nav = () => import('../components/layouts/Nav.vue' /* webpackChunkName: "resource/js/components/layouts/nav" */)

const Home = () => import('../components/Home.vue' /* webpackChunkName: "resource/js/components/home" */)
const AddImage = () => import('../components/AddImage.vue' /* webpackChunkName: "resource/js/components/add-image" */)
const ImageList = () => import('../components/ImageList.vue' /* webpackChunkName: "resource/js/components/image-list" */)

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: Nav,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Home,
                meta: {
                    title: `Dashboard`
                },
                children: [
                    {
                        name: "image-list",
                        path: '/',
                        component: ImageList,
                        meta: {
                            title: `ImageList`
                        }
                    },
                    {
                        name: "add-image",
                        path: '/add-image',
                        component: AddImage,
                        meta: {
                            title: `AddImage`
                        }
                    }
                ]
            },

        ]
    }
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({name: "dashboard"})
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({name: "login"})
        }
    }
})

export default router
