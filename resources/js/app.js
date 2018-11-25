
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { Table, TableColumn, Row, Col, Input, Select, Option, Button, Message } from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

window.Vue = require('vue');

Vue.use(Table);
Vue.use(TableColumn);
Vue.use(Row);
Vue.use(Col);
Vue.use(Input);
Vue.use(Select);
Vue.use(Option);
Vue.use(Button);
Vue.prototype.$message = Message;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

import App from './components/App.vue';

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


if(document.getElementById("app")){
    const app = new Vue({
        el: '#app',
        components: {
            App
          },
        render: h => h(App)
    });
}
