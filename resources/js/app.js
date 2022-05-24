require('./bootstrap');

window.Vue = require('vue');

Vue.component('shortener-component', require('./ShortenerComponent.vue').default);

const app = new Vue({
    el: '#app',
});
