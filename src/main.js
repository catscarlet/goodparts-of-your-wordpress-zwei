import Vue from 'vue';
import MuseUI from 'muse-ui';
import 'muse-ui/dist/muse-ui.css';
import './font.css';
import axios from 'axios';
import autop from 'wordpress-autop';

Vue.use(MuseUI);
Vue.prototype.$axios = axios;
Vue.prototype.$autop = autop;
Vue.prototype.$siteconf = {
    title: 'The Good Parts of WordPress',
    description: '<span>The Good Parts of Your WordPress</span><br><span>← Click the item in the menu ←</span>',
    description_mobile: '<span>The Good Parts of Your WordPress</span><br><span>→ Slide →</span>',
    api: './api/',
};

import App from './App.vue';

Vue.config.productionTip = false;

new Vue({
    render: h => h(App),
}).$mount('#app');
