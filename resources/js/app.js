window.Vue = require('vue');
Vue.component('article-updated', require('./components/ArticleUpdate').default);
Vue.component('chat', require('./components/Chat').default);

// const app = new Vue({
//     el: '#app',
// });

require('./bootstrap');
require('./echo');
