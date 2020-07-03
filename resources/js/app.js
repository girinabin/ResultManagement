require('./bootstrap');
require('admin-lte');
require('datatables.net-bs4');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('school-component', require('./school/school.vue').default);
Vue.component('batch-component', require('./batch/batch.vue').default);







const app = new Vue({
    el: '#app',
    
});
