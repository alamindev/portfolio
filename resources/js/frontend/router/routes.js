import home from '../pages/home/home.vue';
import portfolio from '../pages/portfolio/portfolio.vue';
import PageNotFound from '../pages/errors/Error404.vue';
import contact from '../pages/contact/contact.vue';
import about from '../pages/about/about.vue';

const routes = [{
    path: '/',
    redirect: '/'
},
{
    path: "*",
    component: PageNotFound
},
{
    path: '/home',
    name: 'home',
    component: home
},
{
    path: '/home/portfolio',
    name: 'portfolio',
    component: portfolio
},
{
    path: '/home/contact',
    name: 'contact',
    component: contact
},
{
    path: '/home/about',
    name: 'about',
    component: about
}

];

export default routes;
