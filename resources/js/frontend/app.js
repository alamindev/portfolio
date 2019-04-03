/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');
import Vuetify from 'vuetify'
Vue.use(Vuetify)
import 'vuetify/dist/vuetify.min.css'
import VAnimateCss from 'v-animate-css';
Vue.use(VAnimateCss);
Vue.component('app-default', require('./layouts/app.vue').default); 

import VueRouter from 'vue-router';
Vue.use(VueRouter);
import router from './router';
import VueTyperPlugin from 'vue-typer';
import VueProgressBar from 'vue-progressbar';
const options = {
    color: '#FF1744',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
}
Vue.use(VueProgressBar, options)
Vue.use(VueTyperPlugin);

// Add the router to every vue instance.
Vue.prototype.router = router;
Vue.prototype.goBack = () => {
    router.go(-1);
};

const app = new Vue({
    el: '#app',
    router,
    mounted() {
        //  [App.vue specific] When App.vue is finish loading finish the progress bar
        this.$Progress.finish()
    },
    created() {
        //  [App.vue specific] When App.vue is first loaded start the progress bar
        this.$Progress.start()
        //  hook the progress bar to start before we move router-view
        this.$router.beforeEach((to, from, next) => {
            let title = to.name;
            const keys = Object.keys(to.params);
            if (keys.length) {
                title = `${to.name}: ${to.params[keys[0]]}`;
                if (to.params[keys[1]]) {
                    title += ` ${to.params[keys[1]]}`;
                }
            }
            document.title = title;
            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress
                // parse meta tags
                this.$Progress.parseMeta(meta)
            }
            //  start the progress bar
            this.$Progress.start()
            //  continue to next page
            next()
        })

        //  hook the progress bar to finish after we've finished moving router-view
        this.$router.afterEach((to, from) => {
            //  finish the progress bar
            this.$Progress.finish()
        })
    }
})
