import Vue from 'vue';
import MuseUI from 'muse-ui';
import 'muse-ui/dist/muse-ui.css';
import './font.css';
import axios from 'axios';
import autop from 'wordpress-autop';

Vue.use(MuseUI);

import 'muse-ui-loading/dist/muse-ui-loading.css';
import Loading from 'muse-ui-loading';
Vue.use(Loading);

import VueLazyload from 'vue-lazyload';
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: require('./assets/dead-ripple.svg'),
    loading: require('./assets/loading-ripple.svg'),
    attempt: 1,
});

Vue.prototype.$axios = axios;
Vue.prototype.$autop = autop;

Vue.prototype.$siteconf = {
    title: 'The Good Parts of WordPress',
    api: './api/',
};

import App from './App.vue';

Vue.config.productionTip = false;

new Vue({
    render: h => h(App),
}).$mount('#app');
