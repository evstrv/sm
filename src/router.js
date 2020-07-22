import VueRouter from "vue-router"
import Entry from "./pages/Entry"
import Registration from "./pages/Registration"
import Home from "./pages/Home"
import Profile from "./pages/Profile"
import Edit from "./pages/Edit"
import Users from "./pages/Users"
import User from "./pages/User"
import Notifications from "./pages/Notifications"

const routes = [
    {path: '/', component: Entry},
    {path: '/registration', component: Registration},
    {path: '/home', component: Home},
    {path: '/profile', component: Profile},
    {path: '/edit', component: Edit},
    {path: '/users', component: Users},
    {path: '/users/:id', component: User},
    {path: '/notifications', component: Notifications}
];

export default new VueRouter({routes});