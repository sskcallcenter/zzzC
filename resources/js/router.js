import Vue from 'vue'
import Router from 'vue-router'

import UserDashboard from './components/User/DashboardComponent'
import UserAccount from './components/User/AccountComponent'
import UserAdmin from './components/User/AdminComponent'
import UserItem from './components/User/ItemComponent'
import UserItemEdit from './components/User/ItemEditComponent'

import ListDashboard from './components/List/DashboardComponent'
import ListAccount from './components/List/AccountComponent'
import ListAdmin from './components/List/AdminComponent'
import ListItem from './components/List/ItemComponent'
import ListItemEdit from './components/List/ItemEditComponent'

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
            path: '/user/item/edit/:id(\\d+)?',
            name: 'user-item-edit',
            component: UserItemEdit,
        },
        {
            path: '/list',
            redirect: '/list/dashboard'
        },
        {
            path: '/list/dashboard',
            name: 'list-dashboard',
            component: ListDashboard,
        },
        {
            path: '/list/account',
            name: 'list-account',
            component: ListAccount,
        },
        {
            path: '/list/admin',
            name: 'list-admin',
            component: ListAdmin,
        },
        {
            path: '/list/item',
            name: 'list-item',
            component: ListItem,
        },
        {
            path: '/list/item/edit/:id(\\d+)?',
            name: 'list-item-edit',
            component: ListItemEdit,
        },
    ],
})
