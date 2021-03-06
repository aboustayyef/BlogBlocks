require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('app', require('./components/App.vue'));
Vue.component('app-content', require('./components/AppContent.vue'));
Vue.component('app-sidebar', require('./components/AppSidebar.vue'));
Vue.component('post-group', require('./components/PostGroup.vue'));
Vue.component('post-card', require('./components/PostCard.vue'));
Vue.component('card-meta', require('./components/CardMeta.vue'));

const app = new Vue({
    el: '#app'
});