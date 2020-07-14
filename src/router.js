import VueRouter from "vue-router"
import Entry from "./pages/Entry"
import Registration from "./pages/Registration"

const routes = [
    {path: '/', component: Entry},
    {path: '/registration', component: Registration}
];

export default new VueRouter({routes});