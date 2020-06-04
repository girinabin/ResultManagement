require('./bootstrap');
require('admin-lte');
require('datatables.net-bs4');

window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);




const app = new Vue({
    el: '#app',
    
});
