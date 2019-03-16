import home from '../pages/home/home.vue';
import portfolio from '../pages/portfolio/portfolio.vue';
import PageNotFound from '../pages/errors/Error404.vue';

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
    }

];

export default routes;
