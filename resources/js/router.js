import Vue from 'vue';
import VueRouter from 'vue-router';
import Front from "./pages/Front";
import About from './pages/About';
import TodoList from "./pages/TodoList";
import Gallery from "./pages/Gallery";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'dashboard',
            component: Front
        },
        {
            path: '/About',
            name: 'About',
            component: About
        },
        {
            path:'/Gallery',
            name:'gallery',
            component: Gallery
        },
        {
            path:'/todoList',
            name:'todoList',
            component: TodoList
        }
    ],
    mode: 'history',
})

