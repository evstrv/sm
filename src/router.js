import VueRouter from "vue-router"
import Entry from "./pages/Entry"
import Registration from "./pages/Registration"
import Home from "./pages/Home"
import Profile from "./pages/Profile"
import Edit from "./pages/Edit"
import Followers from "./pages/Followers"
import User from "./pages/User"

const routes = [
    {path: '/', component: Entry},
    {path: '/registration', component: Registration},
    {path: '/home', component: Home},
    {path: '/profile', component: Profile},
    {path: '/edit', component: Edit},
    {path: '/followers', component: Followers},
    {path: '/users/:id', component: User}
];

export default new VueRouter({routes});