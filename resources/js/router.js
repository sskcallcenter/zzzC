import Vue from 'vue'
import Router from 'vue-router'

import UserDashboard from './components/User/DashboardComponent'
import UserAccount from './components/User/AccountComponent'
import UserAdmin from './components/User/AdminComponent'
import UserItem from './components/User/ItemComponent'
import UserItemAdd from './components/User/ItemAddComponent'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/user',
            redirect: '/user/dashboard'
        },
        {
            path: '/user/dashboard',
            name: 'user-dashboard',
            component: UserDashboard,
        },
        {
            path: '/user/account',
            name: 'user-account',
            component: UserAccount,
        },
        {
            path: '/user/admin',
            name: 'user-admin',
            component: UserAdmin,
        },
        {
            path: '/user/item',
            name: 'user-item',
            component: UserItem,
        },
        {
            path: '/user/item/add',
            name: 'user-item-add',
            component: UserItemAdd,
        },
    ],
})
