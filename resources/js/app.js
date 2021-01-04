import Vue from 'vue';
import router from './router';


require('./bootstrap');

Vue.component('App', require('./components/App.vue').default);
Vue.component('front-page', require('./pages/Front.vue').default);
Vue.component('nav-bar', require('./components/navbar.vue').default);
Vue.component('About', require('./pages/About.vue').default);
Vue.component('Gallery', require('./pages/Gallery.vue').default);
Vue.component('TodoList', require('./pages/TodoList.vue').default);
Vue.component('Loader', require('./components/loader.vue').default);
Vue.component('filePond', require('./components/filePond.vue').default);




const app = new Vue({
    el: '#app',
    router,
});

