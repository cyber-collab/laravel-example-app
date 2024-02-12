import { createRouter, createWebHistory } from "vue-router";

//path for deals
import PostIndex from '@/components/PostIndex.vue'
import PostCreate from '@/components/PostCreate.vue'
import PostEdit from '@/components/PostEdit.vue'

const routes = [
    // {
    //     path: '/dashboard',
    //     name: 'accounts.index',
    //     component: AccountsIndex
    // },
    // {
    //     path: '/dashboard/create',
    //     name: 'accounts.create',
    //     component: AccountsCreate
    // },
    // {
    //     path: '/dashboard/:id/edit',
    //     name: 'accounts.edit',
    //     component: AccountsEdit,
    //     props: true
    // },

    {
        path: '/dashboard',
        name: 'posts.index',
        component: PostIndex
    },
    {
        path: '/dashboard/create',
        name: 'posts.create',
        component: PostCreate
    },
    {
        path: '/dashboard/:id/edit',
        name: 'posts.edit',
        component: PostEdit,
        props: true
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
