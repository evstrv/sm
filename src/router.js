import VueRouter from "vue-router"
import Entry from "./pages/Entry"
import Registration from "./pages/Registration"
import Home from "./pages/Home"
import Profile from "./pages/Profile"
import Edit from "./pages/Edit"

const routes = [
    {path: '/', component: Entry},
    {path: '/registration', component: Registration},
    {path: '/home', component: Home},
    {path: '/profile', component: Profile},
    {path: '/edit', component: Edit}
];

export default new VueRouter({routes});