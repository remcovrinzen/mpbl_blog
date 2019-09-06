
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Buefy from 'buefy';
import StarRating from 'vue-star-rating';
import Datepicker from 'vuejs-datepicker';
import VueSlider from 'vue-slider-component';
import 'vue-slider-component/theme/default.css'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(Buefy);

Vue.component('star-rating', StarRating);
Vue.component('vuejs-datepicker', Datepicker);
Vue.component('vue-slider', VueSlider);
Vue.component('multi-checkbox', require('./components/MultiCheckbox.vue').default);
Vue.component('post-teaser', require('./components/PostTeaser.vue').default);
Vue.component('post-list', require('./components/PostList.vue').default);
Vue.component('post-list-item', require('./components/PostListItem.vue').default);
Vue.component('post-filter', require('./components/PostFilter.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
