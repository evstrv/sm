import VueRouter from "vue-router"
import Entry from "./pages/Entry"
import Registration from "./pages/Registration"
import Home from "./pages/Home"

const routes = [
    {path: '/', component: Entry},
    {path: '/registration', component: Registration},
    {path: '/home', component: Home}
];

export default new VueRouter({routes});